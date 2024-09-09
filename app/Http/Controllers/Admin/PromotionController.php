<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Requests\Promotion\StorePromotionRequest;
use App\Http\Requests\Promotion\UpdatePromotionRequest;
use App\Models\ConstantModel;
use App\Models\Customer;
use App\Models\Promotion;
use App\Models\PromotionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PromotionController extends AdminController
{
    protected $customerModel;
    protected $promotionModel;
    protected $promotionItem;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->customerModel = new Customer();
        $this->promotionModel = new Promotion();
        $this->promotionItem = new PromotionItem();
    }

    public function index(Request $request)
    {
        $status = ConstantModel::PROMOTION_STATUS;
        $promotions = $this->promotionModel->getList($request);
        $promotionBtn = ConstantModel::PROMOTION_STATUS_BACKGROUND;
        foreach ($promotions as &$promotion) {
            $promotionTotal = $this->promotionItem->getCnt($promotion->id);
            $promotion->sent = $promotionTotal->sent;
            $promotion->total = $promotionTotal->total;
        }
        return view('admin.promotions.index', compact('status', 'promotions', 'promotionBtn'));
    }

    public function create(Request $request)
    {
        $customers = Customer::all();
        $orderTags = ConstantModel::ORDER_TAGS;
        return view('admin.promotions.create', compact('customers', 'orderTags'));
    }

    public function store(StorePromotionRequest $request): \Illuminate\Http\RedirectResponse
    {
        $status = $this->savePromotion($request, new Promotion());
        if ($status) {
            return redirect()->route('admin.promotions.index')->with('success', __('panel.success'));
        }
        return redirect()->route('admin.promotions.index')->with('fail', __('panel.fail'));
    }

    public function edit(Promotion $promotion)
    {
        $customers = Customer::all();
        $customerIds = $this->promotionItem->getCustomerIdsByPromotionId($promotion->id);
        $orderTags = ConstantModel::ORDER_TAGS;
        if (Customer::count() == count($customerIds)) {
            $promotion->is_all_customer = true;
        }
        return view('admin.promotions.edit', compact('customers', 'customerIds', 'orderTags', 'promotion'));
    }

    public function update(UpdatePromotionRequest $request, Promotion $promotion): \Illuminate\Http\RedirectResponse
    {
        $status = $this->savePromotion($request, $promotion);
        if ($status) {
            return redirect()->route('admin.promotions.index')->with('success', __('panel.success'));
        }
        return redirect()->route('admin.promotions.index')->with('fail', __('panel.fail'));
    }

    public function destroy(Promotion $promotion)
    {
        DB::beginTransaction();
        try {
            $this->hardRemoveData($promotion->id, 'promotion_order');
            $promotion->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.promotions.index')->with('fail', __('panel.fail'));
        }
        return redirect()->route('admin.promotions.index')->with('success', __('panel.success'));
    }

    private function savePromotionItem($promotionId, $customerIds)
    {
        if ($customerIds) {
            DB::beginTransaction();
            $this->hardRemoveData($promotionId, 'promotion_items');
            foreach ($customerIds as $customerId) {
                try {
                    PromotionItem::create(['promotion_id' => $promotionId, 'customer_id' => $customerId]);
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                }
            }
        }
    }

    public function hardRemoveData($promotionId, $table)
    {
        try {
            DB::table($table)->where('promotion_id', $promotionId)->delete();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        return true;
    }

    private function savePromotion(Request $request, Promotion $promotion)
    {
        Helper::bindingDataFromRequest($request, 'execution_time', 'DATETIME');
        $promotion->fill($request->all());
        DB::beginTransaction();
        try {
            $promotion->save();
            //save promotion_order
            $customerIds = $request->customer_ids;
            if (in_array(0, $customerIds)) {
                $customerIds = $this->customerModel->getCustomerIds();
            }
            $this->savePromotionItem($promotion->id, $customerIds);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            return false;
        }
    }
}
