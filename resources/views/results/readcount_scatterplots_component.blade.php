@php
	$_nonTStr = $extraData['nonT'] ? "_nonT" : "" ;
@endphp

<img id="{{ $prefix }}-readcount-scatterplot" src='{{"/run-images?path=".urlencode("/$runHash/workingDir/Analysis/02_sgRNA-Ranking_Results/sgRNA_Scatterplots/counts_$prefix"."_scatterplot$_nonTStr.png" )}}'>