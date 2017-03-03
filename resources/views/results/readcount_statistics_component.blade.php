<div class="row align-middle">
	<div class="column shrink">
		<?php
		$file = \File::glob(storage_path("runs/$runHash/workingDir/Analysis/ReadCount_Statistics/$prefix/*LorenzCurves.png"));
		$file = array_pop($file);
		$link = "/run-images?path=".urlencode("/$runHash/workingDir/Analysis/ReadCount_Statistics/$prefix/".basename($file));
		?>
		<img src='{{ $link }}' style="height:550px;"">
	</div>
	<div class="column">
		<?php
		$file = \File::glob(storage_path("runs/$runHash/workingDir/Analysis/ReadCount_Statistics/$prefix/*ReadCount_Distribution.png"));
		$file = array_pop($file);
		$link = "/run-images?path=".urlencode("/$runHash/workingDir/Analysis/ReadCount_Statistics/$prefix/".basename($file));
		?>
		<img src='{{ $link }}'>
	</div>
</div>