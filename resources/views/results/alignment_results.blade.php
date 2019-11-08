<?php
$sections = [
	"sequencing_depth"	    => "Summary",
	"alignment_statistics"  => "Alignment Statistics",
	"sequence_quality"      => "Sequence Quality",
];
?>
@extends('layouts.results_section_tabs', ['sections' => $sections, "selfName"=>"alignment-results"])