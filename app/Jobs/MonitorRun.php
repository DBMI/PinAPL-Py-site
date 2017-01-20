<?php

namespace App\Jobs;

use App\Run;
use Illuminate\Support\Facades\File;


class MonitorRun extends Job
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
            \Log::info(print_r($this->run, true));
            return;
        }
        try{
            $run = $this->run;
            $logFile = $run->directory()."/output.log";
            $statusFile = $run->directory()."/status.log";

            File::put($run->directory()."/job.log", "Jobs done");
        }
        catch (\Exception $e) {
            $this->delete();
            $run->status = "Error";
            $run->save();
            \Log::error("ERROR: An error occured while monitoring a run", ['run' => $this->run]);
            throw $e;
        }
    }
}
