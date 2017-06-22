<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Run;

class CleanupRun implements ShouldQueue
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
            \Log::info("CleanupRun job cancled because it's run does not exist");
            return;
        }
        try{
            $run = $this->run;
            $status = $run->status ;
            if($status == 'finished' || $status == 'queued' || $status == 'running'){
                
                $this->delete();
            }
            else {
                $deleteThisRunJob = (new \App\Jobs\DeleteRun($run));
                dispatch($deleteThisRunJob);
                $this->delete();
            }
        }
        catch (\Exception $e) {
            $this->delete();
            $run->status = "error";
            $run->save();
            \Log::error("ERROR: An error occured in the CleanupRun Job", ['run' => $this->run]);
            throw $e;
        }
    }
}
