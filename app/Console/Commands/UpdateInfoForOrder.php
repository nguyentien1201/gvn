<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\Token;
use App\Service\WooCommerceApiService;
use DateTime;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateInfoForOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:order {column} {from?} {to?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update order info';

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
        Log::info('Batch update order start at: ' . date('Y-m-d H:i:s'));
        $orderModel = new Order();
        $column = $this->argument('column');
        $from = $this->argument('from');
        $to = $this->argument('to');
        $tokens = Token::all();
        DB::beginTransaction();
        try {
            foreach ($tokens as $token) {
                $wcApiService = new WooCommerceApiService($token);
                $orders = $orderModel->getOrderCodeByWebsite($token->website, $from, $to);
                if ($orders) {
                    $orderInfo = $wcApiService->getOrderByIds(array_values($orders));
                    foreach ($orderInfo as $order) {
                        $columnData = $order->billing && $order->billing->{$column} ? $order->billing->{$column} : '';
                        $orderId = array_search($order->id, $orders);
                        $orderModel->updateOrder($orderId, [$column => $columnData]);
                    }
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }
        Log::info('Batch update order end at: ' . date('Y-m-d H:i:s'));
        return true;
    }
}
