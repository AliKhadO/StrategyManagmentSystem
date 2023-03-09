<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DailyNotify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily-notify:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify the admins/managers of daily tasks that exceeded end date ';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
