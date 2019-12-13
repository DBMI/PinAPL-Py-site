@php
	$_nonTStr = $extraData['nonT'] ? "_nonT" : "" ;
@endphp

<?php
use Symfony\Component\Yaml\Yaml;

$dir = storage_path("/runs/$runHash/workingDir");
$data = Yaml::parseFile("$dir/configuration.yaml");
$boo = $data["scatter_annotate"];
$_IDs = $boo ? "_IDs" : "" ;
?>

<img id="{{ $prefix }}-volcano-plot" src='{{"/run-images?path=".urlencode("/$runHash/workingDir/Analysis/02_sgRNA-Ranking_Results/sgRNA_VolcanoPlots/$prefix"."_sgRNA_volcano$_IDs$_nonTStr.png" )}}'>
