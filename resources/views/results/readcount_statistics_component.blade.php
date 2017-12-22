@php
	$statFileBasename = "$prefix"."_ReadCount_Statistics.txt";
	$statisticsTextFile = storage_path("runs/$runHash/workingDir/Analysis/ReadCount_Statistics/$prefix/$statFileBasename");
@endphp
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
<hr>
<div class="row align-center">
	<div class="column shrink">
		@if (\File::exists($statisticsTextFile))
			<pre>{{ \File::get($statisticsTextFile) }}</pre>
		@else
			<span>Could not load {{$statFileBasename}}</span>
		@endif
	</div>
</div>