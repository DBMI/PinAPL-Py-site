<div class="row expanded" style="max-width: 80%; margin: auto;">
	<div class="column small-2">
		<label>{{ $method }}</label>
	</div>
	<div class="column small-1">
		<a class="button success" download href="/download_test/{{ $method }}">Download</a>
	</div>
	<div class="column small-9">
		<ul class="accordion" data-accordion data-allow-all-closed="true">
			<li class="accordion-item" data-accordion-item>
				<a class="accordion-title" href="#">Display Code</a>
				<div id="{{ $method }}-panel" class="accordion-content" data-tab-content style="padding: 0; margin-left: -33.5%;">
				@php
					$func = new ReflectionMethod("\App\Http\Controllers\DownloadController",$method);
					$filename = $func->getFileName();
					$start_line = $func->getStartLine() - 1; // it's actually - 1, otherwise you wont get the function() block
					$end_line = $func->getEndLine();
					$length = $end_line - $start_line;

					$source = file($filename);
					$body = implode("", array_slice($source, $start_line, $length));
				@endphp
					<pre style="display: block;" class="prettyprint">{{ $body }}</pre>
				</div>
			</li>
		</ul>
	</div>
</div>