<div class="row align-middle">
	<div class="column medium-6">
		<img src='{{"/run-images?path=".urlencode("/$runHash/workingDir/Analysis/Alignment_Statistics/$prefix/$prefix"."_MappingQuality.png")}}'>
	</div>
	<div class="column medium-6">
		<img src='{{"/run-images?path=".urlencode("/$runHash/workingDir/Analysis/Alignment_Statistics/$prefix/$prefix"."_AlignmentScores.png")}}'>
	</div>
</div>
<hr>
<div class="row align-center">
	<div class="column shrink">
		<pre>{{ \File::get(storage_path("runs/$runHash/workingDir/Analysis/Alignment_Statistics/$prefix/$prefix"."_AlignmentResults.txt")) }}</pre>
	</div>
</div>