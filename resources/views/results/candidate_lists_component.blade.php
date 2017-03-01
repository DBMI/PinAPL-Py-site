<?php
use Illuminate\Support\Facades\File;

foreach (File::allFiles(storage_path()."/runs/$runHash/workingDir/Analysis/Candidate_Lists") as $file) {
	$baseName = basename($file);
	if (substr($baseName, 0, strlen($prefix)) !== $prefix){
		continue;
	}
	echo (svToHTML($file, "\t") );
}

