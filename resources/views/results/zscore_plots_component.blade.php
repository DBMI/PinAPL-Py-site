@php
	$_nonTStr = $extraData['nonT'] ? "_nonT" : "" ;
@endphp

<img id="{{ $prefix }}-zscore-plot" src='{{"/run-images?path=".urlencode("/$runHash/workingDir/Analysis/02_sgRNA-Ranking_Results/sgRNA_z-Scores/$prefix"."_sgRNA_zScores$_nonTStr.png" )}}'> 