<?php

namespace App\Jobs;

// Allows this Job to release itself
use Illuminate\Contracts\Bus\SelfHandling;


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
            return;
        }
        try{
            $run = $this->run;
            $logFile = $run->directory()."/output.log";
            $statusFile = $run->directory()."/status.log";
            $status = File::get($statusFile);
            $status = trim(strtolower($status));
            switch ($status) {
                case 'finished':
                    $run->status='compressing';
                    $run->save();
                    dispatch(new \App\Jobs\CompressRun($run));
                    break;
                case 'errored':
                case 'error':
                    $run->status='error';
                    $run->save;
                    break;
                case 'running':
                default:
                    $this->release(10);
                    break;
            }
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
