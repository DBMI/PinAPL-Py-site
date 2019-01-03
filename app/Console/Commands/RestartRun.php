<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Run;

class RestartRun extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:restart {runId}';

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

        $runId = $this->argument('runId');
        try {
            $run = Run::findOrFail($runId);
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $this->error("Run $runHash does not exist");
            return;
        }

        
        dispatch((new \App\Jobs\RestartRun($run))->onQueue("start_run"));


    }
}
