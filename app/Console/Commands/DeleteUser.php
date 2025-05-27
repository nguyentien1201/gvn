<?php

namespace App\Console\Commands;

use App\Helpers\Helper;
use App\Models\ConstantModel;
use App\Models\User;
use App\Service\TelnyxApiService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DeleteUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:user';

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
        $users = User::where('is_active', 0)
            ->where('updated_at', '<=', now()->subDays(1))
            ->get();
            $users->each(function ($user) {
                $user->delete();
                Log::info('Deleted user: ' . $user->id);
            });
        Log::info('Batch send birthday end at: ' . date('Y-m-d H:i:s'));
        return true;
    }

}
