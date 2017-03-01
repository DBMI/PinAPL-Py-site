<?php
	/* Provided variables
		$result => The result tab this selector is in
		$withControl => Boolean. True if this result tab shows control files
		$runId => The id of the run
		$runHash => The hash that serves as the run dir name
	 */
	

	$mapping = \File::get(storage_path("runs/$runHash/fileMap.json"));
	$mapping = json_decode($mapping,true);
	$files = [];
	if($withControl){
		$files = $files + $mapping['control'];
	}
	$files = $files + $mapping['treatment'];
?>
<select id="{{ $result }}_selector">
	@foreach ($files as $fileName => $fileProperties)
		<option value="{{ $fileName }}">
			{{ $fileProperties['condition'] }}_{{ $fileProperties['index'] }}
		</option>
	@endforeach
</select>

@foreach ($files as $fileName => $fileProperties)
	<div id="{{ $fileName }}_{{ $result }}">
		<h4 class="text-center">{{ $fileName }}</h4>
		@include("results.".$result."_component", 
			[ 'prefix'=>$fileProperties['condition'].'_'.$fileProperties['index'],
				'fileName'=>$fileName, 'fileProperties'=>$fileProperties,
				'runHash'=>$runHash
			])
	</div>
@endforeach

<script>
	$("#")
</script>