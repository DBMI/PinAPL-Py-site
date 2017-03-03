<?php
$files = \File::glob(storage_path("runs/$runHash/workingDir/Analysis/Gene_Rankings/$prefix*"));
?>
@foreach ($files as $file)
{!! svToHTML($file, "\t") !!}
@endforeach