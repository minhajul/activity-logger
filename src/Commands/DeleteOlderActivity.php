<?php

namespace Minhajul\ActivityLogger\Commands;

use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Minhajul\ActivityLogger\Models\Activity;

class DeleteOlderActivity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:activity';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Remove older activity from database!";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $tableName = (new Activity())->getTable();

        $days = config('activity-log.delete_activity');
        $deletedActivities = Activity::where('created_at', '<=', Carbon::now()->subDays($days))->delete();

        $this->info("Deleted {$deletedActivities} rows from {$tableName} table!");
    }
}

