<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use \App\Run;
use \Illuminate\Support\Facades\File;
use \Illuminate\Support\Facades\Mail;
use \App\Mail\RunFinished;


class CompressRun implements ShouldQueue
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
            $dir = $run->directory();
            $archiveName = sanitizeFileName($run->name)."_$run->dir";
            makeDir($dir."/".$archiveName);
            `ln -s $dir/workingDir/Analysis $dir/$archiveName/Analysis`;
            `ln -s $dir/workingDir/configuration.yaml $dir/$archiveName/configuration.yaml`;
            `ln -s $dir/workingDir/output.log $dir/$archiveName/output.log`;
            $zipCommand = "cd $dir && zip -r archive.zip $archiveName";
            $zipStatus = `$zipCommand`;
            File::deleteDirectory($dir."/$archiveName");
            File::deleteDirectory($dir."/workingDir/Alignments");
            // File::deleteDirectory($dir."/workingDir/Library");
            $run->importRankings();
            $run->status = 'finished';
            $run->save();
            if (!empty($run->email)) {
                Mail::to($run->email)->queue(new RunFinished($run));
            }

            // TODO if run exists 

        }
        catch (Exception $e) {
            \Log::error("ERROR: An error occured compressing a run", ['run' => $this->run]);
            $this->delete();
            $run->status = "error";
            $run->save();
            throw $e;
        }
    }
}
