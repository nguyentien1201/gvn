<?php
namespace App\Http\Controllers\Front;

use App\Models\Product;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ConstantModel;
use Carbon\Carbon;
class SubscriptionController
{
    public function store(Request $request)
    {

        $request->validate([
            'id' => 'required|exists:products,id',
        ]);
        if($request->month !=6) {
            \Log::info('User ' . Auth::id() . ' is trying to subscribe with month: ' . $request->month);
            return redirect()->route('logout');
        }
        $product = Product::find($request->id)->toArray();
        $data = [
            'user_id' => Auth::id(),
            'product_id' => $product['id'],
            'start_date' => now(),
        ];
        if($request->type == 'trial'){
            $data['is_trial'] = 1;
            $data['price'] = 0;
        }else {
            $data['is_trial'] = 0;
            $data['price'] = $product[ConstantModel::MONTH_PRICE[$request->month]] ?? NULL;
        }

        $subscription = Subscription::where('user_id', Auth::id())->where('product_id', $product['id'])->first();

        if($subscription){
            $now = Carbon::now();
            $subscriptionEndDate = Carbon::parse($subscription->end_date);
            if ($subscriptionEndDate->greaterThan($now) && $subscription->is_trial == 1) {
                return ['status' => 'error', 'message' => 'Bạn đang sử dụng gói dùng thử, vui lòng đợi hết hạn để đăng ký gói mới'];
            }

            if($request->month == 1){
                $data['end_date'] = $subscriptionEndDate->addMonth();
            }
            if($request->month == 6){
                $data['end_date'] =  $subscriptionEndDate->addMonths(6);
            }
            if($request->month == 3){
                $data['end_date'] =  $subscriptionEndDate->addYear();
            }
            $subscription->update($data);

        }else {
             if($request->month == 1){
                $data['end_date'] =  now()->addMonth();
            }
            if($request->month == 6){
                $data['end_date'] = now()->addMonths(6);
            }
            if($request->month == 3){
                $data['end_date'] = now()->addYear();
            }

            Subscription::create($data);
        }
        // Lưu thông tin mua gói sản phẩm
       return  ['status' => 'success', 'message' => 'Đăng ký thành công'];
    }
    public function getProduct(Request $request)
    {

        $product = Product::find($request->product_id);

        return response()->json(['product'=>$product]);
    }
    public function apiUpdateSubscription(Request $request)
    {

        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $product = Product::find($request->product_id)->toArray();

        $data = [
            'user_id' => Auth::id(),
            'product_id' => $product['id'],
            'start_date' => now(),
        ];
        if($request->type == 'trial'){
            $data['is_trial'] = 1;
            $data['price'] = 0;
        }else {
            $data['is_trial'] = 0;
            $data['price'] = $product[ConstantModel::MONTH_PRICE[$request->month]] ?? NULL;
        }

        $subscription = Subscription::where('user_id', Auth::id())->where('product_id', $product['id'])->first();
        if($subscription){
            $subscriptionEndDate = Carbon::parse($subscription->end_date);
            if($request->month == 1){
                $data['end_date'] = $subscriptionEndDate->addMonth();
            }
            if($request->month == 2){
                $data['end_date'] =  $subscriptionEndDate->addMonths(6);
            }
            if($request->month == 3){
                $data['end_date'] =  $subscriptionEndDate->addYear();
            }

            try {
                $subscription->update($data);
                return response()->json(['status' => 'success', 'message' => 'Gia hạn thành công']);
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => 'Đăng ký không thành công']);
            }


        }else {

             if($request->month == 1){
                $data['end_date'] =  now()->addMonth();
            }
            if($request->month == 2){

                $data['end_date'] = now()->addMonths(6);
            }
            if($request->month == 3){
                $data['end_date'] = now()->addYear();
            }
            Subscription::create($data);
            return response()->json(['status' => 'success', 'message' => 'Gia hạn thành công']);
        }
        // Lưu thông tin mua gói sản phẩm
    }
}
