{{-- 
Provided 
$id{}refix
--}}
<div class="loader"></div>
@section('customScripts')
@parent
<script>
	$.get('/results/{{ $idPrefix }}/'+runId, function(data) {	
		$('#{{ $idPrefix }}_content').html(data);
	});
</script>
@stop