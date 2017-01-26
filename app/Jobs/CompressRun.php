<?php

namespace App\Jobs;

use \App\Run;



class CompressRun extends Job
{
    protected $run;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($run)
    {
        if ((empty($run)) ||(!$run->exists)) {
            $this->delete();
            return false;
        }
        else{
            $this->run = $run;
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ((empty($this->run)) || (!$this->run->exists)) {
            $this->delete();
            \Log::info("MonitorRun job cancled because it's run does not exist");
            return;
        }
        try{
            $run = $this->run;
            $dir = $run->directory();
            $tarCmd = "tar -C $dir -zcf $dir/archive.tgz workingDir/Alignments workingDir/Analysis workingDir/configuration.yaml workingDir/Library workingDir/output.log";
            $compressResults = `$tarCmd`;
            $run->status = 'finished';
            $run->save();
        }
        catch (Exception $e) {
            \Log::error("ERROR: An error occured compressing a run", ['run' => $this->run]);
            $this->delete();
            $run->status = "Error";
            $run->save();
            throw $e;
        }
    }
}
