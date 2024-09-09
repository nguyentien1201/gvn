<?php

namespace App\Console\Commands;

use App\Helpers\Helper;
use App\Models\ConstantModel;
use App\Models\Promotion;
use App\Models\PromotionCustomer;
use App\Models\PromotionItem;
use App\Service\TelnyxApiService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendPromotion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:promotion';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send SMS for promotion';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info('Batch send promotion start at: ' . date('Y-m-d H:i:s'));
        $currentTime = date('Y-m-d H:i');
        $promotionModel = new Promotion();
        $promotions = $promotionModel->getRunPromotion($currentTime);
        $promotionIds = [];
        if (!empty($promotions)) {
            foreach ($promotions as $promotion) {
                $phone = Helper::formatPhone($promotion->phone_number);
                $message = Helper::mappingMessage($promotion, $promotion->message);
                try {
                    $messageInfo['message'] = $message;
                    $status = (new TelnyxApiService())->sendMessage($messageInfo, $phone, ConstantModel::$TYPE_MESSAGE['SMS']);
                    if ($status) {
                        (new PromotionItem())->updatePromotionItem($promotion->promotion_customer_id);
                    }
                } catch (\Exception $e) {
                    Log::error($e->getMessage());
                }
                if (!in_array($promotion->id, $promotionIds)) {
                    $promotionIds[] = $promotion->id;
                }
            }
        };
        $promotionModel->updateStatusByIds($promotionIds);
        Log::info('Batch send promotion end at: ' . date('Y-m-d H:i:s'));
        return true;
    }

}
