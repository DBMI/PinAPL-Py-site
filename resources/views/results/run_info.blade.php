<?php
$sections = [
	"output_log"	=> "Output Log",
	"configuration" => "Configuration",
	"sample_names"  => "Sample Names",
];
?>
@extends('layouts.results_section_tabs', ['sections' => $sections, "selfName"=>"run-info"])