<?php
$sections = [
	"readcount_statistics"	=> "Read Count Distribution",
	"control" => "Read Count Dispersion",
	"alignment_statistics"  => "Alignment",
	"cutadapt"	=> "Adapter Trimming",
	"sequence_quality"	=> "Sequence Quality",
	"sequencing_depth"	=> "Sequencing Depth",
];
?>
@extends('layouts.results_section_tabs', ['sections' => $sections, "selfName"=>"statistics"])