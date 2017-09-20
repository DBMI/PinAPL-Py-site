@extends('layouts.master')

@section('content')
	<p class="c45" id="h.gjdgxs">
		<span class="c3">
			<a class="c5" href="#h-1">1 Running PinAPL-Py</a>
		</span>
	</p>
	<p class="c31">
		<span class="c3">
			<a class="c5" href="#h-1.1">1.1 QUICK START:</a>
		</span>
	</p>
	<p class="c17">
		<span class="c3">
			<a class="c5" href="#h-step1">Step 1: SET UP A RUN </a>
		</span>
	</p>
	<p class="c17">
		<span class="c3">
			<a class="c5" href="#h-step2">Step 2: UPLOAD DATA </a>
		</span>
	</p>
	<p class="c17">
		<span class="c3">
			<a class="c5" href="#h-step3">Step 3: ENTER SAMPLE INFORMATION </a>
		</span>
	</p>
	<p class="c17">
		<span class="c3">
			<a class="c5" href="#h-step4">Step 4: CONFIGURE YOUR ANALYSIS RUN </a>
		</span>
	</p>
	<p class="c17">
		<span class="c3">
			<a class="c5" href="#h-step5">Step 5: RUNNING AND COMPLETION </a>
		</span>
	</p>
	<p class="c31">
		<span class="c3">
			<a class="c5" href="#h-1.2">1.2 ADVANCED OPTIONS:</a>
		</span>
	</p>
	<p class="c17">
		<span class="c3">
			<a class="c5" href="#h-1.2.1">1.2.1 Parameters </a>
		</span>
	</p>
	<p class="c17">
		<span class="c3">
			<a class="c5" href="#h-1.2.2">1.2.2 Uploading a custom library:</a>
		</span>
	</p>
	<p class="c45">
		<span class="c3">
			<a class="c5" href="#h-2">2 Description of the PinAPL-Py Analysis output </a>
		</span>
	</p>
	<p class="c17">
		<span class="c3">
			<a class="c5" href="#h-2.1">2.1 Enrichment/Depletion </a>
		</span>
	</p>
	<p class="c17">
		<span class="c3">
			<a class="c5" href="#h-2.2">2.2 Statistics </a>
		</span>
	</p>
	<p class="c17">
		<span class="c3">
			<a class="c5" href="#h-2.3">2.3 Scatter Plots</a>
		</span>
	</p>
	<p class="c17">
		<span class="c3">
			<a class="c5" href="#h-2.4">2.4 Heatmap</a>
		</span>
	</p>
	<p class="c17">
		<span class="c3">
			<a class="c5" href="#h-2.5">2.5 Run Info</a>
		</span>
	</p>
	<p class="c45" id="refrences-header">
		<span class="c3">
			<a class="c5" href="#h-3">3 References</a>
		</span>
	</p>
	<hr style="page-break-before:always;display:none;">
	<p class="c22 c39">
		<span class="c32"></span>
	</p>
	<h1 id="h-1">1 Running PinAPL-Py</h1>
	<h2 class="c33" id="h-1.1">
		<span class="c23 c47">1.1 QUICK START:</span>
	</h2>
	<p id="h-step1" class="c8">Step 1: SET UP A RUN
	</p>
	<p>
		Enter a project name for your analysis run. This name will help you identify your results in case you do multiple runs in a row. Provision of an email address is optional, but will let you safely close the browser during the analysis and receive a notification after completion. </span>
	</p>
	<p class="c8" id="h-step2" >Step 2: UPLOAD DATA
	</p>
	<p>
		Upload your files via the drag-and-drop frame. Uncompressed format (.fastq) is supported, but compressed (.fastq.gz) is recommended.</span>
	</p>
	<p class="c8" id="h-step3">Step 3: ENTER SAMPLE INFORMATION
	</p>
	<p>Enter the <b>name of the condition each</b> file represents. Files representing replicates of the same condition have to be given the same name. Do not number your replicates. Numbering is done automatically by the program and displayed on the results page after completion of the analysis. 
	</p>
	<p>Please mark all <b>control replicates</b> with the checkbox to the right.</p>
	<p id="h-step4" class="c8">Step 4: CONFIGURE YOUR ANALYSIS RUN
	</p>
   <p>
		First, choose the <b>screen type</b>. Choose between &ldquo;enrichment&rdquo; (e.g. a drug resistance screen) or &ldquo;depletion&rdquo; (e.g. a gene-essentiality screen), depending on whether your screen aims at finding sgRNAs of high or low abundance, respectively.Next, choose the <b>sgRNA library</b> used in your screen from the dropdown menu. If your screen uses a library not present in the list or a custom library, see &ldquo;Uploading a custom library&rdquo; in the Advanced Options below.
	</p>
   <p>
		Optional: If you would like to edit the default parameter settings, click <b>Advanced Options</b>. For instructions on these parameters, see “Parameter description” in the Advanced Options section.
	</p>
	<p class="c8" id="h-step5"> Step 5: RUNNING AND COMPLETION </p>
	<p>
		You can follow the program’s execution log by refreshing the page repeatedly. In case another run was started shortly before yours, your run will be queued and start after completion of the previous. </p>
	<p>
		If you provided an email address, you can close the browser; you will be notified by email and sent a link to the results after completion. Otherwise, please leave the progress screen open. 
	</p>
	<p>
		The results will remain on the server for 5 days. You can download all content shown on the results page in a single ZIP archive.
	</p>
	<h2 id="h-1.2">1.2 ADVANCED OPTIONS:</h2>
	</h2>
	<h3 id="h-1.2.1">1.2.1 <u>Parameters</u></h3>
	</p>
	<h4 id="ALIGNMENT">ALIGNMENT</h4>
	<h5><u>sgRNA Sequence Length (default = 20)</u></h5>
	<p>
		The length of your sgRNA sequence in the reads.
	</p>
	<h5><u>Adapter error rate (default = 0.1)</u></h5>
	<p>
		Error rate (mismatches and indels) allowed for the identification of the 5’ adapter (Refer to the <a href="http://cutadapt.readthedocs.io/en/stable/guide.html#error-tolerance">cutadapt manual</a> for more details). Increasing this rate can help to control for poor sequence quality.
	</p>

	<h5><u>Matching threshold (default = 40)</u></h5>
	<p>Minimal alignment score required to consider a read successfully matched. For a perfect match this must be double the sgRNA sequence length (Refer to the <a href="http://bowtie-bio.sourceforge.net/bowtie2/manual.shtml#scores-higher-more-similar">Bowtie2 manual</a> for more details on calculation of the alignment score). Decreasing this threshold will include reads with a less than optimal match to a library entry which can be helpful to increase sensitivity or control for sequence quality.</p>

	<h5><u>Ambiguity threshold (default = 2):</u></h5>
	<p>Minimum tolerated difference between primary (best) and secondary (second-best) alignment to consider a read successfully matched. Reads with a difference lower than this threshold will be considered ambiguous and discarded. Increasing this threshold increases stringency. Decreasing this threshold increases sensitivity. With a threshold of 0, the program will accept reads even if they match multiple library entries equally well.</p>

	<h5><u>Seed length (default = 11): </u></h5>
	<p>Seed length parameter for Bowtie2 alignment (-L, refer to the <a href="http://bowtie-bio.sourceforge.net/bowtie2/manual.shtml#options">Bowtie2 manual</a> for more details). Changing this parameter is generally not required.</p>

	<h5><u>Seed number (default = 1):</u></h5>
	<p>Number of allowed mismatches for Bowtie2 seed alignment (-N, refer to the <a href="http://bowtie-bio.sourceforge.net/bowtie2/manual.shtml#options">Bowtie2 manual</a> for more details). Changing this parameter is generally not required.</p>

	<h5><u>Seed interval function (default = ‘S,1,0.75’): </u></h5>
	<p>Bowtie2 seed interval function (-i, refer to the <a href="http://bowtie-bio.sourceforge.net/bowtie2/manual.shtml#options">Bowtie2 manual</a> for more details). Changing this parameter is generally not required.</p>

	<h4>READ COUNTING</h4>
	<h5><u>Normalization: (default = &lsquo;cpm &rsquo;): </u></h5>
	<p>Method of read count normalization.</p>
	<ul>
		<li><b>cpm:</b> Counts per million. Read counts are divided by the number of total read counts in the sample and multiplied by 1,000,000.</li>
		<li><b>total:</b> Read counts are divided by the number of total read counts in the sample and multiplied by the mean total read count across all samples.</li>
		<li><b>size:</b> Read counts are normalized using median ratios and the “size-factor” method, as decribed in (Li et al., 2014; Anders and Huber, 2010).</li>
	</ul>
	<h5><u>Cutoff (default = 0): </u></h5>
	<p>
		Cutoff threshold (given in cpm) to filter out low sgRNA counts. sgRNAs with counts lower than the cutoff will be set to 0 counts. If low counts are of minor interest for the experiment (e.g. in an enrichment screen), this can be helpful to reduce noise in the data.
	</p>

	<h5><u>Round counts (default = No): </u></h5>
	<p>
		Round counts after normalization to avoid fractional counts. Rounding only affects visualization, but not significance analysis.
	</p>
	
	<h4>GENE RANKING</h4>
	<h5><u>Gene Metric (default = "αRRA:"): </u></h5>
	<p>Method to combine the sgRNA enrichment/depletion data for ranking of genes: </p>
	<ul>
		<li>
			<b>αRRA:</b> Adjusted robust rank aggregation (Li et al., 2014). This method ranks genes, based on a Beta model of the aggregation of sgRNAs. It requires a sgRNA to achieve at least a certain critical p-value (see “P0” parameter below) to be taken into account.
		</li>
		<li>
			<b>STARS:</b> STARS score (Doench et al., 2016). This method ranks genes, based on a binomial model. It requires a gene to have at least two sgRNAs ranked among the top x% (see “sgRNA percentage” parameter below). 
		</li>
	</ul>
	<p>For more details on these methods, please refer to the original publications.</p>

	<h5><u>Number of permutations (default = 1000): </u></h5>
	<p>
		Number of permutations for p-value estimation of the gene ranking score. CAUTION: STARS is more computationally demanding than aRRA, so reducing the number of permutations is recommended in this case.
	</p>

	<h5><u>sgRNA percentage (STARS only) (default = 10):</u></h5>
	<p>Percentage of sgRNAs to be included in the ranking analysis. Only relevant if &ldquo;STARS &rdquo;method is chosen.</p>

	<h5><u>P0 (aRRA only) (default = 0.0005): </u></h5>
	<p>Critical p-value for individual sgRNAs to be included in the ranking analysis. Only relevant if “aRRA” method is chosen.</p>

	<h4>STATISTICAL SIGNIFICANCE</h4>

	<h5><u>Significance level (sgRNAs) (default = 0.001)</u></h5>
	<p>Significance threshold for the fold-change enrichment/depletion of sgRNAs.</p>

	<h5><u>Significance level (genes) (default = 0.01)</u></h5>
	<p>Significance threshold for the gene ranking score.</p>

	<h5><u>p-value adjustment (default = ‘fdr_bh’):</u></h5>
	<p>Method for p-value adjustment for multiple tests.</p>
	<ul>
		<li><b>fdr_bh:</b> Benjamini-Hochberg method.</li>
		<li><b>fdr_tsbh:</b> Two-stage Benjamini-Hochberg method.</li>
		<li><b>sidak:</b> Sidak correction method.</li>
		<li><b>bonferroni:</b> Bonferroni correction method.</li>
	</ul>

	<h4>SAMPLE CLUSTERING</h4>
	<h5><u>Cluster by… (default = ‘variance’): </u></h5>
	<p>Criterion for sample clustering.</p>
	<ul>
		<li><b>variance:</b> Clustering of the samples is based on the sgRNAs with the highest read count variance across all samples.</li>
		<li><b>counts:</b> Clustering of the samples is based on the sgRNAs with the highest/lowest abundance (depending on whether the screen type is “enrichment” or “depletion”).</li>
	</ul>

	<h5><u>Number of sgRNAs for clustering (default = 25): </u></h5>
	<p>Specify how many sgRNAs are used for clustering with the method selected above. In case of clustering by counts, the top x sgRNAs from each sample are combined.</p>

	<h4>VISUALIZATION</h4>
	
	<h5><u>Dotsize (default = 10):</u></h5>
	<p>Size of dots in replicate scatterplots.</p>

	<h5><u>Transparency level (default = 0.1):</u></h5>
	<p>Transparency of points in scatterplots. A low level is helpful to visualize density. </p>
	
	<h5><u>sgRNA annotation (default = No):</u></h5>
	<p>Annotate sgRNA with their IDs when highlighting individual genes in scatterplots.</p>
	
	<h5><u>Highlight non-targeting controls (default = No):</u></h5>
	<p>Highlight non-targeting control sgRNAs in scatterplots.</p>

	<h5><u>Table format (default = Text only):</u></h5>
	<p>File format for sgRNA and gene tables in the download archive. Use “Text only” for optimal workflow speed. Text files (.tsv) can be manually opened and converted with Excel. Use “Excel” to have the workflow automatically convert all text tables into .xlsx format (WARNING: This increases computation time).</p>

	<h5><u>PNG resolution (default = 300):</u></h5>
	<p>Resolution for PNG output (dpi).</p>



	<h3 id="h-1.2.2">1.2.2 <u>Uploading a custom library:</u></h3>
	<p>Prepare your library file (e.g. in Excel) as a spreadsheet with <b>3 columns (with headers): </b></p>
	<ul>
		<li><b>gene:</b> This column contains an identifier of the gene that is targeted by the sgRNA</li>
		<li><b>sgRNA_ID:</b> This column contains an identifier of the sgRNA</li>
		<li><b>sequence:</b> This column contains the 20bp sequence of the sgRNA</li>
	</ul>
	<p>You can choose other header names for these columns. See example below.</p>
	<u>Example:</u>

	<table>
		<tbody>
			<tr>
				<td>
					gene_ID
				</td>
				<td>
					sgRNA_ID
				</td>
				<td>
					Seq
				</td>
			</tr>
			<tr>
				<td>
					A1BG
				</td>
				<td>
					CustomLib00001
				</td>
				<td>
					GTCGCTGAGCTCCGATTCGA
				</td>
			</tr>
			<tr>
				<td>
					A1BG
				</td>
				<td>
					CustomLib00002
				</td>
				<td>
					ACCTGTAGTTGCCGGCGTGC
				</td>
			</tr>
			<tr>
				<td>
					A1BG
				</td>
				<td>
					CustomLib00003
				</td>
				<td>
					CGTCAGCGTCACATTGGCCA
				</td>
			</tr>
			<tr>
				<td>
					A1CF
				</td>
				<td>
					CustomLib00004
				</td>
				<td>
					CGCGCACTGGTCCAGCGCAC
				</td>
			</tr>
			<tr>
				<td>
					A1CF
				</td>
				<td>
					CustomLib00005
				</td>
				<td>
					CCAAGCTATATCCTGTGCGC
				</td>
			</tr>
			<tr>
				<td>
					A1CF
				</td>
				<td>
					CustomLib00006
				</td>
				<td>
					AAGTTGCTTGATTGCATTCT
				</td>
			</tr>
		</tbody>
	</table>
	<p>
		Save the spreadsheet as <b>either tab-separated format (.tsv) or comma-separated format (.csv)</b>. 
		You can use the <b>"Save As"</b> menu item in Excel to do this.
	</p>
	<p>Use the file browser to select and upload your library file.</p>
	<p>Next, specify the following parameters:</p>
	<h5><u>5&rsquo;-adapter: </u></h5>
	<p>
		Enter the sequence of the 5&rsquo;-adapter. Adapters are simply sequences lying 5&rsquo; or 3&rsquo; of the 20bp sgRNA.  There are no restriction to length of your adapter definition, but it is generally recommended to define the <b>20-25 bp</b> immediately 5&rsquo; of the sgRNA sequence (see image below). Also, it is recommended to let the adapter sequence <b>end in an ‘N’</b> to allow possible mismatches (see example below). A sequence mapping program like <a href="http://www.snapgene.com/products/snapgene_viewer/">SnapGene Viewer</a> is helpful to define the adapter. Definition of the 3&rsquo; adapter is not necessary.
	</p>
	<div class="row" style="margin-top: 3em;">
		<column class="shrink">
		  <img alt="" src="img/documentation/read_sequence.png" title="" style="max-width: 40em;">
		</column>
	</div>


	<p><i>Example:</i> If your reads have the following structure</p>
	<p class="text-center">
		<span style="color:orange">TCGAATCTTGTGGAAAGGACGAAACACCG</span>
		<span style="color:red">ACGGAGGCTAAGCGTCGCAA</span>
		<span style="color:gold">GTTTTAG</span>
	</p>
	<p>you can, for example, define TCTTGTGGAAAGGACGAAACACCN as the 5&rsquo;-adapter. </p>

	<h5><u>Identifier for non-targeting controls:</u></h5>
	<p>If your library contains non-targeting controls, enter an <b>identifier</b> in the library spreadsheet to define sgRNAs containing non-targeting controls. The identifier is a part of the gene_ID that is unique to the non-targeting controls (see example below). If your library does not contain non-targeting controls, enter <b>&ldquo;none&rdquo;</b></p>

	<table>
		<tbody>
			<tr>
				<td>
					gene_ID
				</td>
				<td>
					sgRNA_ID
				</td>
				<td>
					Seq
				</td>
			</tr>
			<tr>
				<td>
					Non_Target_0001
				</td>
				<td>
					CustomLib34556
				</td>
				<td>
					ACGGAGGCTAAGCGTCGCAA
				</td>
			</tr>
			<tr>
				<td>
					Non_Target_0002
				</td>
				<td>
					CustomLib34557
				</td>
				<td>
					CGCTTCCGCGGCCCGTTCAA
				</td>
			</tr>
			<tr>
				<td>
					Non_Target_0003
				</td>
				<td>
					CustomLib34558
				</td>
				<td>
					ATCGTTTCCGCTTAACGGCG
				</td>
			</tr>
		</tbody>
	</table>
	<p><i>Example:</i> An identifier in this case would be “Non_Target”.</p>





	<h5><u>Number of sgRNAs per gene:</u></h5>
	<p>
		Specifies the number of sgRNAs targeting a single gene (excluding non-targeting controls, miRNAs and other non-genes in your library). 
	</p>

	<h1 id="h-2">2 Description of the PinAPL-Py Analysis output</h1>
   <p>
		The PinAPL-Py output is structured by logical order into tabs and subtabs on the results page. In addition, all output can be downloaded via the <b>“Download Results Archive”</b> button as a single .zip file. Images are saved both as high-resolution .png as well as as .svg vector graphics which can be further processed in Adobe Illustrator or similar image processing software. Tables are saved as raw text (.tsv), but can be manually opened with Excel and saved as Excel spreadsheets. For convenience, PinAPL-Py can convert tables on-the-fly (see the “Table Format” parameter on the configuration page), at the cost of additional computation time.
	</p>
   <p>
	  NOTE for Windows users: To view text files (.txt/.tsv/.csv), <a target="blank" href="https://notepad-plus-plus.org/download/v7.2.1.html">Notepad++</a> is recommended
	</p>

	<h2 id="h-2.1">2.1 Enrichment/Depletion</h2>

	<h5><u>Gene Rankings:</u></h5>

	<p>This tab contains the results of the gene ranking analysis in a sortable table. The columns are:</p>
	<ul>
		<li><b>Gene:</b> Name of gene (as defined in the library file)</li>
		<li><b>Gene Score:</b> Value of the computed gene metric score. &lt;gene metric&gt; is either aRRA or STARS score, as chosen in on configuration page</li>
		<li><b>Gene Score p-value</b>: Estimated (one-sided) p-value of the gene score </li>
		<li><b>Gene Score FDR:</b> Estimated false discovery rate of the achieved gene score</li>
		<li><b>significant:</b> Statistical significance of the obtained gene metric score. Declared “True” if the FDR is smaller than the significance threshold, defined on the configuration page </li>
		<li><b># sgRNAs:</b>Number of sgRNAs targeting the particular gene</li>
		<li><b># Signif. sgRNAs:</b> Number of sgRNAs targeting the particular gene that reached statistical significance in the sgRNA ranking</li>
		<li><b>Avg. log FC:</b> Average log10 fold-change of all sgRNAs targeting the particular gene</li>
	</ul>
	<p>Results are sorted by number of significant sgRNAs by default.</p>

	<h5><u>sgRNA Rankings:</u></h5>
	<p>This tab contains the results of the sgRNA enrichment/depletion analysis. The columns are:</p>
	<ul>
		<li><b>sgRNA:</b> Identifier of sgRNA </li>
		<li><b>Gene:</b> Name of target gene </li>
		<li><b>Counts:</b> Normalized Read count </li>
		<li><b>Control mean: </b>Average normalized read count in the control samples </li>
		<li><b>Control StDev:</b> Standard deviation of normalized read counts in the control samples</li>
		<li><b>Fold Change:</b> The ratio of normalized read counts in the sample to the control average</li>
		<li><b>p-value:</b> p-value (one-sided) of the normalized read count</li>
		<li><b>FDR:</b> False discovery rate of the normalized read count</li>
		<li><b>Significant:</b> Statistical significance of the normalized read count. Declared “True” if the FDR is smaller than the significance threshold, defined on the configuration page</li>
	</ul>

	<h5><u>sgRNA_Efficacy:</u></h5>
	<p>This plot shows information about the overall efficacy of sgRNAs targeting the same gene. Genes are categorized by the number of targeting sgRNAs reaching statistical significance. Genes having no significant sgRNAs are omitted. </p>

	<h5><u>p-values:</u></h5>
	<p>This tab contains various plots visualizing the fraction of sgRNAs and genes that reached statistical significance in the ranking.</p>
	<ul>
		<li><b>Gene Significance:</b> The plot shows the distribution of p-values obtained in the gene ranking analysis, both before and after adjustment for multiple tests. In order for low p-values to be credible, this distribution should be noticeably different from a uniform distribution.</li>
		<li><b>sgRNA Significance:</b> he plot shows the distribution of p-values obtained in the sgRNA ranking analysis, both before and after adjustment for multiple tests. In order for low p-values to be credible, this distribution should be noticeably different from a uniform distribution. </li>

		<li><b>sgRNA Volcano:</b> The plot visualizes the fraction of sgRNAs whose fold change compared to the control yielded statistical significance. One-sided p-values are shown. p-values are capped at 1e-16 for technical purposes. </li>

		<li><b>sgRNA QQ:</b> The plot visualizes the degree by which the p-values obtained from the sgRNA ranking analysis differ from a uniform distribution (=“expected p-values”). In order for low p-values to be credible, they should show noticeable distance from the dashed line. p-values are capped at 1e-16 for technical purposes. </li>
		<li><b>sgRNA z-Scores:</b> The plot visualizes the fraction of sgRNAs whose z-Score (=normalized deviation from the mean read count) yielded statistical significance.</li>
	</ul>
	<h2 id="h-2.2">2.2 Statistics</h2>
	<h5><u>Read Count Distribution:</u></h5>
	<p>This tab contains information about the statistical distribution of sgRNA read counts. </p>
	<ul>
		<li><b>Lorenz curves and Gini coefficients:</b> The Lorenz curve visualizes the distribution of reads, showing what fraction of sgRNAs/genes is represented by what fraction of reads. The Gini coefficient quantifies the difference of this distribution from a perfectly even distribution. A perfect even distribution results in a diagonal curve (Gini coefficient = 0).  An extreme uneven distribution results in a flat curve (Gini coefficient = 1) (only a single sgRNA/gene is represented by all reads). These statistics can serves as an indicator of the strength of selection in a sample.</li>
		<li><b>Boxplots, histograms and descriptive statistics:</b> Boxplots and histograms for the read counts per sgRNA or gene, respectively. Outliers are omitted for visualization purposes. Descriptive statistics are summarized below. sgRNA/Gene Representation measures the number of sgRNAs/genes detected by at least one count in the sample (as percentage of the full library). </li>
	</ul>
	<h5><u>Read Count Dispersion:</u></h5>
	<p>This tab shows the distribution of read counts in the control samples. The data shown is used to estimate the parameters for the negative binomial distribution describing the read counts of each sgRNA.</p>
	<ul>
		<li><b>Read Count Overdispersion: </b> This plot visualizes the degree of overdispersion in the data, i.e. the degree by which the variance of read counts exceeds the mean (as typically seen in next-generation sequencing datasets).</li>
		<li><b>Mean/Variance Model:</b> This plot shows shows the computed regression line, which is used to estimate the dispersion, i.e. the relationship between read count variance and mean. The dispersion is needed to estimate the parameters for the negative binomial distributions of each sgRNA.</li>
	</ul>

	<h5><u>Alignment:</u></h5>
	<p>This tab summarizes the read alignment process. </p>
	<ul>
		<li>
			<b>Mapping Quality:</b> 
			Histogram of the overall quality by which the reads mapped to the library. Reads that uniquely align to a single library sequence yield a high mapping quality score. Reads that ambiguously align to multiple library sequences or that do not align to any library sequence yield a low mapping quality score. For more detailed information about computation of the mapping quality score, please refer to the <a class="c5" target="_blank" href="http://bowtie-bio.sourceforge.net/bowtie2/manual.shtml#mapping-quality-higher-more-unique">Bowtie2 manual</a>.
		</li>
		<li>
			<b>Alignment Analysis:</b> 
			Barplot showing the primary (best) and secondary (second-best) alignment scores achieved for each read. If a read uniquely aligns to only one library sequence, its primary alignment score will be high, and its secondary alignment score will be 0. If a read aligns ambiguously to multiple library sequences, its secondary alignment score will be close to its primary alignment score. If a read does not align to any library sequence, both its primary and secondary alignment scores will be 0. The fraction of reads marked in red is being discarded. 
		</li>
		<li>
			<b>Alignment Results:</b>
			This text file provides information about the success of the alignment, i.e. about the number of reads in each of the following fractions:
			<ul>
				<li><i>Unique Alignments:</i> The read aligns to only one library sequence.</li>
				<li><i>Alignments above ambiguity tolerance:</i> The read aligns to more than one library sequence, but the difference between best and second-best alignment score is high enough to accept the best score.</li>
				<li><i>Alignments below ambiguity tolerance:</i> The read aligns to more than one library sequence, but the difference between best and second-best alignment score is not high enough to safely assign the read to one particular library sequence.</li>
				<li><i>Failed Alignments:</i> The read does not align to any library sequence.</li>
			</ul>
			Alignments below ambiguity tolerance and failed alignments are discarded before the remaining data analysis. For an explanation of the parameter settings reported at the bottom of the page, see the <a href="#ALIGNMENT">ALIGNMENT</a> section). 
		</li>
	</ul>

	<h5><u>Adapter Trimming:</u></h5>
	<p>This tab shows the log of the adapter trimming process, as reported by cutadapt. The output is explained in detail in the <a target="_blank" href="http://cutadapt.readthedocs.io/en/stable/guide.html#cutadapt-s-output">cutadapt manual</a>.</p>

	<h5><u>Sequence Quality:</u></h5>
	<p>This tab contains graphs for sequence quality control (produced by fastqc). For the full fastqc output, click the “See full report” link </p>
	<ul>
		<li>
			<b>Per Base Quality:</b>
			(upper left): This plot shows the quality distribution for every base position in the read. y-axis is sequence quality score (Phred).
		</li>
		<li>
			<b>Per Sequence Quality:</b>
			(upper right): This plot shows a sequence quality histogram. y-axis shows number of reads. Preferably, sequence quality should peak at a score >= 35.
		</li>
		<li>
			<b>GC Content:</b>
			(lower left): This plot shows a histogram of the the GC content. y-axis shows number of reads.
		</li>
		<li>
			<b>Per Base Sequence:</b>
			(lower right): This plot shows the fractions of T, C, A and G for every base position in the read. A balanced mix is typically only seen in the 20 bp sgRNA sequence. 
		</li>
	</ul>

	<h5><u>Sequencing Depth:</u></h5>

	<p>This tab shows the sequencing depth (number of total reads) per sample. Results from the alignment analysis are superimposed on each bar.</p>

	<h2 id="h-2.3">2.3 Scatter Plots</h2>

	<h5><u>Treatment vs Control:</u></h5>
	<p>Scatterplots of normalized sgRNA counts in the sample versus the average normalized count in the controls. The fraction reaching significant enrichment/depletion (dependent on screen type) compared to the control is marked in green.</p>
	<h5><u>Replicate Correlation:</u></h5>
	<p>Scatterplots showing the normalized sgRNA counts in one replicate of each condition versus another. Pearson and Spearman correlation coefficients are reported. </p>

	<h2 id="h-2.4">2.4 Heatmap</h2>
	<p>Clustering of all samples in the dataset, based on to the most variable or most abundant/depleted sgRNAs (as set up on the configuration page). Log10 normalized read counts are color-coded from lowest (yellow) to highest (red).
	</p>

	<h2 id="h-2.5">2.5 Run Info</h2>

	<h5><u>Output Log:</u></h5>
	<p>This shows the program execution log.</p>
	<h5><u>Configuration</u></h5>
	<p>This file shows the parameter settings used in the run.</p>
	<h5><u>Sample Names</u></h5>
	<p>This table linkes file names and sample names (Replicates of the same condition are automatically numbered).</p>
	


	<h1 id="h-3">3 REFERENCES:</h1>
	<p class="c7 c26">
		<span>Anders,S. and Huber,W. (2010) Differential expression analysis for sequence count data. </span>
		<span class="c25">Genome Biol.</span>
		<span>, </span>
		<span class="c40">11</span>
		<span class="c3">, R106.</span>
	</p>
	<p class="c7 c26">
		<span>Doench,J.G. </span>
		<span class="c25">et al.</span>
		<span>&nbsp;(2016) Optimized sgRNA design to maximize activity and minimize off-target effects of CRISPR-Cas9. </span>
		<span class="c25">Nat. Biotechnol.</span>
		<span>, </span>
		<span class="c40">34</span>
		<span class="c3">, 184 &ndash;191.</span>
	</p>
	<p class="c7 c26">
		<span>Li,W. </span>
		<span class="c25">et al.</span>
		<span>&nbsp;(2014) MAGeCK enables robust identification of essential genes from genome-scale CRISPR/Cas9 knockout screens. </span>
		<span class="c25">Genome Biol.</span>
		<span class="c3">, 1 &ndash;12.</span>
	</p>
