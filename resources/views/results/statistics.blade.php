<?php
$sections = [
	"alignment_statistics"  => "Alignment Statistics",
	"readcount_statistics"	=> "Readcount Statistics",
	"sequencing_qc"	=> "Sequencing QC",
];
?>
@extends('layouts.results_section_tabs', ['sections' => $sections])