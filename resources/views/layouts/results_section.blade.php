{{-- 
Provided 
$idPrefix
--}}
<div class="loader"></div>
@section('customScripts')
@parent
<script>
	$.get('/results/{{ $idPrefix }}/'+runHash, function(data) {	
		$('#{{ $idPrefix }}_content').html(data);
	});
</script>
@stop