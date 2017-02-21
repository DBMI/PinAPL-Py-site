<?php
use Illuminate\Support\Facades\File;

// $filePrefixes = File::directories($run->directory()."/workingDir/Alignments");
// foreach ($filePrefixes as $key => $value) {
// 	$filePrefixes[$key] = basename($value);
// }
?>
 @foreach (File::allFiles($run->directory()."/workingDir/Analysis/Candidate_Lists") as $file)
	<label>{{ basename($file) }}</label>
	{!! svToHTML($file, "\t") !!}
 @endforeach