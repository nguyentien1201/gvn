<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\Token;
use App\Service\WooCommerceApiService;
use DateTime;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SyncOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync orders from woocommerce web';

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
        $orderModel = new Order();
        Log::info('Batch sync order start at: ' . date('Y-m-d H:i:s'));
        $tokens = Token::all();
        $orderCntByWebsite = $orderModel->getOrderCntByWebsite();
        DB::beginTransaction();
        try {
            foreach ($tokens as $token) {
                $wcApiService = new WooCommerceApiService($token);
                $before = date('Y-m-d\TH:i:s');
                $after = null;
                if (isset($orderCntByWebsite[$token->website])) {
                    $after = date('Y-m-d\T00:00:00', strtotime("-1 days"));
                }
                $orders = $wcApiService->getOrders($before, $after);
                if ($orders) {
                    $orderModel->insertListOrders($orders, $token->website, $wcApiService);
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }
        Log::info('Batch sync order end at: ' . date('Y-m-d H:i:s'));
        return true;
    }
}
