@php
	if (ends_with($prefix, '_combined')) {
		$columns = \App\GeneCombinedRanking::$columns;
		$url = "/results/gene_combined_rankings_query/$runHash/$prefix";
		$sortname = "fisher_statistic";
	} else {
		$columns = \App\GeneRanking::$columns;
		$url = "/results/gene_rankings_query/$runHash/$prefix";
		$sortname = "num_sig_sgrna";
	}
	$columnKeys = array_keys($columns);
	$columnNames = array_values($columns);
@endphp
<script type="text/javascript">
$(function () {
	$("#{{ $prefix }}-gene-rankings").jqGrid({
		url: "{{$url}}",
		datatype: "json",
		mtype: "GET",
		colNames: [{!! '"' . implode('", "', $columnNames) . '"'!!}],
		colModel: [
			@foreach ($columnKeys as $key)
				{ name: '{{ $key }}'},
			@endforeach
		],
		pager: "#{{ $prefix }}-gene-rankings-pager",
		rowNum: 10,
		rowList: [10, 20, 30],
		sortname: "{{$sortname}}",
		sortorder: "desc",
		viewrecords: true,
		gridview: true,
		autoencode: true,
		height: "100%",
	    autowidth:true,
	    shrinkToFit:true,
	    emptyrecords: "No records to view",
	}); 
}); 
</script>
</head>
<table id="{{ $prefix }}-gene-rankings"><tr class="loader"></tr></table> 
<div id="{{ $prefix }}-gene-rankings-pager"></div> 