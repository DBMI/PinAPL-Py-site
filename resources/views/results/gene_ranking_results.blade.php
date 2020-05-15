<?php
$sections = [
	"gene_rankings"  => "Gene Rankings",
	"gene_plots"  => "Scatterplots",
	"gene_pvalue" => "p-Value Distribution",
	"sgrna_efficiency" => "sgRNA Efficacy",
];
?>
@extends('layouts.results_section_tabs', ['sections' => $sections, "selfName"=>"gene-ranking-results"])