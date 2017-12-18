<?php
	/* Provided variables
		$result => The result tab this selector is in
		$withControl => Boolean. True if this result tab shows control files
		$runId => The id of the run
		$runHash => The hash that serves as the run dir name
	 */
	

	$mapping = \App\Run::getMapping($runHash);

	$shrink = empty($fullSize) ? 'shrink' : '';
	$beforeSelectorRow = $beforeSelectorRow ?? "";
	$afterSelectorRow = $afterSelectorRow ?? "";
	$afterSelectorColumn = $afterSelectorColumn ?? "";
	$extraMapping = $extraMapping ?? [];

	if (!empty($withCombinedPrefix) && $withCombinedPrefix) {
		$treatments = $mapping->unique('treatment');
		$treatments = $treatments->pluck('treatment');
		foreach ($treatments as $treatment) {
			$mapping->push((object)[
				'0' => count($mapping),
				'filename' => "",
				'treatment' => $treatment,
				'sample_name' => $treatment."_combined"
			]);
		}
	}
	if (!empty($withAvgPrefix) && $withAvgPrefix) {
		$treatments = $mapping->unique('treatment');
		$treatments = $treatments->pluck('treatment');
		foreach ($treatments as $treatment) {
			$mapping->push((object)[
				'0' => count($mapping),
				'filename' => "",
				'treatment' => $treatment,
				'sample_name' => $treatment."_avg"
			]);
		}
	}

	if (!empty($extraMapping)) {
		$mapping = array_merge($mapping, $extraMapping);
	}

?>
{!! $beforeSelectorRow !!}
<div class="row align-middle">
	<div class="column">
		<select id="{{ $result }}_selector">
			@foreach ($mapping as $file)
				@if ($file->treatment!='Control' || $withControl)
					<option value="{{ $file->sample_name }}" data-filename="{{ $file->filename }}">
						{{ $file->sample_name }} ({{ $file->filename }})
					</option>
				@endif
			@endforeach
		</select>
	</div>
	{!!$afterSelectorColumn !!}
</div>
{!! $afterSelectorRow !!}
@php $firstDrawn=true; @endphp 
@foreach ($mapping as $file)
	@if ($file->treatment!='Control' || $withControl)
		<div class="row align-center" id="{{ $file->sample_name }}_{{$result}}" @if (!$firstDrawn) style="display:none;" @endif>
			<div class="column {{ $shrink }}">
				@include("results.".$result."_component", 
					[ 'prefix'=>$file->sample_name,
					  'fileName'=>$file->filename,
					  'treatment'=>$file->treatment,
					  'runHash'=>$runHash
					])
			</div>
		</div>
		@php $firstDrawn = false; @endphp
	@endif
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
