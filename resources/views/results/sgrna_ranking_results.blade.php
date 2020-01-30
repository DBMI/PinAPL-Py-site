<?php
$sections = [
	"sgrna_rankings" => "Rankings",
	"sgrna_plots"  => "Plots",
	//"various_plots" => "Plots",
	"pvalue_dist" => "p-Values",
	"readcount_distribution" => "Read Count Distribution",
	"heatmap" => "Clusters",
	"replicate_correlation"	=> "Replicate Correlation",
	"readcount_dispersion" => "Read Count Dispersion",
];
?>
@extends('layouts.results_section_tabs', ['sections' => $sections, "selfName"=>"sgrna-ranking-results"])