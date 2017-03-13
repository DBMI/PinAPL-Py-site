<?php
$sections = [
	"gene_rankings"  => "Gene Rankings",
	"sgrna_rankings" => "sgRNA Rankings",
	"sgrna_efficiency" => "sgRNA Efficacy",
	"p-values" => "p-Values",
];
?>
@extends('layouts.results_section_tabs', ['sections' => $sections, "selfName"=>"enrichment-depletion"])