<?php

namespace App\Console\Commands;

use App\SMSLogic\AlertRecurrenceLogic;
use Illuminate\Console\Command;

class CheckRecurringAlertsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CheckRecurringAlerts:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for any recurring alerts that need to be sent, run daily';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $alert = new AlertRecurrenceLogic();
        $alert->checkForRecurringAlerts();
        return Command::SUCCESS;
    }
}
