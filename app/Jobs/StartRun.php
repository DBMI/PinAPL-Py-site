<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Support\Facades\File;

class StartRun implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $run;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($run)
    {
        $this->run = $run;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $run = $this->run;
        $run->status='running';
        $run->save();
        $dir = $run->directory();
        $runPID = shell_exec("nohup bash $dir/runCmd.sh > $dir/nohup.out 2>&1 & echo $!");
        File::put("$dir/run.pid", $runPID);

        dispatch((new \App\Jobs\MonitorRun($run))->onQueue("monitor"));
    }
}
