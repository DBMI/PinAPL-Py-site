<?php
use Symfony\Component\Yaml\Yaml;

$dir = storage_path("/runs/$runHash/workingDir");
$data = Yaml::parseFile("$dir/configuration.yaml");
$screen = ucfirst($data["ScreenType"]);
?>
<img src='/run-images?path={{ urlencode("/$runHash/workingDir/Analysis/02_sgRNA-Ranking_Results/p-value_Distribution/".$prefix." sgRNA ".$screen.".png") }}'>

