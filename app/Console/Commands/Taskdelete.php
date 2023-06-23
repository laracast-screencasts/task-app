<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task; 

class Taskdelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:taskdelete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Every hour delete 30 days old tasks records.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $date = \Carbon\Carbon::today()->subDays(30);
        $tasks = Task::where('created_at','<=',$date)->delete();
    }
}
