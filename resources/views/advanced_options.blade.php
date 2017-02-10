<fieldset>
	<legend>Analysis Options</legend>
	<div class="row align-bottom">
		<div class="column"><label>
			Keep Alignment
			<select name="AlnOutput" title="What to do with raw alignment output">
				<option value="Keep">Keep</option>
				<option value="Compress">Compress</option>
				<option value="Delete">Delete</option>
			</select>
		</label></div>
		<div class="column"><label>
			Keep Cut Reads
			<input name="keepCutReads" title="Keep files containing trimmed reads" type="checkbox">
		</label></div>
		<div class="column"><label>
			Variance Model
			<select name="varEst" title="Method for count variance">
				<option value="model">Model</option>
				<option value="sample">Sample</option>
			</select>
		</label></div>
		<div class="column"><label>
			Gene Enrichment
			<select name="GeneMetric" title="Metric for Gene enrichment">
				<option value="aRRA">aRRA</option>
				<option value="STARS">STARS</option>
				<option value="ES">ES</option>
			</select>
		</label></div>
		<div class="column"><label>
			Annotate Scatterplot
			<input name="scatter_annotate" title="Annotate Scatterplot with sgRNAs?" type="checkbox">
		</label></div>
		<div class="column"><label>
			Clustering Criterion
			<select name="ClusterBy" title="Clustering Criterion">
				<option value="variance">Variance</option>
				<option value="counts">Counts</option>
			</select>
		</label></div>
		<div class="column"><label>
			<input name="TopN" value="100" title="Number of top sgRNAs to take into account for clustering" type="number">
		</label></div>
	</div>
</fieldset>
<fieldset>
	<legend>Technical Parameters</legend>
	<div class="row">
		<div class="column"><label>
			Cutadapt Tolerance
			<input name="CutErrorTol" value="0.25" title="Cutadapt error tolerance" type="number">
		</label></div>
		<div class="column"><label>
			Read Lenght Minimum
			<input name="R_min" value="10" title="Minimal required read lenght after cutadapt trimming" type="number">
		</label></div>
		<div class="column"><label>
			Bowtie2 -L
			<input name="L_bw" value="11" title="Bowtie2 -L parameter (seed length)" type="number">
		</label></div>
		<div class="column"><label>
			Bowtie2 -N
			<input name="N_bw" value="1" title="Bowtie2 -N parameter (seed mismatch)" type="number">
		</label></div>
		<div class="column"><label>
			Bowtie2 -I
			<input name="I_bw" placeholder="S,11,0.75" title="Bowtie2 -I parameter (interval function)" type="text">
		</label></div>
		<div class="column"><label>
			Ambiguity Tolerance
			<input name="Theta" value="2" title="Alignment ambiguity tolerance" type="number">
		</label></div>
		<div class="column"><label>
			Read Normalization
			<input name="NO" value="1000000" title="Read normalizatoin" type="number">
		</label></div>
		<div class="column"><label>
			Max Quantile
			<input name="max_q" value="95" title="Maximum quantile for histogram plots" type="number">
		</label></div>
		<div class="column"><label>
			Significance Level
			<input name="alpha" value="0.01" title="Significance level" type="number">
		</label></div>
		<div class="column"><label>
			P-value correction
			<select name="pcorr" title="method for p-value correction">
				<option value="fdr_bh">fdr_bh</option>
				<option value="fdr_tsbh">fdr_tsbh</option>
			</select>
		</label></div>
		<div class="column"><label>
			# Permutations for ES enrichment
			<input name="Np_ES" value="100" title="Number of permutations for gene enrichment analysis (ES)" type="number">
		</label></div>
		<div class="column"><label>
			# Permutations for aRRa enrichment
			<input name="Np_aRRa" value="100" title="Number of permutations for gene enrichment analysis (aRRA)" type="number">
		</label></div>
		<div class="column"><label>
			# Permutations for STARS enrichment
			<input name="Np_STARS" value="10" title="Number of permutations for gene enrichment analysis (STARS)" type="number">
		</label></div>
		<div class="column"><label>
			STARS Threshold
			<input name="thr_STARS" value="10" title="Threshold percentage for STARS analysis" type="number">
		</label></div>
	</div>
</fieldset>