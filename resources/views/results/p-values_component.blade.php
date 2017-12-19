<div class="row">
	<div class="column medium-6">
		<img src='{{"/run-images?path=".urlencode("/$runHash/workingDir/Analysis/p-values/$prefix/$prefix"."_sgRNA_Significance.png")}}'>
	</div>
	<div class="column medium-6">
		<img src='{{"/run-images?path=".urlencode("/$runHash/workingDir/Analysis/p-values/$prefix/$prefix"."_sgRNA_volcano.png")}}'>
	</div>
</div>
<div class="row">
	<div class="column medium-6">
		<img src='{{"/run-images?path=".urlencode("/$runHash/workingDir/Analysis/p-values/$prefix/$prefix"."_sgRNA_QQ.png")}}'>
	</div>
	<div class="column medium-6">
		<img src='{{"/run-images?path=".urlencode("/$runHash/workingDir/Analysis/p-values/$prefix/$prefix"."_sgRNA_zScores.png")}}'>
	</div>
</div>
@if (!str_contains($prefix, 'avg'))
	<div class="row">
		<div class="column medium-6">
			<img src='{{"/run-images?path=".urlencode("/$runHash/workingDir/Analysis/p-values/$prefix/$prefix"."_Gene_Significance.png")}}'>
		</div>
	</div>
@endif