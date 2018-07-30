<?php

return [
	'port' => env('KOTRANS_PORT', 9000),
	'host' => env('KOTRANS_URL') ?? env('APP_URL')
];
