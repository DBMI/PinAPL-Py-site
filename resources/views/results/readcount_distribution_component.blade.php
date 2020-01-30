<div class="row align-middle">
	<div class="column medium-4">
		<img src='{{"/run-images?path=".urlencode("/$runHash/workingDir/Analysis/02_sgRNA-Ranking_Results/ReadCount_Distribution/$prefix/$prefix"."_LorenzCurves.png")}}'>
	</div>
	<div class="column medium-8">
		<img src='{{"/run-images?path=".urlencode("/$runHash/workingDir/Analysis/02_sgRNA-Ranking_Results/ReadCount_Distribution/$prefix/$prefix"."_ReadCount_Distribution.png")}}'>
	</div>
</div>
<hr>
<div class="row align-center">
	<div class="column shrink">
		<pre>{{ \File::get(storage_path("runs/$runHash/workingDir/Analysis/02_sgRNA-Ranking_Results/ReadCount_Distribution/$prefix/$prefix"."_ReadCount_Statistics.txt")) }}</pre>
	</div>
</div>