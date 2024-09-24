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
            $subscription->update($data);

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
        }
        // Lưu thông tin mua gói sản phẩm
       return  ['status' => 'success', 'message' => 'Đăng ký thành công'];
    }
}
