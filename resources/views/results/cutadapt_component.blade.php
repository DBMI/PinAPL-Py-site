@php
	$file = \File::glob(storage_path("runs/$runHash/workingDir/Analysis/Read_Trimming/cutadapt_$fileName*.txt")) ;
	$file = \File::get(array_shift($file));
@endphp
<div class="row align-center">
	<div class="column shrink">
		<pre>{{ $file }}</pre>
	</div>
</div>