@php
	$_nonTStr = $extraData['nonT'] ? "_nonT" : "" ;
@endphp

<img id="{{ $prefix }}-volcano-plot" src='{{"/run-images?path=".urlencode("/$runHash/workingDir/Analysis/02_sgRNA-Ranking_Results/sgRNA_VolcanoPlots/$prefix"."_sgRNA_volcano_IDs$_nonTStr.png" )}}'>
