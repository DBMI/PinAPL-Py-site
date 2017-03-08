<?php
$files = \File::glob(storage_path("runs/$runHash/workingDir/Analysis/sgRNA_Rankings/$prefix*.tsv"));
?>
@foreach ($files as $file)
{!! svToHTML($file, "\t") !!}
@endforeach