<?php
$sections = [
	"sgrna_rankings" => "sgRNA Rankings",
	"sgrna_scatter_plots"  => "Scatterplots",
	"various_plots" => "Plots",
	"readcount_pages" => "Read Count",
	"heatmap" => "Heatmap",
];
?>
@extends('layouts.results_section_tabs', ['sections' => $sections, "selfName"=>"sgrna-ranking-results"])