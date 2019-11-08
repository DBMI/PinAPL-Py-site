<?php
$sections = [
	"readcount_scatterplots"  => "Treatment vs Control",
	"density_plots" => "Density Plots",
	"volcano_plots"	=> "Volcano Plots",
	"zscore_plots" => "z-Score Plots",
	//"replicate_correlation"	=> "Replicate Correlation",
];
?>
@extends('layouts.results_section_tabs', ['sections' => $sections, "selfName"=>"sgrna-plots"])