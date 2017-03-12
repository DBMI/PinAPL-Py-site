<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

// Allows this Job to release itself
use Illuminate\Contracts\Bus\SelfHandling;


use App\Run;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class MonitorRun implements ShouldQueue
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
                    $nextRun = Run::where('status','queued')->first();
                    if (!empty($nextRun)) {
                        $nnextRunJob = (new \App\Jobs\StartRun($nextRun))
                                ->onQueue("start_run");       
                        dispatch($nnextRunJob);
                    }
                    $deleteThisRunJob = (new \App\Jobs\DeleteRun($run))
                                        ->delay(Carbon::now()->addDays(5));
                    dispatch($deleteThisRunJob);
                    break;
                case 'errored':
                case 'error':
                    $run->status='error';
                    $run->save;
                    break;
                case 'running':
                default:
                    $delayTime = 30;
                    if ($this->attempts() >= 250) {
                        $job = (new \App\Jobs\MonitorRun($run))
                                ->onQueue("monitor")
                                ->delay($delayTime);
                        dispatch($job);
                        $this->delete();
                    } else {
                        $this->release($delayTime);
                    }
                    break;
            }
        }
        catch (\Exception $e) {
            $this->delete();
            $run->status = "error";
            $run->save();
            \Log::error("ERROR: An error occured while monitoring a run", ['run' => $this->run]);
            throw $e;
        }
    }
}
