<?php

namespace App\Jobs;

use \App\Run;



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
            \Illuminate\Support\Facades\File::deleteDirectory($dir."/$archiveName");
            \Illuminate\Support\Facades\File::deleteDirectory($dir."/workingDir/Alignments");
            \Illuminate\Support\Facades\File::deleteDirectory($dir."/workingDir/Data");
            \Illuminate\Support\Facades\File::deleteDirectory($dir."/workingDir/Library");
            $run->status = 'finished';
            $run->save();
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
