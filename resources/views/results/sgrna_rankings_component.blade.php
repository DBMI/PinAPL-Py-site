@php
	$columns = \App\SgrnaRanking::$columns;
	$columnKeys = array_keys($columns);
	$columnNames = array_values($columns);
@endphp
<script type="text/javascript">
$(function () {
    $("#{{ $prefix }}-sgrna-rankings").jqGrid({
        url: "/results/sgrna_rankings_query/{{ $runHash }}/{{ $prefix }}",
        datatype: "json",
        mtype: "GET",
        colNames: [{!! '"' . implode('", "', $columnNames) . '"'!!}],
        colModel: [
        	@foreach ($columnKeys as $key)
        		{ name: '{{ $key }}', width:100},
        	@endforeach
        ],
        pager: "#{{ $prefix }}-sgrna-rankings-pager",
        rowNum: 10,
        rowList: [10, 20, 30],
        sortname: "fdr",
        sortorder: "asc",
        viewrecords: true,
        gridview: true,
        autoencode: true,
        height: "100%",
        autowidth:true,
        emptyrecords: "No records to view",
    }); 
}); 
</script>
</head>
<div id="{{ $prefix }}-sgrna-rankings-pager"></div>
<table id="{{ $prefix }}-sgrna-rankings"><tr class="loader"></tr></table> 