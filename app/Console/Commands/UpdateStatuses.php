<?php

namespace App\Console\Commands;

use App\Models\Goal;
use App\Models\Plan;
use App\Models\Task;
use Illuminate\Console\Command;

class UpdateStatuses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update-status:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'to update all tasks , plans, golas statuses due to end date and set the notification flag if time is exceded';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Plan::where([
            ['timeframe_end_date', '<', now()]
        ])->update(['status' => 2, 'actual_end_date' => now(), 'notification_status' => 1]); // exceded in red
        Task::where([
            ['timeframe_end_date', '<', now()]
        ])->update(['status' => 2, 'actual_end_date' => now(), 'notification_status' => 1]); // exceded in red
        Goal::where([
            ['timeframe_end_date', '<', now()]
        ])->update(['status' => 2, 'actual_end_date' => now(), 'notification_status' => 1]); // exceded in red
        return Command::SUCCESS;
    }
}
