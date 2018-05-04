<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \App\GeneRanking;
use \App\GeneCombinedRanking;
use \App\SgrnaRanking;
use \App\Run;

class ReimportExampleRankings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ExampleRun:ReimportRankings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reimport the rankings for the example-run from it\'s files';

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
        GeneRanking::where('dir','example-run')->delete();
        GeneCombinedRanking::where('dir','example-run')->delete();
        SgrnaRanking::where('dir','example-run')->delete();
        Run::importRankings('example-run');
    }
}
