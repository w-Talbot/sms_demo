<?php

namespace App\Console\Commands;

use App\SMSLogic\PHCSMS;
use Illuminate\Console\Command;

class CheckNewAlertsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CheckNewAlerts:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for any new alerts, run daily';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $newAlert = new PHCSMS();
        $newAlert->checkForNEWAlerts();
    }
}
