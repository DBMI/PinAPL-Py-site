<?php
$sections = [
	"p-values" => "p-Values",
	"sgrna_efficiency" => "sgRNA Efficiency",
	"sgrna_rankings" => "sgRNA Rankings",
	"gene_rankings"  => "Gene Rankings",
	"control" => "Control"
];
?>
@extends('layouts.results_section_tabs', ['sections' => $sections])