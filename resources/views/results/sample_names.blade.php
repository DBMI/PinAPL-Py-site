<?php
use Illuminate\Support\Facades\File;
$mapping = \App\Run::getMapping($hash);
?>
<div class="row">
	<div class="column shink">
		<table>
			<tr>
				<th>Filename</th>
				<th>Sample Name</th>
			</tr>
		@foreach ($mapping as $file)
			<tr>
				<td>{{ $file->filename }}</td>
				<td>{{ $file->sample_name }}</td>
			</tr>
		@endforeach
		</table>
	</div>
</div>