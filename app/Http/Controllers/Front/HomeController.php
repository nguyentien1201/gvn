<?php


namespace App\Http\Controllers\Front;

use App\Models\GroupCapVnIndex;
use App\Models\SubGroupCapDetailVnIndex;
use Illuminate\Support\Facades\Mail;
use App\Models\GreenBeta;
use Illuminate\Support\Facades\Request;
// use Illuminate\Http\Request;
use App\Models\GreenAlpha;
use App\Models\GreenStockNas100;
use App\Models\VnIndex;
use DB;
use App\Models\SubGroup;
use App\Models\Ma;
use App\Models\MaVnIndex;
use App\Models\SubGroupVnIndex;
use Illuminate\Support\Facades\Cache;
use App\Models\GroupCap;
use App\Models\SubGroupCapDetail;
use DateTime;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use App\Models\ConstantModel;
use App\Models\Subscription;
use App\Models\UserFollowStock;
use App\Models\BanIp;
use App\Models\UserFollowStockVnIndex;


class HomeController
{
    public function index(Request $request)
    {
        Cache::forget('banned_ips');
        // $role_id = $user->role_id ?? null;
        // $subscription = Subscription::where('user_id', $user->id)->where('product_id',2)->where('end_date' ,'>=', now())->get();
        $signals = (new GreenBeta())->getListSignalsByGroup();
        // $signals  = array_slice($signals, 0, 5);
        $nas100 = $this->getHistorySignal(1);
        $eth = $this->getHistorySignal(23);
        $usOil = $this->getHistorySignal(15);
        $xausud = $this->getHistorySignal(13);
        $default_chart['nas100'] = $nas100['data'];
        $default_chart['eth'] = $eth['data'];
        $default_chart['usOil'] = $usOil['data'];
        $default_chart['xausud'] = $xausud['data'];
        $green_data = (new GreenStockNas100())->getListNas100Api(20);
        $green_data = $green_data['data'] ?? [];
        $green_vnindex = (new VnIndex())->getListNas100Api(20);
        $green_vnindex = $green_vnindex['data'] ?? [];
        // if($subscription->isEmpty() && $role_id != 1){
        //     return redirect()->route('front.home.trading-system');
        // }
        // if(!\Auth::check()){
        //     foreach ($signals as $key => $value) {
        //         $value['open_time'] = 'fas fa-lock';
        //         $value['price_open'] = 'fas fa-lock';
        //         $value['trend_price'] = 'fas fa-lock';
        //         $value['price_close'] = 'fas fa-lock';
        //         $value['close_time'] = 'fas fa-lock';
        //         $signals[$key] = $value;
        //     }

        //     foreach ($green_data as $key => $value) {
        //         $value['code'] = 'fas fa-lock';
        //         $value['company_name'] = 'fas fa-lock';
        //         $value['current_price'] = 'fas fa-lock';
        //         $value['price'] = 'fas fa-lock';
        //         $value['time'] = 'fas fa-lock';
        //         $green_data[$key] = $value;

        //     }
        // }else {
        //     $user = \Auth::user();
        //     $role_id = $user->role_id ?? null;
        //     $subscriptionBeta = Subscription::where('user_id', $user->id)->where('product_id',2)->where('end_date' ,'>=', now())->first();
        //     $subscriptionGreenStock = Subscription::where('user_id', $user->id)->where('product_id',3)->where('end_date' ,'>=', now())->first();

        //     if(empty($subscriptionBeta) && $role_id != 1){
        //         foreach ($signals as $key => $value) {
        //             $value['open_time'] = 'fas fa-lock';
        //             $value['price_open'] = 'fas fa-lock';
        //             $value['price_close'] = 'fas fa-lock';
        //             $value['close_time'] = 'fas fa-lock';
        //             $signals[$key] = $value;
        //         }
        //     }
        //     if(!empty($subscriptionBeta) && $subscriptionBeta['is_trial'] == 1 && $role_id != 1){
        //         foreach ($signals as $key => $value) {
        //             $value['open_time'] = 'fas fa-lock';
        //             $value['price_open'] = 'fas fa-lock';
        //             $signals[$key] = $value;
        //         }
        //     }

        //     if(empty($subscriptionGreenStock) && $role_id != 1){
        //         foreach ($green_data as $key => $value) {
        //             $value['code'] = 'fas fa-lock';
        //             $value['company_name'] = 'fas fa-lock';
        //             $value['price'] = 'fas fa-lock';
        //             $value['time'] = 'fas fa-lock';
        //             $green_data[$key] = $value;

        //         }
        //     }

        //     if(!empty($subscriptionGreenStock) && $subscriptionGreenStock['is_trial'] == 1 && $role_id != 1){
        //         foreach ($green_data as $key => $value) {
        //             $value['price'] = 'fas fa-lock';
        //             $value['time'] = 'fas fa-lock';
        //             $green_data[$key] = $value;
        //         }
        //     }
        // }


        $last_signal =  GreenAlpha::whereIn('close_time', function ($query) {
            $query->select(DB::raw('MAX(close_time)'))
                  ->from('green_alpha')
                  ->groupBy('code');
        })
        ->orderBy('close_time', 'desc')
        ->limit(12)->get();

        $data_chart_default = $this->getHistoryAlphaSignal(1);

        $chart_signal = (new GreenStockNas100())->getGroupSignal();
        usort($chart_signal, function($a, $b) {
            return strcmp($a['signal'], $b['signal']);
        });
        $totalCount = array_reduce($chart_signal, function ($carry, $item) {
            return $carry + $item['total'];
        }, 0);
        $labels = array_map(function($item) {
            return $item['signal'];
        }, $chart_signal);

        $chart_signal = array_map(function($item) use ($totalCount) {
            return  round($item['total']/$totalCount*100,2);
        }, $chart_signal);
        $ma = (new Ma())->getMa();

        $ma['up'] = [$ma['upMA50'],$ma['upMA200']];
        $ma['down'] = [$ma['downMA50'],$ma['downMA200']];
        $chart_group_data = (new SubGroup())->getDataSubGroup(20);
        $chart_group_data = array_slice($chart_group_data, 0, 20);
        return view('frontend_v2.home',compact('signals','green_data','green_vnindex','default_chart','last_signal','data_chart_default','chart_group_data','ma','chart_signal','labels'));
    }
    public function greenBeta(Request $request)
    {
        $user = \Auth::user();
        $role_id = $user->role_id ?? null;
        $subscription = Subscription::where('user_id', $user->id)->where('product_id',2)->where('end_date' ,'>=', now())->first();

        if(empty($subscription) && $role_id != 1){
            return redirect()->route('front.home.trading-system');
        }

        $signals = (new GreenBeta())->getListSignalsByGroup();
        if(!empty($subscription) && $subscription['is_trial'] == 1){
            foreach ($signals as $key => $value) {
                $value['open_time'] = 'fas fa-lock';
                $value['price_open'] = 'fas fa-lock';
                $signals[$key] = $value;
            }
        }

        $data_chart = (new GreenBeta())->getDataChartSignals();
        $code = $data_chart->pluck('code_name')->toArray();
        $total = $data_chart->pluck('total')->toArray();
        $winratio = $data_chart->pluck('win_ratio')->toArray();
        $startDate = $data_chart->pluck('start_trade')->toArray();
        $chart_data = [
            'code' => $code,
            'total' => $total,
            'winratio' => $winratio,
            'startDate' => $startDate
        ];
        $nas100 = $this->getHistorySignal(1);

        $default_chart = $nas100['data'];
        return view('front.green_beta',compact('signals',
        'chart_data','default_chart'));

    }
    public function greenAlpha(Request $request)
    {
        $user = \Auth::user();
        $role_id = $user->role_id ?? null;
        $current_version = config('config.current_version');
        $subscription = Subscription::where('user_id', $user->id)->where('product_id',1)->where('end_date' ,'>=', now())->first();
        if(empty($subscription) && $role_id != 1){
            return redirect()->route('front.home.trading-system');
        }
        $signals = (new GreenAlpha())->getListSignalsByGroup();
        if(!empty($subscription) && $subscription['is_trial'] == 1 && $role_id != 1){
            foreach ($signals as $key => $value) {
                $value['open_time'] = 'fas fa-lock';
                $value['price_open'] = 'fas fa-lock';
                $signals[$key] = $value;

            }
        }

        $data_chart = (new GreenAlpha())->getDataChartSignals($current_version);
        $dataChartProfit = (new GreenAlpha())->getCurrentMonthProfitSum($current_version);

        $data_chart_default = $this->getHistoryAlphaSignal(1);
        $code = $data_chart->pluck('code')->toArray();
        $total = $data_chart->pluck('total_trade')->toArray();
        $winratio = $data_chart->pluck('win_ratio')->toArray();
        $chart_data = [
            'code' => $code,
            'total' => $total,
            'winratio' => $winratio,
            // 'startDate' => $startDate
        ];

        return view('front.green_alpha',compact('signals',
        'chart_data','dataChartProfit','data_chart_default'));
    }
    public function getHistorySignal($id)
    {

        $data = (new GreenBeta())->getSignalsById($id);

        $dataSort =$data ;
        usort($dataSort, function($a, $b) {

            $dateA = DateTime::createFromFormat('m-d-Y', $a['close_time']);
            $dateB = DateTime::createFromFormat('m-d-Y', $b['close_time']);

            if ($dateA && $dateB) {
                return $dateA <=> $dateB;
            } else {
                // Handle invalid date formats
                return 0;
            }
        });
        $datacollect = collect($dataSort);
        $profits = $datacollect->pluck('profit')->toArray();

        $sum = 100;
        $sumArray = [];

        foreach ($profits as $value) {
            $sum = $sum + $sum*$value/100;
            $sumArray[] = round($sum,2);
        }
        $result = [
            'list' => $data,
            'profit' => $sumArray
        ];

        return [
            'status' => 200,
            'data' => $result
        ];
    }
    public function getHistoryAlphaSignal($id)
    {
        $profitByMonth = (new GreenAlpha())->getProfitByMonth($id);
        $labels = $profitByMonth->pluck('month_year')->toArray();
        $profitMonth = [
            'profit' => $profitByMonth->pluck('profit')->toArray(),
        ];
        $labels = array_map(function($value) {
            return str_replace('-00', '', $value);
        }, $labels);
        $profitMonth['lable'] = $labels;
        $data = (new GreenAlpha())->getHistorySignal($id);

        $dataSort =$data ;
        usort($dataSort, function($a, $b) {
            return  strtotime($a['open_time'])-strtotime($b['open_time']);
        });
        $datacollect = collect($dataSort);

        $profits = $profitMonth['profit'];
        $sum = 100;
        $sumArray = [];
        foreach ($profits as $value) {
            $sum = $sum + $sum*$value/100;
            $sumArray[] = round($sum,2);
        }
        $result = [
            'list' => $data,
            'profit' => $sumArray,
            'profitByMonth' => $profitMonth
        ];
        return [
            'status' => 200,
            'data' => $result
        ];
    }
    public function greenStock(){
        $user = \Auth::user();
        $role_id = $user->role_id ?? null;
        $subscription = Subscription::where('user_id', $user->id)->where('product_id',3)->where('end_date' ,'>=', now())->first();
        if(empty($subscription) && $role_id != 1){
            return redirect()->route('front.home.trading-system');
        }
        $signalsData = (new GreenStockNas100())->getListNas100Api();


        $signals = $signalsData['data'] ?? [];
        $list_code = $signalsData['list_code'];
        $list_stock = $list_code->pluck('code','id');
        $list_code_follow = UserFollowStock::where(['user_id'=>$user->id])->orderBy('id')->pluck('stock_id')->toArray();
        $list_folow = $signalsData['data']->whereIn('id', $list_code_follow);

        if(!empty($subscription) && $subscription['is_trial'] == 1){
            foreach ($signals as $key => $value) {
                $value['price'] = 'fas fa-lock';
                $value['time'] = 'fas fa-lock';
                $signals[$key] = $value;
            }
        }
        $top_stock = (new GreenStockNas100())->getTopStock();
        $chart_signal = (new GreenStockNas100())->getGroupSignal();
        usort($chart_signal, function($a, $b) {
            return strcmp($a['signal'], $b['signal']);
        });
        $totalCount = array_reduce($chart_signal, function ($carry, $item) {
            return $carry + $item['total'];
        }, 0);
        $labels = array_map(function($item) {
            return $item['signal'];
        }, $chart_signal);

        $chart_signal = array_map(function($item) use ($totalCount) {
            return  round($item['total']/$totalCount*100,2);
        }, $chart_signal);
        $ma = (new Ma())->getMa();
        $chart_group_data = (new SubGroup())->getDataSubGroup(10);
        $chart_group_data = array_slice($chart_group_data, 0, 10);
 
        $ma['up'] = [$ma['upMA50'],$ma['upMA200']];
        $ma['down'] = [$ma['downMA50'],$ma['downMA200']];
        return view('frontend_v2.green_stock',compact('signals','top_stock','chart_signal','labels','ma','chart_group_data','list_stock','list_folow'));
    }
    public function getMarketGreenStock(){

        // $marketOverview = Cache::get('market_overview');
        // if($marketOverview){
        //    return [
        //        'status' => 200,
        //        'data' => $marketOverview
        //    ];
        // }
        $market_cap = (new GroupCap())->getMarketCap();
        $chart_group_data = (new SubGroup())->getDataSubGroupApi();
        $top_stock = (new GreenStockNas100())->getTopStock();
        $user = \Auth::user();
        $role_id = $user->role_id ?? null;
        $subscription = Subscription::where('user_id', $user->id)->where('product_id',3)->where('end_date' ,'>=', now())->first();
        if( !empty($subscription) && $subscription['is_trial'] == 1 && $role_id != 1){
            foreach ($top_stock as $key => $value) {
                $value['price'] = 'fas fa-lock';
                $value['time'] = 'fas fa-lock';
                $top_stock[$key] = $value;
            }
        }
        $cap = [61153987935,-334930984165];
        $ma = (new Ma())->getMaApi();
        $current_cap =  (new SubGroupCapDetail())->getCurrentCap();
        $marketOverview = [
            'market_cap' => $market_cap,
            'chart_group_data' => $chart_group_data,
            'top_stock' => $top_stock,
            'cap' => $cap,
            'ma' => $ma,
            'current_cap' => $current_cap
        ];
        Cache::put('market_overview', $marketOverview, 60*60);
        return [
            'status' => 200,
            'data' => $marketOverview,
        ];
    }
    public function getTopStock(){
        $request = Request::all();
        $labels = $request['label'] ?? '';
        if(empty($labels)){
            return [
                'status' => 200,
                'data' => []
            ];
        }
        $top_stock = (new GreenStockNas100())->getTopStockByGroup($labels);
        $user = \Auth::user();
        $role_id = $user->role_id ?? null;
        $subscription = Subscription::where('user_id', $user->id)->where('product_id',3)->where('end_date' ,'>=', now())->first();

        // if($subscription['is_trial'] == 1 && $role_id != 1){
        //     foreach ($top_stock as $key => $value) {
        //         $value['price'] = 'fas fa-lock';
        //         $value['time'] = 'fas fa-lock';
        //         $top_stock[$key] = $value;
        //     }
        // }
        return [
            'status' => 200,
            'data' => $top_stock
        ];
    }
    public function tradingSystem(){
        $product = Product::all();

        $price_product = [];
        foreach ($product as $key => $value) {

            $system = $value->system ?? '';
            $price_product[$system] = $value;
        }

        return view('front.trading_system',compact('price_product'));
    }
    public function contact(){
        return view('front.contact');
    }
    public function mission(){
        return view('front.mission');
    }
    public function changeLanguage(Request $request)
    {

        $request = Request::all();
        Session::put('locale', $request['language']);

        return redirect()->back();
    }
    public function postContact(Request $request)
    {
        $user = \Auth::user();
        if(empty($user)) {
            return back()->with('fail', 'Please Login to contact!');
        }
        $found = false;
        $request = Request::all();
        $array = config('ban.key_word_ban');
        foreach ($array as $string) {
            if (strpos($request['email'], $string) !== false) {
                $found = true;
                break; // Dừng lại khi tìm thấy
            }
        }
        if ($found  == true) {
            $exist = BanIp::where('ip', Request::ip())->first();
            if($exist){
                return back()->with('fail', 'Your IP has been banned!');
            }else {
                BanIp::create([
                    'ip' => Request::ip(),
                    'reason' => 'Spam email'
                ]);
                Cache::forget('banned_ips');
                return back()->with('fail', 'Your IP has been banned!');
            }
        }
        $data = [
            'name' => $request['name'] ?? '',
            'email' => $request['email']?? '',
            'note' => $request['message'] ?? '',
            'product' => ConstantModel::PRODUCT[$request['product']] ?? '',
        ];

        // Gửi email đến admin
        Mail::send('front.common.mail-contact', $data, function($messageValue) use ($data) {
            $messageValue->to('admin@gvn-fintrade.com')  // Email của admin
                    ->subject('Contact to Gvn');
        });
   // Gửi phản hồi lại cho người gửi
        Mail::send('front.common.contact-reply', $data, function ($message) use ($data) {
            $message->to($data['email'])
                    ->subject('Thank you for contacting us!');
        });
        // Redirect lại form với thông báo thành công
        return back()->with('success', 'Your message has been sent successfully!');
    }
    public function followUnfollowStock($stock_id,$type)
    {
        $user = \Auth::user();
        $listFollow = UserFollowStock::where(['user_id'=>$user->id])->count();
        if($listFollow >=10) {
            return ['success' => true, 'message' => 'Limit follow'];
        }
        $isFollowed = UserFollowStock::where(['user_id'=>$user->id,'stock_id'=>$stock_id])->first();

        if ($isFollowed){
            return ['success' => true, 'message' => 'You are ready follow'];
        }else{
            UserFollowStock::insert([
                'user_id'=> $user->id,
                'stock_id'=>$stock_id,
                ]);
            $stock_info = GreenStockNas100::find($stock_id);

            return ['success' => true, 'message' => 'Follow Success','data'=> json_encode($stock_info)];
        }
    }
    public function unfollowStock($stock_id)
    {
        $user = \Auth::user();
        $isFollowed = UserFollowStock::where(['user_id'=>$user->id,'stock_id'=>$stock_id])->first();
        if ($isFollowed){
            $isFollowed->delete();
            return ['success' => true, 'message' => 'You are ready unfollow'];
        }else {
            return ['success' => false, 'message' => 'Error unfollow'];
        }
    }
    public function followUnfollowStockVnIndex($stock_id)
    {
        $user = \Auth::user();
        $listFollow = UserFollowStockVnIndex::where(['user_id'=>$user->id])->count();
        if($listFollow >=10) {
            return ['success' => true, 'message' => 'Limit follow'];
        }
        $isFollowed = UserFollowStockVnIndex::where(['user_id'=>$user->id,'stock_id'=>$stock_id])->first();

        if ($isFollowed){
            return ['success' => true, 'message' => 'You are ready follow'];
        }else{
            UserFollowStockVnIndex::insert([
                'user_id'=> $user->id,
                'stock_id'=>$stock_id,
                ]);
            $stock_info = VnIndex::find($stock_id);

            return ['success' => true, 'message' => 'Follow Success','data'=> json_encode($stock_info)];
        }
    }
    public function unfollowStockVnIndex($stock_id)
    {
        $user = \Auth::user();
        $isFollowed = UserFollowStockVnIndex::where(['user_id'=>$user->id,'stock_id'=>$stock_id])->first();
        if ($isFollowed){
            $isFollowed->delete();
            return ['success' => true, 'message' => 'You are ready unfollow'];
        }else {
            return ['success' => false, 'message' => 'Error unfollow'];
        }
    }
    public function paymentProduct($id){
        $product = Product::find($id);
        return view('front.payment',compact('product'));
    }

