<?php

namespace App\Console\Commands;

use App\Models\VnIndex;
use App\Models\Token;
use App\Service\WooCommerceApiService;
use DateTime;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SyncVnIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:vnindex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Nas100 from google drive';

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
        $orderModel = new VnIndex();
        Log::info('Batch sync order start at: ' . date('Y-m-d H:i:s'));

        DB::beginTransaction();
        try {
            $orderModel->import();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }
        Log::info('Batch sync order end at: ' . date('Y-m-d H:i:s'));
        return true;
    }
}
