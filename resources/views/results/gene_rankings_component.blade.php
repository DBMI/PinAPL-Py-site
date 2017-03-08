<?php
$files = \File::glob(storage_path("runs/$runHash/workingDir/Analysis/Gene_Rankings/$prefix*.tsv"));
?>
@foreach ($files as $file)
{!! svToHTML($file, "\t") !!}
@endforeach