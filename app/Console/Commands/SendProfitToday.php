<?php

namespace App\Console\Commands;

use App\Models\GreenAlpha;
use App\Models\Token;
use App\Service\WooCommerceApiService;
use DateTime;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Notifications\SendTelegramNotification;
use Illuminate\Support\Facades\Notification;

class SendProfitToday extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-profit-today';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send profit today';

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
        $signals = (new GreenAlpha())->getListSignalsByGroup();
        $profit_today = collect($signals)->mapWithKeys(function ($product, $key) {
            return [$product['code'] => $product['profit_today']];
        });


        $signalsMonth = (new GreenAlpha())->getListSignalsByGroupMonth();
        $profit_month = collect($signalsMonth)->mapWithKeys(function ($product, $key) {
            return [$product['code'] => $product['profit_month']];
        });


        $today = date('Y-m-d');

        // Define the profit date

        // Start building the message
        $message = "🟢<b>PROFIT TRANDING ". $today."</b>🟢\n";

        // Loop through the indices and append them to the message
        foreach ($profit_month as $index => $value) {
            $code = "<b>".$index."</b>";
            if(empty($value)){
                $value = 0;
            }
            $today = $profit_today[$index] ??  '';
if(empty($today)){
    $today = 0;
            }

                        $message .= sprintf("%s---Today: %.2f%%---Month: %.2f%%\n", $code, $today, $value);
        }

        // Output the final message
        // dd( $message);



        // $profit = 0;
        // $result = array_reduce($signals, function ($carry, $item) use (&$profit) {
        //     $profit_today = empty($item['profit_today']) ? 0: $item['profit_today'];
        //     $profit += $profit_today;
        //     return $profit;
        // }, []);
        // if($profit >=0){
        //     $color = '🟢';
        // }else{
        //     $color = '🔴';
        // }
        // $today = date('Y-m-d');
        // $message = " <b>Profit trading ".$today.": ". $profit ."% " . $color ."</b>";
        try {
            Notification::route('telegram', config('telegram.group_id'))->notify(new SendTelegramNotification($message));
        } catch (\Exception $e) {
            \Log::info($message);
            \Log::error($e->getMessage());
        }

        return true;
    }
}
