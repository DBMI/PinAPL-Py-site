<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Run;

class StartRun extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:start {runId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start a queued run.';

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

        $runId = $this->argument('runId');
        try {
            $run = Run::findOrFail($runId);
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $this->error("Run $runHash does not exist");
            return;
        }

	if($run->status =="queued"){
	        dispatch((new \App\Jobs\RestartRun($run))->onQueue("start_run"));
	} else {
		$this->error("Run $runHash is not queued");
	}

    }
}
