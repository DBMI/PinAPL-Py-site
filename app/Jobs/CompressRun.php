<?php

namespace App\Jobs;

use \App\Run;
use \Illuminate\Support\Facades\File;
use \Illuminate\Support\Facades\Mail;
use \App\Mail\RunFinished;


class CompressRun extends Job
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
            File::deleteDirectory($dir."/workingDir/Data");
            File::deleteDirectory($dir."/workingDir/Library");
            $run->status = 'finished';
            $run->save();
            Mail::to($run->email)->send(new RunFinished($run));

        }
        catch (Exception $e) {
            \Log::error("ERROR: An error occured compressing a run", ['run' => $this->run]);
            $this->delete();
            $run->status = "Error";
            $run->save();
            throw $e;
        }
    }
}
