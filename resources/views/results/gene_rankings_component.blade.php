<?php
$rows = \App\GeneRanking::where('file',$prefix)->where('dir',$runHash)->get(); // Get all users from the database
$columns = \App\GeneRanking::$columns;
?>
<p id="msg">&nbsp;</p>
{!! drawTable('gene-ranking-table',$columns,[],"",$rows); !!}
<script type="text/javascript">
	geneTable = $("#gene-ranking-table").stupidtable();
	geneTable.on("beforetablesort", function (event, data) {
	  // Apply a "disabled" look to the table while sorting.
	  // Using addClass for "testing" as it takes slightly longer to render.
	  $("#msg").text("Sorting...");
	  $("#gene-ranking-table").addClass("disabled");
	});
	geneTable.on("aftertablesort", function (event, data) {
	  // Reset loading message.
	  $("#msg").html("&nbsp;");
	  $("#gene-ranking-table").removeClass("disabled");
	  var th = $(this).find("th");
	  th.find(".arrow").remove();
	  var dir = $.fn.stupidtable.dir;
	  var arrow = data.direction === dir.ASC ? "&uarr;" : "&darr;";
	  th.eq(data.column).append('<span class="arrow">' + arrow +'</span>');
	});
</script>
 <style type="text/css">
    body {
      font-family: "Ubuntu", "Trebuchet MS", sans-serif;
    }
    table {
      border-collapse: collapse;
      margin: 1em auto;
    }
    /*th, td {
      padding: 5px 10px;
      border: 1px solid #999;
      font-size: 12px;
    }
    th {
      background-color: #eee;
    }*/
    th[data-sort]{
      cursor:pointer;
    }
    /* just some random additional styles for a more real-world situation */
    #msg {
      color: #0a0;
      text-align: center;
    }
    td.name {
      font-weight: bold;
    }
    td.email {
      color: #666;
      text-decoration: underline;
    }
    /* zebra-striping seems to really slow down Opera sometimes */
    tr:nth-child(even) > td {
      background-color: #f9f9f7;
    }
    tr:nth-child(odd) > td {
      background-color: #ffffff;
    }
    .disabled {
      opacity: 0.5;
    }
  </style>