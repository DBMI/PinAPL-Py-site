{{-- 
Provided 
$idPrefix
$idSingular
--}}
<div class="loader"></div>
@section('customScripts')
@parent
{{-- WIP 9/4
<script>
	if ( '{{ $idPrefix }}' == "readcount_scatterplots") {
		$.get('/results/{{ $idPrefix }}/'+runHash+'/{{ $idPrefix }}/{{ $idSingular }}', function(data) {	
			$('#{{ $idPrefix }}_tab').html(data);
		});
	} else {
		$.get('/results/{{ $idPrefix }}/'+runHash, function(data) {	
			$('#{{ $idPrefix }}_tab').html(data);
		});
	}
</script>
--}}
<script>
	$.get('/results/{{ $idPrefix }}/'+runHash, function(data) {	
			$('#{{ $idPrefix }}_tab').html(data);
		});
</script>
@stop