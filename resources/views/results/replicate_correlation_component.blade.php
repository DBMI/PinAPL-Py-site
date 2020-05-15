<?php
	/* Provided variables
		$result => The result tab this selector is in
		$withControl => Boolean. True if this result tab shows control files
		$runId => The id of the run
		$runHash => The hash that serves as the run dir name
	 */


	$files = \File::glob(storage_path("runs/$runHash/workingDir/Analysis/02_sgRNA-Ranking_Results/Replicate_Correlation/*.png"));

	$shrink = empty($fullSize) ? 'shrink' : '';
?>

<div class="row align-middle">
	<div class="column">
		<select id="{{ $result }}_selector">
			@foreach ($files as $file)	
				@php 
					$fileName = basename($file, ".png");
					$displayName = str_replace("counts_", "", $fileName);
					$displayName = str_replace("_nonT", "", $displayName);
				@endphp
				<option value="{{ $fileName }}" data-filename="{{ $displayName }}">
					{{ $displayName }}
				</option>
			@endforeach
		</select>
	</div>
</div>
@php $firstDrawn=true; @endphp 
@foreach ($files as $file)
	@php 
		$fileName = basename($file, ".png"); 
	@endphp
	<div class="row align-center" id="{{$fileName}}_{{ $result }}" @if (!$firstDrawn) style="display:none;" @endif>
		<div class="column {{ $shrink }}">
			<img src='{{"/run-images?path=".urlencode("/$runHash/workingDir/Analysis/02_sgRNA-Ranking_Results/Replicate_Correlation/".basename($file))}}'>
		</div>
	</div>
	@php $firstDrawn = false; @endphp
@endforeach

<script>
	$("#{{ $result }}_selector").change(function () {
		fileSelectorChange("{{ $result }}")
	});
	function fileSelectorChange(param) {
		var selected = $("#"+param+"_selector").val();
		$("[id$=_"+param+"]").hide();
		$("[id='"+selected+"_"+param+"']").show();
	}
</script>