    public function vnIndex(){
        $user = \Auth::user();
        $role_id = $user->role_id ?? null;
        // $subscription = Subscription::where('user_id', $user->id)->where('product_id',3)->where('end_date' ,'>=', now())->first();
        // if(empty($subscription) && $role_id != 1){
        //     return redirect()->route('front.home.trading-system');
        // }
        $signalsData = (new VnIndex())->getListNas100Api();


        $signals = $signalsData['data'] ?? [];
        $list_code = $signalsData['list_code'];
        $list_stock = $list_code->pluck('code','id');
        $list_code_follow = UserFollowStockVnIndex::where(['user_id'=>$user->id])->orderBy('id')->pluck('stock_id')->toArray();
        $list_folow = $signalsData['data']->whereIn('id', $list_code_follow);

        if(!empty($subscription) && $subscription['is_trial'] == 1){
            foreach ($signals as $key => $value) {
                $value['price'] = 'fas fa-lock';
                $value['time'] = 'fas fa-lock';
                $signals[$key] = $value;
            }
        }
        $top_stock = (new VnIndex())->getTopStock();
        $chart_signal = (new VnIndex())->getGroupSignal();
        usort($chart_signal, function($a, $b) {
            return strcmp($a['signal'], $b['signal']);
        });
        $totalCount = array_reduce($chart_signal, function ($carry, $item) {
            return $carry + $item['total'];
        }, 0);
        $labels = array_map(function($item) {
            return $item['signal'];
        }, $chart_signal);

        $chart_signal = array_map(function($item) use ($totalCount) {
            return  round($item['total']/$totalCount*100,2);
        }, $chart_signal);
        $ma = (new MaVnIndex())->getMa();
        $chart_group_data = (new SubGroupVnIndex())->getDataSubGroup(10);
        $chart_group_data = array_slice($chart_group_data, 0, 10);

        $ma['up'] = [$ma['upMA50'],$ma['upMA200']];
        $ma['down'] = [$ma['downMA50'],$ma['downMA200']];
        // dd($signals,$top_stock,$chart_signal,$labels,$ma,$chart_group_data,$list_stock,$list_folow);
        return view('frontend_v2.vnindex',compact('signals','top_stock','chart_signal','labels','ma','chart_group_data','list_stock','list_folow'));
    }
    public function getMarketVnIndex(){

        // $marketOverview = Cache::get('market_overview');
        // if($marketOverview){
        //    return [
        //        'status' => 200,
        //        'data' => $marketOverview
        //    ];
        // }
        $market_cap = (new GroupCapVnIndex())->getMarketCap();
        $chart_group_data = (new SubGroupVnIndex())->getDataSubGroupApi();
        $top_stock = (new VnIndex())->getTopStock();
        $user = \Auth::user();
        $role_id = $user->role_id ?? null;
        // $subscription = Subscription::where('user_id', $user->id)->where('product_id',3)->where('end_date' ,'>=', now())->first();
        // if( !empty($subscription) && $subscription['is_trial'] == 1 && $role_id != 1){
        //     foreach ($top_stock as $key => $value) {
        //         $value['price'] = 'fas fa-lock';
        //         $value['time'] = 'fas fa-lock';
        //         $top_stock[$key] = $value;
        //     }
        // }
        $cap = [32869015625.5,-17106744206.5];
        $ma = (new MaVnIndex())->getMaApi();
        $current_cap =  (new SubGroupCapDetailVnIndex())->getCurrentCap();
        $marketOverview = [
            'market_cap' => $market_cap,
            'chart_group_data' => $chart_group_data,
            'top_stock' => $top_stock,
            'cap' => $cap,
            'ma' => $ma,
            'current_cap' => $current_cap
        ];
        // Cache::put('market_overview', $marketOverview, 60*60);
        return [
            'status' => 200,
            'data' => $marketOverview,
        ];
    }
    public function getTopStockVNIndex(){
        $request = Request::all();
        $labels = $request['label'] ?? '';

        if(empty($labels)){
            return [
                'status' => 200,
                'data' => []
            ];
        }
        $top_stock = (new VnIndex())->getTopStockByGroup($labels);
        $user = \Auth::user();
        $role_id = $user->role_id ?? null;
        $subscription = Subscription::where('user_id', $user->id)->where('product_id',3)->where('end_date' ,'>=', now())->first();

        // if($subscription['is_trial'] == 1 && $role_id != 1){
        //     foreach ($top_stock as $key => $value) {
        //         $value['price'] = 'fas fa-lock';
        //         $value['time'] = 'fas fa-lock';
        //         $top_stock[$key] = $value;
        //     }
        // }
        return [
            'status' => 200,
            'data' => $top_stock
        ];
    }
}
