<?php
$sections = [
	"readcount_scatterplots"  => "Treatment vs Control",
	"replicate_correlation"	=> "Replicate Correlation",
];
?>
@extends('layouts.results_section_tabs', ['sections' => $sections, "selfName"=>"scatter-plots"])