<?php 
return [
	"num_cores" => env("DOCKER_ALLOWED_CORES","1"),
	"image" => env("DOCKER_IMAGE")
];