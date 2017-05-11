{{-- 
Provided 
$idPrefix
--}}
<div class="loader"></div>
@section('customScripts')
@parent
<script>
	$.get('/results/{{ $idPrefix }}/'+runHash, function(data) {	
		$('#{{ $idPrefix }}_tab').html(data);
	});
</script>
@stop