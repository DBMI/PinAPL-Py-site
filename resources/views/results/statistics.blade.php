<?php
$sections = [
	"readcount_statistics"	=> "Read Count Distribution",
	"control" => "Read Count Dispersion",
	"alignment_statistics"  => "Alignment",
	"cutadapt"	=> "Adapter Trimming",
	"sequencing_qc"	=> "Sequence Quality",
];
?>
@extends('layouts.results_section_tabs', ['sections' => $sections])