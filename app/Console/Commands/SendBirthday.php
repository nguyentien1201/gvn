<?php

namespace App\Console\Commands;

use App\Helpers\Helper;
use App\Models\ConstantModel;
use App\Models\Order;
use App\Service\TelnyxApiService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendBirthday extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:birthday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send SMS for birthday';

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
        Log::info('Batch send birthday start at: ' . date('Y-m-d H:i:s'));
        $orders = (new Order())->getListOrderSentBirthday();
        if (!empty($orders)) {
            foreach ($orders as $order) {
                $phone = Helper::formatPhone($order->phone);
                $message = trim(__('order.' . strtolower($order->website) . '_birthday'));
                try {
                    $messageInfo['message'] = Helper::mappingMessage($order, $message);
                    $status = (new TelnyxApiService())->sendMessage($messageInfo, $phone, ConstantModel::$TYPE_MESSAGE['SMS']);
                    if ($status) {
                        $order->update(['last_time_sent_birthday' => date('Y-m-d H:i:s')]);
                    }
                    Log::info('Send sms birthday is success for order: ' . $order->order_id);
                } catch (\Exception $e) {
                    Log::error($e->getMessage());
                    Log::error('Send sms birthday is failed for order: ' . $order->order_id);
                }
            }
        }
        Log::info('Batch send birthday end at: ' . date('Y-m-d H:i:s'));
        return true;
    }

}
