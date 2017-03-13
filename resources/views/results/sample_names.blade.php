<?php
use Illuminate\Support\Facades\File;
$mapping = \File::get(storage_path("runs/$hash/fileMap.json"));
$mapping = json_decode($mapping,true);
$files = $mapping['control'] + $mapping['treatment'];
?>
<div class="row">
	<div class="column shink">
		<table>
			<tr>
				<th>Filename</th>
				<th>Sample Name</th>
			</tr>
		@foreach ($files as $fileName => $fileProperties)
			<tr>
				<td>{{ $fileName }}</td>
				<td>{{ $fileProperties['condition'] }}_{{ $fileProperties['index'] }}</td>
			</tr>
		@endforeach
		</table>
	</div>
</div>