@stop
@section('customCSS')
	<style type="text/css">
				@import url('https://themes.googleusercontent.com/fonts/css?kit=fpjTOVmNbO4Lz34iLyptLTi9jKYd1gJzj5O2gWsEpXoyck2WCYPEMNySjZN0CHedca1e3wzjYK5A0tl3JJ4t5mDWJzaElwWlMs_TjJCn9-E');
				table td,table th {
					padding: 0
				}

				.c16 {
					border-right-style: dotted;
					padding: 0pt 5.8pt 0pt 5.8pt;
					border-bottom-color: #000000;
					border-top-width: 1pt;
					border-right-width: 1pt;
					border-left-color: #000000;
					vertical-align: top;
					border-right-color: #000000;
					border-left-width: 1pt;
					border-top-style: dotted;
					border-left-style: dotted;
					border-bottom-width: 1pt;
					width: 184.5pt;
					border-top-color: #000000;
					border-bottom-style: dotted
				}

				.c11 {
					border-right-style: dotted;
					padding: 0pt 5.8pt 0pt 5.8pt;
					border-bottom-color: #000000;
					border-top-width: 1pt;
					border-right-width: 1pt;
					border-left-color: #000000;
					vertical-align: top;
					border-right-color: #000000;
					border-left-width: 1pt;
					border-top-style: dotted;
					border-left-style: dotted;
					border-bottom-width: 1pt;
					width: 130.5pt;
					border-top-color: #000000;
					border-bottom-style: dotted
				}

				.c15 {
					border-right-style: dotted;
					padding: 0pt 5.8pt 0pt 5.8pt;
					border-bottom-color: #000000;
					border-top-width: 1pt;
					border-right-width: 1pt;
					border-left-color: #000000;
					vertical-align: top;
					border-right-color: #000000;
					border-left-width: 1pt;
					border-top-style: dotted;
					border-left-style: dotted;
					border-bottom-width: 1pt;
					width: 193.5pt;
					border-top-color: #000000;
					border-bottom-style: dotted
				}

				.c42 {
					border-right-style: dotted;
					padding: 0pt 5.8pt 0pt 5.8pt;
					border-bottom-color: #000000;
					border-top-width: 1pt;
					border-right-width: 1pt;
					border-left-color: #000000;
					vertical-align: top;
					border-right-color: #000000;
					border-left-width: 1pt;
					border-top-style: dotted;
					border-left-style: dotted;
					border-bottom-width: 1pt;
					width: 95.4pt;
					border-top-color: #000000;
					border-bottom-style: dotted
				}

				.c41 {
					border-right-style: dotted;
					padding: 0pt 5.8pt 0pt 5.8pt;
					border-bottom-color: #000000;
					border-top-width: 1pt;
					border-right-width: 1pt;
					border-left-color: #000000;
					vertical-align: top;
					border-right-color: #000000;
					border-left-width: 1pt;
					border-top-style: dotted;
					border-left-style: dotted;
					border-bottom-width: 1pt;
					width: 131.4pt;
					border-top-color: #000000;
					border-bottom-style: dotted
				}

				.c20 {
					border-right-style: dotted;
					padding: 0pt 5.8pt 0pt 5.8pt;
					border-bottom-color: #000000;
					border-top-width: 1pt;
					border-right-width: 1pt;
					border-left-color: #000000;
					vertical-align: top;
					border-right-color: #000000;
					border-left-width: 1pt;
					border-top-style: dotted;
					border-left-style: dotted;
					border-bottom-width: 1pt;
					width: 157.5pt;
					border-top-color: #000000;
					border-bottom-style: dotted
				}

				.c38 {
					color: #366091;
					font-weight: 700;
					text-decoration: none;
					vertical-align: baseline;
					font-size: 20pt;
					font-style: normal
				}

				.c8 {
					color: #000000;
					font-weight: 700;
					text-decoration: underline;
					vertical-align: baseline;
					font-size: 12pt;
					font-style: normal;
					margin-top: 1em;
				}

				.c3 {
					color: #000000;
					font-weight: 600;
					text-decoration: none;
					vertical-align: baseline;
					font-size: 11pt;
					font-style: normal
				}

				.c0 {
					color: #00000a;
					font-weight: 400;
					text-decoration: none;
					vertical-align: baseline;
					font-size: 11pt;
					font-style: normal
				}

				.c12 {
					color: #000000;
					font-weight: 400;
					text-decoration: underline;
					vertical-align: baseline;
					font-size: 12pt;
					font-style: normal
				}

				.c32 {
					color: #000000;
					font-weight: 400;
					text-decoration: none;
					vertical-align: baseline;
					font-size: 11pt;
					font-family: "Calibri";
					font-style: normal
				}

				.c30 {
					color: #000000;
					font-weight: 400;
					text-decoration: none;
					vertical-align: baseline;
					font-size: 11pt;
					font-family: "Courier New";
					font-style: normal
				}

				.c19 {
					color: #000000;
					font-weight: 700;
					text-decoration: none;
					vertical-align: baseline;
					font-size: 11pt;
					font-style: normal
				}

				.c18 {
					color: #00000a;
					font-weight: 700;
					text-decoration: none;
					vertical-align: baseline;
					font-size: 11pt;
					font-style: normal
				}

				.c6 {
					color: #0000ff;
					font-weight: 400;
					text-decoration: underline;
					vertical-align: baseline;
					font-size: 11pt;
					font-style: normal
				}

				.c10 {
					color: #000000;
					font-weight: 400;
					text-decoration: underline;
					vertical-align: baseline;
					font-size: 11pt;
					font-style: normal
				}

				.c36 {
					color: #000000;
					font-weight: 400;
					text-decoration: none;
					vertical-align: baseline;
					font-size: 12pt;
					font-style: normal
				}

				.c34 {
					margin-left: 72pt;
					padding-top: 0pt;
					padding-left: 0pt;
					padding-bottom: 18pt;
					line-height: 1.0;
					text-align: left
				}

				.c2 {
					margin-left: 2em;
					padding-top: 0pt;
					padding-left: 0pt;
					line-height: 1.0;
					text-align: justify
				}

				.c35 {
					color: #00000a;
					font-weight: 400;
					text-decoration: none;
					vertical-align: baseline;
					font-size: 11pt;
				}

				.c17 {
					margin-left: 22pt;
					padding-top: 0pt;
					padding-bottom: 5pt;
					line-height: 1.0;
					text-align: justify
				}

				.c9 {
					padding-top: 30pt;
					line-height: 1.0;
					page-break-after: avoid;
					text-align: justify
				}

				.c51 {
					text-decoration: underline;
					vertical-align: baseline;
					font-size: 16pt;
					font-style: normal
				}

				.c24 {
					padding-top: 24pt;
					padding-bottom: 0pt;
					line-height: 1.0;
					page-break-after: avoid;
					text-align: justify
				}

				.c33 {
					padding-top: 42pt;
					line-height: 1.0;
					page-break-after: avoid;
					text-align: justify
				}

				.c31 {
					margin-left: 11pt;
					padding-top: 0pt;
					padding-bottom: 5pt;
					line-height: 1.0;
					text-align: justify
				}

				.c49 {
					font-weight: 400;
					text-decoration: none;
					vertical-align: baseline;
					font-size: 11pt;
				}

				.c48 {
					color: #0000ff;
					font-weight: 400;
					font-size: 11pt;
				}

				.c23 {
					font-size: 14pt;
					color: #4f81bd;
					font-weight: 700
				}

				.c44 {
					margin-left: -5.8pt;
					border-spacing: 0;
					border-collapse: collapse;
					margin-right: auto
				}

				.c45 {
					padding-top: 0pt;
					padding-bottom: 5pt;
					line-height: 1.0;
					text-align: justify
				}

				.c7 {
					padding-top: 0pt;
					padding-bottom: 6pt;
					line-height: 1.0;
					text-align: justify
				}

				.c14 {
					padding-top: 24pt;
					line-height: 1.0;
					text-align: justify
				}

				.c13 {
					padding-top: 12pt;
					padding-bottom: 4pt;
					line-height: 1.0;
					text-align: justify
				}

				.c39 {
					padding-top: 0pt;
					padding-bottom: 0pt;
					line-height: 1.15;
					text-align: left
				}

				.c1 {
					padding-top: 18pt;
					padding-bottom: 12pt;
					line-height: 1.0;
					text-align: justify
				}

				.c28 {
					padding-top: 0pt;
					padding-bottom: 0pt;
					line-height: 1.0;
					text-align: justify
				}

				.c47 {
					text-decoration: none;
					vertical-align: baseline;
					font-style: normal
				}

				.c43 {
					background-color: #ffffff;
					max-width: 501.1pt;
					padding: 43.2pt 67.7pt 72pt 43.2pt
				}

				.c50 {
					font-weight: 400;
					font-size: 11pt;
					font-family: "Arial"
				}

				.c21 {
					margin-left: 36pt;
					padding-left: 0pt
				}

				.c27 {
					margin-left: 18pt;
					padding-left: 0pt
				}

				.c5 {
					color: inherit;
					text-decoration: inherit
				}

				.c26 {
					margin-left: 24pt;
					text-indent: -24pt
				}

				.c37 {
					color: #0000ff;
					text-decoration: underline
				}

				.c25 {
					font-style: italic
				}

				.c29 {
					height: 0pt
				}

				.c22 {
					height: 11pt
				}

				.c40 {
					font-weight: 700
				}

				.c46 {
					color: #000000
				}

				.c52 {
					font-family: "Calibri"
				}

				.title {
					padding-top: 24pt;
					color: #000000;
					font-weight: 700;
					font-size: 36pt;
					padding-bottom: 6pt;
					line-height: 1.0;
					page-break-after: avoid;
					text-align: justify
				}

				.subtitle {
					padding-top: 0pt;
					color: #4f81bd;
					font-size: 12pt;
					padding-bottom: 6pt;
					font-family: "Cambria";
					line-height: 1.0;
					font-style: italic;
					text-align: justify
				}

				p {
					margin: 0;
					color: #000000;
					font-size: 11pt;
				}

				#content h1 {
					padding-top: 24pt;
					color: #366091;
					font-weight: 700;
					font-size: 20pt;
					padding-bottom: 0pt;
					line-height: 1.0;
					page-break-after: avoid;
					text-align: justify
				}

				#content h2 {
					padding-top: 42pt;
					color: #4f81bd;
					font-weight: 700;
					font-size: 16pt;
					line-height: 1.0;
					page-break-after: avoid;
					text-align: justify
				}

				#content h3 {
					padding-top: 10pt;
					font-weight: 700;
					font-size: 14pt;
					padding-bottom: 0pt;
					font-family: "Cambria";
					line-height: 1.0;
					page-break-after: avoid;
					text-align: justify
				}

				#content h4 {
					padding-top: 12pt;
					color: #000000;
					font-weight: 700;
					font-size: 12pt;
					padding-bottom: 2pt;
					line-height: 1.0;
					page-break-after: avoid;
					text-align: justify
				}

				#content h5 {
					padding-top: 11pt;
					color: #000000;
					font-weight: 700;
					font-size: 11pt;
					padding-bottom: 2pt;
					line-height: 1.0;
					page-break-after: avoid;
					text-align: justify
				}

				#content h6 {
					padding-top: 10pt;
					color: #000000;
					font-weight: 700;
					font-size: 10pt;
					padding-bottom: 2pt;
					line-height: 1.0;
					page-break-after: avoid;
					text-align: justify
				}
			</style>
@stop