<?php
$sections = [
	"density_plots" => "Density Plots",
	"volcano_plots"	=> "Volcano Plots",
	"zscore_plots" => "z-Score Plots",
	"pvalue_dist" => "p-Value Distribution",
];
?>
@extends('layouts.results_section_tabs', ['sections' => $sections, "selfName"=>"sgrna-scatter-plots"])