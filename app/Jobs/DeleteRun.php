<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use \App\Run;


class DeleteRun implements ShouldQueue
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
        $run = $this->run;
        if ((empty($this->run)) || (!$this->run->exists)) {
            $this->delete();
            \Log::info("DeleteRun job cancled because it's run does not exist");
            return;
        }
        try{
            $run->delete();
        }
        catch (\Exception $e) {
            \Log::error("ERROR: An error occured while deleting a run", ['run' => $this->run]);
            \Log::error("$e");
            $this->delete();
            throw $e;
        }    
    }
}
