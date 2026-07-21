<?php

namespace App\Console\Commands;

use App\Models\OtpCode;
use Illuminate\Console\Command;

class DeleteExpiresOtpCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:otp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete expires otp';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        OtpCode::where('expires_at', '<=', now())->delete();
    }
}
