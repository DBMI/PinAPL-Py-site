<?php
$sections = [
	"readcount_distribution" => "Read Count Distribution",
	"readcount_dispersion" => "Read Count Dispersion",
];
?>
@extends('layouts.results_section_tabs', ['sections' => $sections, "selfName"=>"readcount_pages"])