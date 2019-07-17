<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Run;

class RestartQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:restart-queue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Restart a frozen run. Warning: This assumes the docker image has crashed, and there is no monitor running.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        try {
	    if (Run::where('status','running')->count() > 0){
            	$run = Run::where('status','running')->first();
	    } else if (Run::where('status','queued')->count() > 0){
		$run = $run = Run::where('status','queued')->first();
	    } else{
               $this->error("No crashed runs to restart and no runs in the queue to start");
	    }
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $this->error("Run $runHash does not exist");
            return;
        }

        
        dispatch((new \App\Jobs\RestartRun($run))->onQueue("start_run"));


    }
}
