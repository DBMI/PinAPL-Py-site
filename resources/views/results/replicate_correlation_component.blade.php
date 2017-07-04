<?php
$files = \File::glob(storage_path("runs/$runHash/workingDir/Analysis/Replicate_Correlation/*.png"));
?>
@foreach ($files as $file)
	<div class="row align-center">
		<div class="column shrink">
			<img src='{{"/run-images?path=".urlencode("/$runHash/workingDir/Analysis/Replicate_Correlation/".basename($file))}}'>
		</div>
	</div>
@endforeach