<?php
$fileNameSansExtension = str_replace(".fastq.gz", "", $fileName);
?>
<a href="{{ "/run-images?path=".urlencode("/$runHash/workingDir/Analysis/Sequence_Quality/$fileNameSansExtension"."_fastqc.html") }}">See full report</a>

<div class="row">
	<div class="column medium-6">
		<img src='{{"/run-images?path=".urlencode("/$runHash/workingDir/Analysis/Sequence_Quality/$fileNameSansExtension"."_fastqc/Images/per_base_quality.png")}}'>
	</div>
	<div class="column medium-6">
		<img src='{{"/run-images?path=".urlencode("/$runHash/workingDir/Analysis/Sequence_Quality/$fileNameSansExtension"."_fastqc/Images/per_sequence_quality.png")}}'>
	</div>
</div>
<div class="row">
	<div class="column medium-6">
		<img src='{{"/run-images?path=".urlencode("/$runHash/workingDir/Analysis/Sequence_Quality/$fileNameSansExtension"."_fastqc/Images/per_sequence_gc_content.png")}}'>
	</div>
	<div class="column medium-6">
		<img src='{{"/run-images?path=".urlencode("/$runHash/workingDir/Analysis/Sequence_Quality/$fileNameSansExtension"."_fastqc/Images/per_base_sequence_content.png")}}'>
	</div>
</div>
