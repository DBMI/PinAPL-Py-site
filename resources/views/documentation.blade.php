@extends('layouts.master')

@section('content')
	<p class="c45" id="h.gjdgxs">
		<span class="c3">
			<a class="c5" href="#h-1">1 Running PinAPL-Py</a>
		</span>
	</p>
	<p class="c31">
		<span class="c3">
			<a class="c5" href="#h-1.1">1.1 QUICK START</a>
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
			<a class="c5" href="#h-1.2">1.2 ADVANCED OPTIONS</a>
		</span>
	</p>
	<p class="c17">
		<span class="c3">
			<a class="c5" href="#h-1.2.1">1.2.1 Parameter description </a>
		</span>
	</p>
	<p class="c17">
		<span class="c3">
			<a class="c5" href="#h-1.2.2">1.2.2 Uploading a custom library</a>
		</span>
	</p>
	<p class="c45">
		<span class="c3">
			<a class="c5" href="#h-2">2 Description of the PinAPL-Py Analysis output </a>
		</span>
	</p>
	<p class="c17">
		<span class="c3">
			<a class="c5" href="#h-2.1">2.1 Gene Ranking Results </a>
		</span>
	</p>
	<p class="c17">
		<span class="c3">
			<a class="c5" href="#h-2.2">2.2 sgRNA Ranking Results </a>
		</span>
	</p>
	<p class="c17">
		<span class="c3">
			<a class="c5" href="#h-2.3">2.3 Alignment Results</a>
		</span>
	</p>
	<p class="c17">
		<span class="c3">
			<a class="c5" href="#h-2.4">2.4 Run Info</a>
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
		Upload your files via the drag-and-drop frame. Uncompressed format (.fastq) is supported, but compressed (.fastq.gz) is strongly recommended for speed.</span>
	</p>
	<p class="c8" id="h-step3">Step 3: ENTER SAMPLE INFORMATION
	</p>
	<p>Enter the <b>name of the condition each</b> file represents. <b>Files representing replicates of the same condition have to be given the same name. Do not number your replicates</b>. Numbering is done automatically by the program and displayed on the results page after completion of the analysis. 
	<p>Please mark all <b>control replicates</b> with the checkbox to the right. Naming the control samples is optional</p>
	Example:
	<SCREENSHOT>
	Here, two files represent replicates of treatment with Toxin A. Two files represent replicates of treatment with Toxin B. Two files represent replicates of the control treatment.
	</p>
	<img src="/img/screenshot_doc.png" align="middle">
	<p id="h-step4" class="c8">Step 4: CONFIGURE YOUR ANALYSIS RUN
	</p>
   <p>
		First, choose the <b>screen type</b>. Choose between &ldquo;enrichment&rdquo; (e.g. a drug resistance screen) or &ldquo;depletion&rdquo; (e.g. a gene-essentiality screen), depending on whether your screen aims at finding sgRNAs of high or low abundance, respectively. Next, choose the <b>sgRNA library</b> used in your screen from the dropdown menu. If your screen uses a library not present in the list or a custom library, see &ldquo;Uploading a custom library&rdquo; in the Advanced Options below.
	</p>
   <p>
		Optional: If you would like to edit the default parameter settings, click <b>Advanced Options</b>. For instructions on these parameters, see “Parameter description” in the Advanced Options section.
	</p>
	<p class="c8" id="h-step5"> Step 5: RUNNING AND COMPLETION </p>
	<p>
		You can follow the program’s execution log by refreshing the page repeatedly. In case another run was started before yours, your run will be queued and start after completion of the previous. </p>
	<p>
		If you provided an email address, you can close the browser; you will be notified by email and sent a link to the results after completion. Otherwise, please leave the progress screen open. 
	</p>
	<p>
		The results will remain on the server for 5 days. You can download all content shown on the results page in a single ZIP archive.
	</p>
	<h2 id="h-1.2">1.2 ADVANCED OPTIONS</h2>
	</h2>
	<h3 id="h-1.2.1">1.2.1 <u>Parameter Description</u></h3>
	</p>
	<h4>Gene Ranking</h4>
    
	<h5><u>Gene Ranking Metric (default = "SUMLFC"): </u></h5>
	<p>Method to combine the sgRNA enrichment/depletion data for ranking of genes: </p>
	<ul>
		<li>
			<b>SUMLFC:</b> <span style="color:red">*** NEW in v2.9 ***</span> This method computes a gene score by taking the sum of the log fold-changes of all sgRNAs targeting it, and multiplying it by the number of its sgRNAs that reached statistically significant enrichment/depletion.
		</li>
		<li>
			<b>AVGLFC:</b> This method computes a gene score by averaging the log fold-changes of all sgRNAs targeting it.
		</li>
		<li>
			<b>αRRA:</b> Adjusted robust rank aggregation (Li et al., 2014). This method computes a gene score based on a Beta model of the aggregation of sgRNAs. 
		</li>
		<li>
			<b>STARS:</b> STARS score (Doench et al., 2016). This method computes a gene score based on a binomial model. It requires a gene to have at least two sgRNAs ranked among the top x% (see the “sgRNAs Included (STARS only)” parameter below). 
		</li>
	</ul>
	<p>For more details on these methods, please refer to the original publications or use our contact page.</p>

	<h5><u>Number of permutations (default = 1000): </u></h5>
	<p>
		Number of permutations for p-value estimation of the gene ranking score. <b>CAUTION:</b> If STARS is chosen, reducing the number of permutations (to e.g. 10) is strongly recommended, due to the increased computational demand.
	</p>

	<h5><u>Significance level (default = 0.01)</u></h5>
	<p>Significance threshold for gene ranking.</p>    
        
	<h5><u>%sgRNAs Included (STARS only) (default = 10):</u></h5>
	<p>Percentage of sgRNAs to be included in the ranking analysis. Only relevant if &ldquo;STARS &rdquo;method is chosen.</p>

	<br>
    
    <h4>sgRNA Ranking</h4>    
	<h5><u>p-value adjustment (default = "Sidak"):</u></h5>
	<p>Method for p-value adjustment for multiple tests.</p>
	<ul>
		<li><b>sidak:</b> Sidak correction method.</li>
        <li><b>fdr_bh:</b> Benjamini-Hochberg correction method.</li>	
		<li><b>bonferroni:</b> Bonferroni correction method.</li>
	</ul>    

	<h5><u>Significance level (default = 0.01)</u></h5>
	<p>Significance threshold for sgRNA ranking.</p>    
    
	<h5><u>Cluster by… (default = "Highest Variance"): </u></h5>
	<p>Criterion for sample clustering.</p>
	<ul>
		<li><b>Highest Variance:</b> Clustering of the samples is based on the sgRNAs with the highest read count variance across all samples.</li>
		<li><b>Highest Counts:</b> Clustering of the samples is based on the sgRNAs with the highest/lowest abundance (depending on whether the screen type is "enrichment"/"depletion").</li>
	</ul>

    <h5><u>Top% of sgRNAs for clustering (default = 25): </u></h5>
	<p>Specifies what quantile of sgRNAs clustering is based on. In case of clustering by highest counts, the top x sgRNAs from each sample are combined.</p>
    
	
	<h4>Read Counting</h4>
	<h5><u>Normalization: (default = &lsquo;cpm &rsquo;): </u></h5>
	<p>Method of read count normalization.</p>
	<ul>
		<li><b>total:</b> Read counts for each sgRNA are divided by the number of total number of reads in the sample and multiplied by the mean total number of read counts across all samples.</li>
		<li><b>cpm:</b> Counts per million. Read counts for each sgRNA are divided by the number of total read counts in the sample and multiplied by 1,000,000.</li>		
		<li><b>size:</b> Read counts are normalized using median ratios and the "size-factor" method, as decribed in (Li et al., 2014; Anders and Huber, 2010).</li>
	</ul>
	<h5><u>Cutoff (default = 0): </u></h5>
	<p>
		Cutoff threshold (given in cpm) to filter out low sgRNA read counts. sgRNAs with read counts lower than the cutoff will be set to 0.
	</p>
	<h5><u>Round Counts (default = No): </u></h5>
	<p>
		Round read counts after normalization to avoid fractional read counts. Rounding only affects visualization, but not significance analysis.
	</p>
	<h5><u>Averaging (default = Median): </u></h5>
	<p>
		Method of averaging sgRNA read counts across replicates (Median / Mean)
	</p>		
	
	
    <h4 id="ALIGNMENT">Alignment</h4>
	<h5><u>sgRNA Length (default = 20)</u></h5>
	<p>
		Length of the sgRNA in the sequence read.
	</p>
	<h5><u>Adapter Error Tolerance (default = 0.1)</u></h5>
	<p>
		Error rate (mismatches and indels) allowed for the identification of the 5’ adapter (Refer to the <a href="http://cutadapt.readthedocs.io/en/stable/guide.html#error-tolerance">cutadapt manual</a> for more details). Increasing this rate can help to control for poor sequence quality.
	</p>

	<h5><u>Matching Threshold (default = 40)</u></h5>
	<p>Minimal alignment score required to consider a read successfully matched. For a perfect match this must be double the sgRNA sequence length (Refer to the <a href="http://bowtie-bio.sourceforge.net/bowtie2/manual.shtml#scores-higher-more-similar">Bowtie2 manual</a> for more details on calculation of the alignment score). Decreasing this threshold will include reads with a less than optimal match to a library entry which can be helpful to increase sensitivity or control for poor sequence quality.</p>

	<h5><u>Ambiguity Threshold (default = 2):</u></h5>
	<p>Minimum tolerated difference between primary (best) and secondary (second-best) alignment to consider a read successfully matched. Reads with a difference lower than this threshold will be considered ambiguous and discarded. Increasing this threshold increases stringency. Decreasing this threshold increases sensitivity. With a threshold of 0, the program will accept reads even if they match multiple library entries equally well.</p>

	<h5><u>Seed Length (default = 11): </u></h5>
	<p>Seed length parameter for Bowtie2 alignment (-L, refer to the <a href="http://bowtie-bio.sourceforge.net/bowtie2/manual.shtml#options">Bowtie2 manual</a> for more details). Changing this parameter is generally not required.</p>

	<h5><u>Seed Number (default = 1):</u></h5>
	<p>Number of allowed mismatches for Bowtie2 seed alignment (-N, refer to the <a href="http://bowtie-bio.sourceforge.net/bowtie2/manual.shtml#options">Bowtie2 manual</a> for more details). Changing this parameter is generally not required.</p>

	<h5><u>Interval Function (default = "S,1,0.75"): </u></h5>
	<p>Bowtie2 seed interval function (-i, refer to the <a href="http://bowtie-bio.sourceforge.net/bowtie2/manual.shtml#options">Bowtie2 manual</a> for more details). Changing this parameter is generally not required.</p>


	<h4>Plotting</h4>
	<h5><u>Show Non-Targeting Controls (default = Yes):</u></h5>
	<p>Highlight non-targeting control sgRNAs (if present in the library) in scatterplots.</p>

	<h5><u>Annotate sgRNAs (default = No):</u></h5>
	<p>Display sgRNA IDs when highlighting individual genes in scatterplots.</p>

	<h5><u>Transparency Level (default = 0.05):</u></h5>
	<p>Transparency of points in scatterplots. A lower level is helpful to visualize differences in density. </p>

	<h5><u>Dotsize (default = 10):</u></h5>
	<p>Size of dots in scatterplots.</p>

	<h5><u>PNG Resolution (default = 300):</u></h5>
	<p>Resolution for PNG output (dpi).</p>
	
	<h5><u>Spreadsheet Format (default = Excel):</u></h5>
	<p>File format for sgRNA and gene tables in the download archive. Use "Excel" to have the workflow automatically convert all text tables into .xlsx format. "Text only" produces only .txt files which saves computation time, but requires manual import into Excel.</p>

	<h5><u>AutoHighlight Top Hits (default = Yes):</u> <span style="color:red">** NEW in v2.9 ***</span></h5>
	<p>Automatically draws scatterplots highlighting the 10 top ranked genes (only available in the download zip file, not on the website). Setting this to "No" saves computation time.</p>
	
	<h5><u>Include Density Plot (default = Yes):</u> <span style="color:red">** NEW in v2.9 ***</span></h5>
	<p>Draw a density plot of the sgRNA abundance for each sample. Setting this to "No" saves computation time.</p>	

	<h5><u>Signif. Level (Model Selection) (default = 0.05):</u></h5>
	<p>Significance level for choosing a statistical model for the read count distribution. If the data differs significantly from a Poisson distribution, the Negative Binomial distribution is chosen.</p>	


	<h3 id="h-1.2.2">1.2.2 <u>Uploading a custom library:</u></h3>
	<p>Prepare your library file (e.g. in Excel) as a spreadsheet with <b>3 columns (with headers): </b></p>
	<ul>
		<li><b>gene:</b> This column contains an identifier of the gene that is targeted by the sgRNA</li>
		<li><b>sgRNA_ID:</b> This column contains an identifier of the sgRNA</li>
		<li><b>sequence:</b> This column contains the (typically 20bp) sequence of the sgRNA</li>
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
		You can use the <b>"Save As"</b> menu item in Excel to do so.
	</p>
	<p>When your file is ready, use the file browser to select and upload your library file.</p>
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
	<p>If your library contains non-targeting controls, enter an <b>identifier</b> in the library spreadsheet to define the corresponding sgRNAs sequences. The identifier is a part of the gene_ID that is unique to the non-targeting controls (see example below). If your library does not contain non-targeting controls, enter <b>&ldquo;none&rdquo;</b></p>

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
	<p>The identifier in this case would be <b>“Non_Target”</b>.</p>


	<h5><u>Number of sgRNAs per gene:</u></h5>
	<p>
		Specify the number of sgRNAs targeting a single gene (e.g. 6 in case of the GeCKO library). If this number varies across the library, choose the number that applies to the majority of library entries. Non-targeting controls, miRNAs or other control entries in the library are excluded. 
	</p>






	<h1 id="h-2">2 Description of the PinAPL-Py Analysis output</h1>
   <p>
		The PinAPL-Py output is structured by logical order into tabs and subtabs on the results page. In addition, all output can be downloaded via the <b>“Download Results”</b> button as a single .zip file. Images are saved both as high-resolution .png as well as as .svg vector graphics which can be further processed in Adobe Illustrator or similar image processing software. Tables are saved as raw text (.txt), but can be manually opened with Excel and saved as Excel spreadsheets. For convenience, PinAPL-Py can convert tables on-the-fly (see the “Table Format” parameter on the configuration page), at the cost of additional computation time. NOTE for Windows users: To view text files (.txt/.tsv/.csv), <a target="blank" href="https://notepad-plus-plus.org/download/v7.2.1.html">Notepad++</a> is recommended
	</p>

	<br>
	<div class="callout warning">
		<p>NOTE: When the analysis is run with two or more replicate samples for a condition, PinAPL-Py will show an additional sample for that condition (named "&lt;condition name&gt;_avg") where results are averaged across the replicates.</p>
	</div>



	<h2 id="h-2.1">2.1 Gene Ranking Results</h2>

	<h5><u>Gene Rankings</u></h5>

	<p>This tab contains the results of the gene ranking analysis in a sortable table. The columns are:</p>
	<ul>
		<li><b>Gene:</b> Name of gene (as defined in the library file)</li>
		<li><b>Gene Score:</b> Value of the computed gene metric score</li>
		<li><b>Gene Score p-value</b>: Estimated (one-sided) p-value of the gene score, based on a permutation test where sgRNAs are randomly assinged to genes.</li>
		<li><b>Significant:</b> Statistical significance of the gene score.</li>
		<li><b># sgRNAs:</b>Number of sgRNAs targeting the gene</li>
		<li><b># Signif. sgRNAs:</b> Number of sgRNAs targeting the particular gene that reached statistical significance in the sgRNA ranking</li>
	</ul>
	<p>By default, the table is sorted by p-value. You can sort by other columns (ascending or descending) by clicking on the respective column headers (arrows).</p>

	<h5><u>Scatterplots</u></h5>
	<p>This tab plots the gene score for each gene (alphabetically sorted on the x-axis). Significant scores are plotted in green. Non-targeting controls (if present) are plotted in orange. The selector at the top can be used to highlight a particular gene of interest (After clicking the selection box, you can type first letter of the gene name to find the gene more quickly). </p>

	<h5><u>p-Value Distribution</u></h5>
	<p>This tab shows the distribution of p-values from the gene ranking analysis. Typically, a bimodal distribution is seen, with a small bar on the left end and a large bar on the right end.</p>

	<h5><u>sgRNA Efficacy:</u></h5>
	<p>This tab shows information about the overall efficacy of sgRNAs targeting the same gene. Genes are categorized by the number of targeting sgRNAs that reached statistically significant enrichment/depletion. Genes having no significant sgRNAs are omitted. </p>

	<h2 id="h-2.2">2.2 sgRNA Ranking Results</h2>
	
	<h5><u>Rankings</u></h5>

	<p>This tab contains the results of the sgRNA ranking analysis in a sortable table. The columns are:</p>
	<ul>
		<li><b>sgRNA:</b> Identifier of sgRNA </li>
		<li><b>Gene:</b> Name of target gene </li>
		<li><b>Counts:</b> Normalized read count </li>
		<li><b>Control Mean: </b>Average normalized read count of this sgRNA in the control </li>
		<li><b>Control StDev:</b> Standard deviation of normalized read count in the control</li>
		<li><b>Fold Change:</b> The ratio of normalized read count in the sample to the control average</li>
		<li><b>p-value:</b> p-value (one-sided) of the enrichment/depletion of this sgRNA compared to the control</li>
		<li><b>Significant:</b> Statistical significance of the enrichment/depletion of this sgRNA</li>
	</ul>
	<p>By default, the table is sorted by p-value. You can sort by other columns (ascending or descending) by clicking on the respective column headers (arrows).</p>	

	<h5><u>Plots</u></h5>
	
	<h6><u>Treatment vs Control</u></h6>
	<p>Scatterplots of normalized sgRNA read counts in the sample versus the average normalized count in the controls. The fraction reaching significant enrichment/depletion (dependent on screen type) compared to the control is plotted in green. Non-targeting controls (if present) are plotted in orange. The selector at the top can be used to highlight a particular gene of interest (After clicking the selection box, you can type first letter of the gene name to find the gene more quickly). After highlighting a particular gene, the IDs of the corresponding sgRNAs can be displayed using the checkbox on the far right. Highlighting of non-targeting controls can be switched on or off with the checkbox next to the gene selector.</p>	

	<h6><u>Density Plots</u> <span style="color:red">**** NEW in v2.9 ***</span></h6>
	<p>Same data as the previous tab, but showing a density plot of the sgRNA abundance.</p>	

	<h6><u>Volcano Plots</u></h6>	
	<p>This tab plots sgRNA p-value against fold-change. The fraction reaching significant enrichment/depletion (dependent on screen type) compared to the control is plotted in green. Non-targeting controls (if present) are plotted in orange. The selector at the top can be used to highlight a particular gene of interest (After clicking the selection box, you can type first letter of the gene name to find the gene more quickly). After highlighting a particular gene, the IDs of the corresponding sgRNAs can be displayed using the checkbox on the far right. Highlighting of non-targeting controls can be switched on or off with the checkbox next to the gene selector. p-values are capped at 1e-16 for technical purposes. </p>

	<h6><u>z-Score Plots</u></h6>
	<p>This tab shows the fold-change for each sgRNA ranked from lowest to highest. The z-Score is the normalized deviation from the mean read count. The fraction reaching significant enrichment/depletion (dependent on screen type) compared to the control is plotted in green. Non-targeting controls (if present) are plotted in orange. The selector at the top can be used to highlight a particular gene of interest (After clicking the selection box, you can type first letter of the gene name to find the gene more quickly). After highlighting a particular gene, the IDs of the corresponding sgRNAs can be displayed using the checkbox on the far right. Highlighting of non-targeting controls can be switched on or off with the checkbox next to the gene selector.</p>
	
	<h6><u>p-Values</u></h6>
	<p>This tab shows the distribution of p-values from the sgRNA enrichment/depletion analysis.</p>

	<h6><u>Read Count Distribution</u></h6>
	<p>This tab shows information about the statistical distribution of sgRNA read counts. </p>
	<ul>
		<li><b>Left: Lorenz curves and Gini coefficients:</b> The Lorenz curve visualizes the distribution of reads, showing what fraction of sgRNAs (green) or genes (blue) is represented by what fraction of reads. The Gini coefficient quantifies the difference of this distribution from a perfectly even distribution. A perfectly even distribution would result in a diagonal curve (Gini coefficient = 0) and would indicate a complete absence of selection in the screen. An extremely uneven distribution results in a flat curve (Gini coefficient = 1) and would indicate extreme selection (only a single sgRNA/gene is represented in the sequencing data). Thus, the more selective the conditions of the screen are, the closer will the Gini coefficient approach 1.</li>
		<li><b>Right: Boxplots and histograms:</b> Boxplots and histograms for the read counts per sgRNA (green) or gene (blue), respectively. Outliers are omitted for visualization purposes.</li>
		<li><b>Bottom: Summary:</b> Descriptive statistics are summarized. sgRNA/gene representation measures the number of sgRNAs/genes detected by at least one read count in the sample (as percentage of the full library). </li>
	</ul>	

	<h6><u>Clusters</u></h6>
	<p>This tab shows a cluster analysis (heatmap) of all samples in the dataset, based on the most variable or most abundant/depleted sgRNAs (as chosen on the configuration page). Log10 normalized read counts are color-coded from lowest (yellow) to highest (red).
	</p>
	
	<h6><u>Replicate Correlation:</u></h6>
	<p>Scatterplots showing the normalized sgRNA read counts in one replicate of each condition versus another. Pearson and Spearman correlation coefficients are reported. Non-targeting controls (if present) are plotted in orange. </p>

	<h6><u>Read Count Dispersion:</u></h6>
	<p>This tab shows the distribution of read counts in the control samples only. These data are used to estimate the parameters of the statistical model describing the distribution of sgRNA read counts throughout the rest of the dataset.</p>
	<ul>
		<li><b>Left: Read Count Overdispersion:</b> This plot visualizes the degree of overdispersion in the data, i.e. the degree by which the variance of read counts exceeds the mean (as typically seen in next-generation sequencing datasets). In case of significant overdispersion, a negative binomial model is chosen over a Poisson model.</li>
		<li><b>Right: Mean/Variance Model:</b> This plot shows shows a regression of log overdispersion against log mean. This is required to compute the parameters of the statistical model.</li>
	</ul>


	<h2 id="h-2.3">2.3 Alignment Results</h2>
	
	<h5><u>Summary</u></h5>
	<p>This tab shows the sequencing depth (number of total reads) per sample as well as the fractions of reads successfully or unsuccessfully aligned to the reference library. 
	Alignment Unique: Only a single match found in the reference library.
	Alignment Tolerated: Multiple matches found in the reference library, but the difference in matching score between the best and second-best was above the ambiguity threshold.
	Alignment Ambiguous: Multiple matches found in the reference library, and the difference in matching score between the best and second-best was below the ambiguity threshold.
	Alignment Failed: No match found in reference library.
	Reads with failed and ambiguous alignment are discarded prior to the subsequent enrichment/depletion analysis.</p>

	<h5><u>Alignment Statistics</u></h5>
	<ul>
		<li><b>Left: Mapping Quality:</b> Histogram of the overall quality by which the reads mapped to the reference library. Reads that uniquely align to a single library sequence yield a high mapping quality score. Reads that ambiguously align to multiple library sequences or that do not align to any library sequence yield a low mapping quality score. For more detailed information about computation of the mapping quality score, please refer to the <a class="c5" target="_blank" href="http://bowtie-bio.sourceforge.net/bowtie2/manual.shtml#mapping-quality-higher-more-unique">Bowtie2 manual</a>.</li>
		<li><b>Right: Alignment Analysis:</b> Barplot showing the primary (best) and secondary (second-best) alignment scores achieved for each read. If a read perfectly aligns to only one library sequence, its primary alignment score will be maximal, and its secondary alignment score will be 0. If a read aligns ambiguously to multiple library sequences, its secondary alignment score will be close to its primary alignment score. If a read does not align to any library sequence, both its primary and secondary alignment scores will be 0. The fraction of reads marked in red is being discarded prior to enrichment/depletion analysis.</li>
		<li><b>Bottom: Summary:</b> This text summarizes the the success of the alignment. For an explanation of the parameter settings reported at the bottom of the page, see the <a href="#ALIGNMENT">ALIGNMENT</a> section).  </li>
	</ul>	
	

	<h5><u>Sequence Quality:</u></h5>
	<p>This tab provides analyses for sequence quality control (produced by fastqc). For the full fastqc output, click the “See full report” link </p>
	<ul>
		<li>
			<b>Upper Left: Per Base Quality:</b>
			This plot shows the quality distribution for every base position in the read. y-axis is sequence quality score (Phred). Preferably, the majority of the read is in the green area.
		</li>
		<li>
			<b>Upper Right: Per Sequence Quality:</b>
			This plot shows a sequence quality histogram. y-axis shows number of reads. Preferably, sequence quality should peak at a score >= 35.
		</li>
		<li>
			<b>Lower Left: GC Content:</b>
			This plot shows a histogram of the the GC content. y-axis shows number of reads.
		</li>
		<li>
			<b>Lower Right: Per Base Sequence Variation:</b>
			This plot shows the fractions of T, C, A and G for every base position in the read. A balanced mix is typically only seen in the 20 bp sgRNA sequence. 
		</li>
	</ul>



	<h2 id="h-2.4">2.4 Run Info</h2>

	<h5><u>Output Log</u></h5>
	<p>This shows the program execution log. If you experience technical difficulties during your run, browse the log for error messages as they can provides clues for trouble-shooting.</p>
	<h5><u>Configuration</u></h5>
	<p>This file shows the parameter settings used for the analysis run.</p>
	<h5><u>Sample Names</u></h5>
	<p>This table shows file names and the corresponding sample names. Replicates of the same condition are numbered automatically.</p>
	


	<h1 id="h-3">3 REFERENCES</h1>
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
