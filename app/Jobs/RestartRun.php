<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Support\Facades\File;

class RestartRun implements ShouldQueue
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
        $run->status='restarting';
        $run->save();
        $runDir = $run->directory();
        $tempDir = $runDir."_temp";
        `mv $runDir $tempDir`;
        makeDir($runDir,0775);
        makeDir($runDir.'/workingDir', 0775);
        exec('cp -r '.$tempDir.'/runCmd.sh '.$runDir.'/');
        exec('cp -r '.$tempDir.'/workingDir/Data '.$runDir.'/workingDir/Data');
        exec('cp -r '.$tempDir.'/workingDir/configuration.yaml '.$runDir.'/workingDir/');
        exec('cp -r '.$tempDir.'/workingDir/DataSheet.xlsx '.$runDir.'/workingDir/');
        exec('cp -r '.$tempDir.'/workingDir/Library '.$runDir.'/workingDir/Library');

        `rm -rf $tempDir`;

        // if (!empty($run->email)) {
        //     \Illuminate\Support\Facades\Mail::to($run->email)->queue(new \App\Mail\RunCreated($run));
        // }


        dispatch((new \App\Jobs\StartRun($run))->onQueue("start_run"));
    }
}
