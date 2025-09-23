<?php


namespace App\Http\Controllers\Front;

use App\Models\GroupCapVnIndex;
use App\Models\SubGroupCapDetailVnIndex;
use Illuminate\Support\Facades\File;
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
use App\Models\TransactionPortfolio;

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

        $chart_signal = (new GreenStockNas100())->getGroupSignalV2();
        $totalCount = array_reduce($chart_signal, function ($carry, $item) {
            return $carry + $item['total'];
        }, 0);

        $labels = array_column($chart_signal, 'signal');

        $chart_signal = array_map(function($item) use ($totalCount) {
            return $totalCount > 0
                ? round($item['total'] / $totalCount * 100, 2)
                : 0;
        }, $chart_signal);
        // usort($chart_sig
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
        // if(!empty($subscription) && $subscription['is_trial'] == 1){
        //     foreach ($signals as $key => $value) {
        //         $value['open_time'] = 'fas fa-lock';
        //         $value['price_open'] = 'fas fa-lock';
        //         $signals[$key] = $value;
        //     }
        // }

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
        $list_signal = $this->countResultSignalBeta($signals);
        \Log::info($list_signal);
        return view('frontend_v2.green_beta',compact('signals',
        'chart_data','default_chart','list_signal'));

    }
    public function countResultSignalBeta($signals){
        $openBuyCount       = 0;
$closeHoldCount     = 0;
$closeTakeProfit    = 0;
$closeCutLoss       = 0;

// 4) Duyệt mảng và tăng counter
foreach ($signals as $item) {
    // count signal_open = BUY
    if (isset($item['signal_open']) && $item['signal_open'] === 'BUY') {
        $openBuyCount++;
    }

    // count signal_close
    $c = $item['signal_close'];
    if (is_null($c) || $c === '' || $c === 'Hold') {
        // null/empty cũng tính vào Hold
        $closeHoldCount++;
    }
    elseif ($c === 'TakeProfitBUY') {
        $closeTakeProfit++;
    }
    elseif (strcasecmp($c, 'CutLossBUY') === 0) {
        // so sánh không phân biệt hoa thường
        $closeCutLoss++;
    }
}

// 5) Kết quả
$result = [
    'signal_open'        => $openBuyCount,
    'signal_hold'      => $closeHoldCount,
    'signal_TakeProfitBUY' => $closeTakeProfit,
    'signal_CutLossBUY'=> $closeCutLoss,
];
    return $result;
    }

    public function countResultSignalAlpha($signals){
        $buyCount = 0;
        $signalCloseCount = 0;
        $holdCount = 0;

        // Khởi tạo đủ 4 loại trước
        $signalCloseTypes = [
            'TakeProfitBUY' => 0,
            'TakeProfitSELL' => 0,
            'CutLossBUY' => 0,
            'CutLossSELL' => 0,
        ];

        $maxProfit = null;
        $minProfit = null;
        $maxProfitCode = null;
        $minProfitCode = null;

        foreach ($signals as $item) {
            // Đếm signal_open là 'Buy'
            if (isset($item['signal_open']) && strtolower($item['signal_open']) === 'buy') {
                $buyCount++;
            }

            $signalClose = isset($item['signal_close']) ? strtolower(trim($item['signal_close'])) : '';
            $closeTime = isset($item['close_time']) ? trim($item['close_time']) : '';

            if ($signalClose === '' || $closeTime === '') {
                $holdCount++;
            } else {
                $signalCloseCount++;

                // Gộp key thống kê theo chuẩn
                if (in_array($signalClose, array_keys($signalCloseTypes))) {
                    $signalCloseTypes[$signalClose]++;
                }
            }

            // Tính profit
            $profit = isset($item['profit']) && is_numeric($item['profit']) ? floatval($item['profit']) : null;

            if ($profit !== null) {
                if ($maxProfit === null || $profit > $maxProfit) {
                    $maxProfit = $profit;
                    $maxProfitCode = $item['code'];
                }

                if ($minProfit === null || $profit < $minProfit) {
                    $minProfit = $profit;
                    $minProfitCode = $item['code'];
                }
            }
        }

        return [
            'buy_count' => $buyCount,
            'signal_close_count' => $signalCloseCount,
            'hold_count' => $holdCount,
            'signal_close_types' => $signalCloseTypes,
            'highest_profit' => $maxProfit,
            'highest_profit_code' => $maxProfitCode,
            'lowest_profit' => $minProfit,
            'lowest_profit_code' => $minProfitCode,
        ];
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
        // if(!empty($subscription) && $subscription['is_trial'] == 1 && $role_id != 1){
        //     foreach ($signals as $key => $value) {
        //         $value['open_time'] = 'fas fa-lock';
        //         $value['price_open'] = 'fas fa-lock';
        //         $signals[$key] = $value;

        //     }
        // }

        $data_chart = (new GreenAlpha())->getDataChartSignals($current_version);
        $dataChartProfit = (new GreenAlpha())->getCurrentMonthProfitSum($current_version);

        $list_signal = $this->countResultSignalAlpha($signals);

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

        return view('frontend_v2.green_alpha',compact('signals',
        'chart_data','dataChartProfit','data_chart_default','list_signal'));
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
        $chart_signal = (new GreenStockNas100())->getGroupSignalV2();
        $totalCount = array_reduce($chart_signal, function ($carry, $item) {
            return $carry + $item['total'];
        }, 0);

        $labels = array_column($chart_signal, 'signal');

        $chart_signal = array_map(function($item) use ($totalCount) {
            return $totalCount > 0
                ? round($item['total'] / $totalCount * 100, 2)
                : 0;
        }, $chart_signal);
        // usort($chart_signal, function($a, $b) {
        //     return strcmp($a['signal'], $b['signal']);
        // });
        // $totalCount = array_reduce($chart_signal, function ($carry, $item) {
        //     return $carry + $item['total'];
        // }, 0);
        // $labels = array_map(function($item) {
        //     return $item['signal'];
        // }, $chart_signal);

        // $chart_signal = array_map(function($item) use ($totalCount) {
        //     return  round($item['total']/$totalCount*100,2);
        // }, $chart_signal);
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
        $nas_win = Cache::get('nas100_win');
        $nas_loss = Cache::get('nas100_loss');
        $cap = [$nas_win,$nas_loss];
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

        return view('frontend_v2.trading_system',compact('price_product'));
    }
    public function contact(){
        return view('frontend_v2.contact');
    }

    public function mission(){
        $directory = public_path('images/mission/timeline');
        $files = File::files($directory);
        $colors = ['#D80027','#EF4A25','#F1C32A','#005BBF','#00B1A7','#008000'];
        $timelineTimes = ['2012_2018', '2019', '2020', '2021', '2022', '2023'];
        foreach ($files as $key => $file) {
            $timelines[] = [
                'image' => $file->getFilename(),
                'color' => $colors[$key],
                'timeline_time' => __('mission.timelines.' . $timelineTimes[$key] . '.time'),
                'timeline_name' => __('mission.timelines.' . $timelineTimes[$key] . '.name'),
                'timeline_des' => __('mission.timelines.' . $timelineTimes[$key] . '.des')
            ];
        }

        return view('frontend_v2.mission', compact('timelines'));
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
    public function followUnfollowStock($stock_id)
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
        $chart_signal = (new VnIndex())->getGroupSignalV2();

        $totalCount = array_reduce($chart_signal, function ($carry, $item) {
            return $carry + $item['total'];
        }, 0);

        $labels = array_column($chart_signal, 'signal');

        $chart_signal = array_map(function($item) use ($totalCount) {
            return $totalCount > 0
                ? round($item['total'] / $totalCount * 100, 2)
                : 0;
        }, $chart_signal);

        // usort($chart_signal, function($a, $b) {
        //     return strcmp($a['signal'], $b['signal']);
        // });
        // $totalCount = array_reduce($chart_signal, function ($carry, $item) {
        //     return $carry + $item['total'];
        // }, 0);
        // $labels = array_map(function($item) {
        //     return $item['signal'];
        // }, $chart_signal);

        // $chart_signal = array_map(function($item) use ($totalCount) {
        //     return  round($item['total']/$totalCount*100,2);
        // }, $chart_signal);
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
        $vnindex_win = Cache::get('vnindex_win');
        $vnindex_loss = Cache::get('vnindex_loss');
        $cap = [$vnindex_win,$vnindex_loss];
        $ma = (new MaVnIndex())->getMaApi();
        $transaction_Portfolio = (new TransactionPortfolio())->getTransactionPortfolioApi();
        $current_cap =  (new SubGroupCapDetailVnIndex())->getCurrentCap();
        $marketOverview = [
            'market_cap' => $market_cap,
            'chart_group_data' => $chart_group_data,
            'top_stock' => $top_stock,
            'cap' => $cap,
            'ma' => $ma,
            'current_cap' => $current_cap,
            'transaction_Portfolio' => $transaction_Portfolio,
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
