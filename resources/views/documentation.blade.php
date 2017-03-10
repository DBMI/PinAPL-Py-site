@extends('layouts.master')

@section('content')
	<p class="c39 c22">
            <span class="c47 c46 c50"></span>
        </p>
        <p class="c45" id="h.gjdgxs">
            <span class="c3">
                <a class="c5" href="#h.30j0zll">Running PinAPL-Py</a>
            </span>
        </p>
        <p class="c31">
            <span class="c3">
                <a class="c5" href="#h.1fob9te">QUICK START:</a>
            </span>
        </p>
        <p class="c17">
            <span class="c3">
                <a class="c5" href="#h.3znysh7">Step 1: SET UP A RUN </a>
            </span>
        </p>
        <p class="c17">
            <span class="c3">
                <a class="c5" href="#h.2et92p0">Step 2: UPLOAD DATA </a>
            </span>
        </p>
        <p class="c17">
            <span class="c3">
                <a class="c5" href="#h.tyjcwt">Step 3: ENTER SAMPLE INFORMATION </a>
            </span>
        </p>
        <p class="c17">
            <span class="c3">
                <a class="c5" href="#h.3dy6vkm">Step 4: CONFIGURE YOUR ANALYSIS RUN </a>
            </span>
        </p>
        <p class="c17">
            <span class="c3">
                <a class="c5" href="#h.1t3h5sf">Step 5: RUNNING AND COMPLETION </a>
            </span>
        </p>
        <p class="c31">
            <span class="c3">
                <a class="c5" href="#h.4d34og8">ADVANCED OPTIONS:</a>
            </span>
        </p>
        <p class="c17">
            <span class="c3">
                <a class="c5" href="#h.2s8eyo1">Parameters </a>
            </span>
        </p>
        <p class="c17">
            <span class="c3">
                <a class="c5" href="#h.26in1rg">Uploading a custom library:</a>
            </span>
        </p>
        <p class="c45">
            <span class="c3">
                <a class="c5" href="#h.35nkun2">Description of the PinAPL-Py Analysis output </a>
            </span>
        </p>
        <p class="c17">
            <span class="c3">
                <a class="c5" href="#h.1ksv4uv">Enrichment/Depletion </a>
            </span>
        </p>
        <p class="c17">
            <span class="c3">
                <a class="c5" href="#h.44sinio">Statistics </a>
            </span>
        </p>
        <p class="c17">
            <span class="c3">
                <a class="c5" href="#h.z337ya">Scatter Plots</a>
            </span>
        </p>
        <p class="c17">
            <span class="c3">
                <a class="c5" href="#h.3j2qqm3">Heatmap</a>
            </span>
        </p>
        <p class="c17">
            <span class="c3">
                <a class="c5" href="#h.1y810tw">Output Log</a>
            </span>
        </p>
        <p class="c45" id="refrences-header">
            <span class="c3">
                <a class="c5" href="#refrences-section">References</a>
            </span>
        </p>
        <hr style="page-break-before:always;display:none;">
        <p class="c22 c39">
            <span class="c32"></span>
        </p>
        <h1 class="c24" id="h.30j0zll">
            <span class="c38">Running PinAPL-Py</span>
        </h1>
        <h2 class="c33" id="h.1fob9te">
            <span class="c23 c47">QUICK START:</span>
        </h2>
        <p class="c9" id="h.3znysh7">
            <span class="c8">Step 1: SET UP A RUN</span>
        </p>
        <p class="c7">
            <span class="c3">Enter a valid e-mail address and a name for your analysis run. You will get a confirmation message at creation and upon completion of the analysis.</span>
        </p>
        <p class="c9" id="h.2et92p0">
            <span class="c8">Step 2: UPLOAD DATA</span>
        </p>
        <p class="c7">
            <span class="c3">Upload your files (.fastq.gz) via the drag-and-drop frame. </span>
        </p>
        <p class="c9" id="h.tyjcwt">
            <span class="c8">Step 3: ENTER SAMPLE INFORMATION</span>
        </p>
        <p class="c7">
            <span>For &ldquo;</span>
            <span class="c40">Sample Type</span>
            <span class="c3">&rdquo;, use the selector to define which of your files represent a treatment and which represent a control. </span>
        </p>
        <p class="c7">
            <span class="c3">Controls are samples in relation to which the enrichment/depletion is to be measured. Examples would be an untreated sample, samples at t=0, the plasmid library, etc. PinAPL-Py requires at least one control file! </span>
        </p>
        <p class="c7">
            <span class="c3">Treatments are all samples that are not controls. These could be samples treated with toxins, samples measured at different time-points or samples representing any other sort of condition. </span>
        </p>
        <p class="c7">
            <span>Under </span>
            <span class="c40">&ldquo;Treatment Name &rdquo;,</span>
            <span>&nbsp;enter a </span>
            <span class="c40">name</span>
            <span class="c3">&nbsp;(no white spaces allowed) for each of your treatments. If multiple files represent different replicates of the same treatment, make sure to give them the same name.</span>
        </p>
        <p class="c9" id="h.3dy6vkm">
            <span class="c8">Step 4: CONFIGURE YOUR ANALYSIS RUN</span>
        </p>
        <p class="c7">
            <span>First, choose the </span>
            <span class="c40">screen</span>
            <span>&nbsp;</span>
            <span class="c40">type</span>
            <span class="c3">. Choose between &ldquo;enrichment &rdquo;(e.g. a drug resistance screen) or &ldquo;depletion &rdquo;(e.g. a gene-essentiality screen), depending on whether your screen aims at finding sgRNAs of high or low abundance, respectively.</span>
        </p>
        <p class="c7">
            <span>Next, choose the </span>
            <span class="c40">sgRNA library</span>
            <span class="c3">&nbsp;used in your screen from the dropdown menu. If your screen uses a library not present in the list or a custom library, see &ldquo;Uploading a custom library &rdquo;in the Advanced Options below.</span>
        </p>
        <p class="c7">
            <span>Optional: If you would like to edit the </span>
            <span class="c40">advanced parameters</span>
            <span>&nbsp;of the run, click the &ldquo;Advanced &rdquo;tab. For instructions on these parameters, see &ldquo;Parameter description &rdquo;in the Advanced Options below.</span>
        </p>
        <p class="c7 c22">
            <span class="c8"></span>
        </p>
        <p class="c9" id="h.1t3h5sf">
            <span class="c8">Step 5: RUNNING AND COMPLETION</span>
        </p>
        <p class="c7">
            <span class="c3">After starting the run, it will be placed in the queue or start immediately. At start, the output log will be displayed. Please keep refreshing the page to see the progress. The run time depends on the number of reads and the number of files. A typical run (20M reads per sample, 2 Controls, 2 Treatment replicates), analyzed with default parameters will take ~2hrs with the current version. Upon completion, you will receive an Email with a URL to the results page. You can browse the results on the web-application or download a ZIP archive. The results will remain on the server for 30 days. &nbsp;</span>
        </p>
        <h2 class="c33" id="h.4d34og8">
            <span>ADVANCED </span>
            <span class="c23">OPTIONS</span>
            <span class="c23 c47">:</span>
        </h2>
        <p class="c9" id="h.2s8eyo1">
            <span class="c8">Parameters</span>
        </p>
        <p class="c14">
            <span class="c3">READ COUNTING</span>
        </p>
        <p class="c13">
            <span class="c10">Normalization: (default = &lsquo;cpm &rsquo;): </span>
        </p>
        <p class="c7">
            <span class="c3">Method of read count normalization.</span>
        </p>
        <ul class="c4 lst-kix_list_5-0 start">
            <li>
                <span class="c19">cpm:</span>
                <span class="c3">&nbsp;Counts per million. Read counts are divided by the number of total read counts in the sample and multiplied by 1,000,000.</span>
            </li>
            <li>
                <span class="c19">total: </span>
                <span class="c3">Read counts are divided by the number of total read counts in the sample and multiplied by the mean total read count across all samples.</span>
            </li>
            <li>
                <span class="c19">size: </span>
                <span class="c3">Read counts are normalized using size-factors and the &ldquo;median ratio &rdquo;method (Li </span>
                <span class="c49 c25 c46">et al.</span>
                <span class="c3">, 2014; Anders and Huber, 2010).</span>
            </li>
        </ul>
        <p class="c13">
            <span class="c10">Cutoff (default = 0): </span>
        </p>
        <p class="c7">
            <span class="c3">Cutoff for low sgRNA counts. If a number&gt;0 is entered, sgRNA counts (as normalized to 1M reads) below this number will be set to 0.</span>
        </p>
        <p class="c14">
            <span class="c3">HEATMAP</span>
        </p>
        <p class="c13">
            <span class="c10">Cluster By (default = &lsquo;variance &rsquo;): </span>
        </p>
        <p class="c7">
            <span class="c3">Method for sample clustering.</span>
        </p>
        <ul class="c4 lst-kix_list_4-0 start">
            <li>
                <span class="c19">variance:</span>
                <span class="c3">&nbsp;Clustering of the samples is based on the sgRNAs with the highest read count variance across all samples.</span>
            </li>
            <li>
                <span class="c19">counts:</span>
                <span class="c3">&nbsp;Clustering of the samples is based on the sgRNAs with the highest/lowest abundance (depending on whether the screen type is &ldquo;enrichment &rdquo;or &ldquo;depletion &rdquo;).</span>
            </li>
        </ul>
        <p class="c13">
            <span class="c10">Number of sgRNAs for clustering (default = 25): </span>
        </p>
        <p class="c7">
            <span class="c3">Specify how many sgRNAs are used for clustering with the method selected above. </span>
        </p>
        <p class="c14">
            <span class="c3">GENE RANKING</span>
        </p>
        <p class="c13">
            <span class="c10">Gene Metric (default = &lsquo;&alpha;RRA &rsquo;): </span>
        </p>
        <p class="c13">
            <span class="c3">Method to aggregate sgRNAs and perform gene ranking. For details refer to the original publications.</span>
        </p>
        <ul class="c4 lst-kix_list_6-0 start">
            <li>
                <span class="c19">ES: </span>
                <span class="c3">Enrichment score (Subramanian </span>
                <span class="c25 c46 c49">et al.</span>
                <span class="c3">, 2005).</span>
            </li>
            <li>
                <span class="c19">&alpha;RRA:</span>
                <span class="c3">&nbsp;Adjusted robust rank aggregation (Li </span>
                <span class="c49 c25 c46">et al.</span>
                <span class="c3">, 2014).</span>
            </li>
            <li>
                <span class="c19">STARS:</span>
                <span class="c3">&nbsp;STARS score (Doench </span>
                <span class="c49 c25 c46">et al.</span>
                <span class="c3">, 2016).</span>
            </li>
        </ul>
        <p class="c13">
            <span class="c10">Number of permutations (default = 1000): </span>
        </p>
        <p class="c7">
            <span class="c3">Number of permutations for p-value estimation in gene ranking analysis. CAUTION: Different ranking methods take more computation time than others, so adjust according to method. For </span>
            <span class="c19">STARS</span>
            <span class="c3">&nbsp;it is recommended to reduce the number of permutations to </span>
            <span class="c19">100</span>
            <span class="c3">.</span>
        </p>
        <p class="c13">
            <span class="c10">Percentage of sgRNAs displayed (STARS only) (default = 10): </span>
        </p>
        <p class="c7">
            <span class="c3">Percentage of sgRNAs to be included in the ranking analysis. Only relevant if &ldquo;STARS &rdquo;method is chosen.</span>
        </p>
        <p class="c14">
            <span class="c3">STATISTICAL SIGNIFICANCE</span>
        </p>
        <p class="c13">
            <span class="c10">alpha: (default = 0.1)</span>
        </p>
        <p class="c7">
            <span class="c3">Significance threshold (critical false discovery rate)</span>
        </p>
        <p class="c13">
            <span class="c10">p-value adjustment (default = &lsquo;fdr_bh &rsquo;):</span>
        </p>
        <p class="c7">
            <span class="c3">Method for p-value adjustment.</span>
        </p>
        <ul class="c4 lst-kix_list_7-0 start">
            <li>
                <span class="c19">fdr_bh: </span>
                <span class="c3">Benjamini-Hochberg method.</span>
            </li>
            <li>
                <span class="c19">fdr_tsbh:</span>
                <span class="c3">&nbsp;Two-stage Benjamini-Hochberg method.</span>
            </li>
        </ul>
        <p class="c14">
            <span class="c3">ADAPTER TRIMMING</span>
        </p>
        <p class="c13">
            <span class="c10">Minimal read length (default = 10): </span>
        </p>
        <p class="c7">
            <span>Minimal read length allowed after cutting the 5 &#39;/3 &#39;adapters around the 20bp sgRNA target sequence. Reads with length shorter than this number will be discarded. Refer to the </span>
            <span class="c37">
                <a class="c5" href="https://www.google.com/url?q=http://cutadapt.readthedocs.io/en/stable/guide.html%23the-alignment-algorithm&amp;sa=D&amp;ust=1489177904491000&amp;usg=AFQjCNGErFSxbnVXatDh4LA2ucqYZ0szig">cutadapt manual</a>
            </span>
            <span class="c3">&nbsp;for more information.</span>
        </p>
        <p class="c13">
            <span class="c10">Error tolerance (default = 0.25) &nbsp;</span>
        </p>
        <p class="c7">
            <span class="c3">Error rate allowed for the identification of the 5 &rsquo;and 3 &rsquo;adapters. Refer to the </span>
            <span class="c6">
                <a class="c5" href="https://www.google.com/url?q=http://cutadapt.readthedocs.io/en/stable/guide.html%23error-tolerance&amp;sa=D&amp;ust=1489177904492000&amp;usg=AFQjCNE1EqesJQMCljiVGJ0e5OE1bb6Daw">cutadapt manual</a>
            </span>
            <span class="c3">&nbsp;for more information.</span>
        </p>
        <p class="c14">
            <span class="c3">ALIGNMENT</span>
        </p>
        <p class="c13">
            <span class="c10">Theta (default = 2):</span>
        </p>
        <p class="c7">
            <span class="c3">Minimum required difference between primary and secondary alignment score in order to consider the read successfully mapped. Reads with lower difference between primary and secondary alignment will be considered ambiguous and discarded. Increase Theta to increase the stringency of the alignment. Decrease Theta to increase sensitivity.</span>
        </p>
        <p class="c13">
            <span class="c10">L_bw (default = 11): </span>
        </p>
        <p class="c7">
            <span class="c3">Seed length parameter for Bowtie2 alignment. Smaller values slow down alignment but increase sensitivity. Refer to the </span>
            <span class="c6">
                <a class="c5" href="https://www.google.com/url?q=http://computing.bio.cam.ac.uk/local/doc/bowtie2.html%23what-is-bowtie-2&amp;sa=D&amp;ust=1489177904495000&amp;usg=AFQjCNHQTVzxVecI9Ee-EwqusEAhyj5Xbw">Bowtie2 manual</a>
            </span>
            <span class="c3">&nbsp;for more information.</span>
        </p>
        <p class="c13">
            <span class="c10">N_bw (default = 1): &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        </p>
        <p class="c7">
            <span class="c3">Number of allowed mismatches for Bowtie2 seed alignment. Higher values slow down alignment but increase sensitivity. Refer to the </span>
            <span class="c6">
                <a class="c5" href="https://www.google.com/url?q=http://computing.bio.cam.ac.uk/local/doc/bowtie2.html%23what-is-bowtie-2&amp;sa=D&amp;ust=1489177904497000&amp;usg=AFQjCNHvtm29SjW3PZCfjuNfc2i22WCYBg">Bowtie2 manual</a>
            </span>
            <span class="c3">&nbsp;for more information.</span>
        </p>
        <p class="c13">
            <span class="c10">i_bw (default = &lsquo;S,1,0.75 &rsquo;): </span>
        </p>
        <p class="c7">
            <span class="c3">Bowtie2 seed interval function. Refer to the </span>
            <span class="c6">
                <a class="c5" href="https://www.google.com/url?q=http://computing.bio.cam.ac.uk/local/doc/bowtie2.html%23what-is-bowtie-2&amp;sa=D&amp;ust=1489177904499000&amp;usg=AFQjCNGgjdZJmRKz7CwOA_jyl7zvJe14gA">Bowtie2 manual</a>
            </span>
            <span class="c3">&nbsp;for more information.</span>
        </p>
        <p class="c14">
            <span class="c3">VISUALIZATION</span>
        </p>
        <p class="c13">
            <span class="c10">PNG resolution (default = 300):</span>
        </p>
        <p class="c7">
            <span class="c3">Resolution for PNG output (dpi).</span>
        </p>
        <p class="c13">
            <span class="c10">Dotsize (default = 10):</span>
        </p>
        <p class="c7">
            <span class="c3">Size of dots in read count and replicate scatterplots.</span>
        </p>
        <p class="c13" id="h.17dp8vu">
            <span class="c10">logbase (default = 10):</span>
        </p>
        <p class="c7">
            <span class="c3">Base of logarithm for log-transformation of read counts shown in scatterplots.</span>
        </p>
        <p class="c13">
            <span class="c10">max_q (default = 95):</span>
        </p>
        <p class="c7">
            <span class="c3">Maximum quantile to be plotted in read count distribution histograms.</span>
        </p>
        <p class="c13">
            <span class="c10">svg (default = True):</span>
        </p>
        <p class="c7" id="h.3rdcrjn">
            <span class="c3">Save plots as vector graphics (.svg) in addition to .png (excluding scatterplots).</span>
        </p>
        <p class="c9" id="h.26in1rg">
            <span class="c8">Uploading a custom library:</span>
        </p>
        <p class="c7">
            <span class="c3">Format your library file as a spreadsheet with </span>
            <span class="c19">3 columns: </span>
        </p>
        <ul class="c4 lst-kix_list_9-0 start">
            <li>
                <span class="c19">gene: </span>
                <span class="c3">This column contains an identifier of the gene that is targeted by the sgRNA</span>
            </li>
            <li>
                <span class="c19">sgRNA_ID: </span>
                <span class="c3">This column contains an identifier of the sgRNA</span>
            </li>
            <li>
                <span class="c19">sequence:</span>
                <span class="c3">&nbsp;This column contains the 20bp sequence of the sgRNA</span>
            </li>
        </ul>
        <p class="c7">
            <span class="c3">(You can choose other header names of these columns. See example below)</span>
        </p>
        <p class="c7">
            <span class="c10">Example:</span>
        </p>
        <a id="t.15837884958373136450b825b7cc29736f97015a"></a>
        <a id="t.0"></a>
        <table class="c44">
            <tbody>
                <tr class="c29">
                    <td class="c42" colspan="1" rowspan="1">
                        <p class="c7">
                            <span class="c30">gene_ID</span>
                        </p>
                    </td>
                    <td class="c11" colspan="1" rowspan="1">
                        <p class="c7">
                            <span class="c30">sgRNA_ID</span>
                        </p>
                    </td>
                    <td class="c20" colspan="1" rowspan="1">
                        <p class="c7">
                            <span class="c30">Seq</span>
                        </p>
                    </td>
                </tr>
                <tr class="c29">
                    <td class="c42" colspan="1" rowspan="1">
                        <p class="c7">
                            <span class="c30">A1BG</span>
                        </p>
                    </td>
                    <td class="c11" colspan="1" rowspan="1">
                        <p class="c7">
                            <span class="c30">CustomLib00001</span>
                        </p>
                    </td>
                    <td class="c20" colspan="1" rowspan="1">
                        <p class="c7">
                            <span class="c30">GTCGCTGAGCTCCGATTCGA</span>
                        </p>
                    </td>
                </tr>
                <tr class="c29">
                    <td class="c42" colspan="1" rowspan="1">
                        <p class="c7">
                            <span class="c30">A1BG</span>
                        </p>
                    </td>
                    <td class="c11" colspan="1" rowspan="1">
                        <p class="c7">
                            <span class="c30">CustomLib00002</span>
                        </p>
                    </td>
                    <td class="c20" colspan="1" rowspan="1">
                        <p class="c7">
                            <span class="c30">ACCTGTAGTTGCCGGCGTGC</span>
                        </p>
                    </td>
                </tr>
                <tr class="c29">
                    <td class="c42" colspan="1" rowspan="1">
                        <p class="c7">
                            <span class="c30">A1BG</span>
                        </p>
                    </td>
                    <td class="c11" colspan="1" rowspan="1">
                        <p class="c7">
                            <span class="c30">CustomLib00003</span>
                        </p>
                    </td>
                    <td class="c20" colspan="1" rowspan="1">
                        <p class="c7">
                            <span class="c30">CGTCAGCGTCACATTGGCCA</span>
                        </p>
                    </td>
                </tr>
                <tr class="c29">
                    <td class="c42" colspan="1" rowspan="1">
                        <p class="c7">
                            <span class="c30">A1CF</span>
                        </p>
                    </td>
                    <td class="c11" colspan="1" rowspan="1">
                        <p class="c7">
                            <span class="c30">CustomLib00004</span>
                        </p>
                    </td>
                    <td class="c20" colspan="1" rowspan="1">
                        <p class="c7">
                            <span class="c30">CGCGCACTGGTCCAGCGCAC</span>
                        </p>
                    </td>
                </tr>
                <tr class="c29">
                    <td class="c42" colspan="1" rowspan="1">
                        <p class="c7">
                            <span class="c30">A1CF</span>
                        </p>
                    </td>
                    <td class="c11" colspan="1" rowspan="1">
                        <p class="c7">
                            <span class="c30">CustomLib00005</span>
                        </p>
                    </td>
                    <td class="c20" colspan="1" rowspan="1">
                        <p class="c7">
                            <span class="c30">CCAAGCTATATCCTGTGCGC</span>
                        </p>
                    </td>
                </tr>
                <tr class="c29">
                    <td class="c42" colspan="1" rowspan="1">
                        <p class="c7">
                            <span class="c30">A1CF</span>
                        </p>
                    </td>
                    <td class="c11" colspan="1" rowspan="1">
                        <p class="c7">
                            <span class="c30">CustomLib00006</span>
                        </p>
                    </td>
                    <td class="c20" colspan="1" rowspan="1">
                        <p class="c7">
                            <span class="c30">AAGTTGCTTGATTGCATTCT</span>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="c7">
            <span class="c3">&hellip;.</span>
        </p>
        <p class="c7">
            <span class="c3">The spreadsheet must be saved as plain text in </span>
            <span class="c19">either tab-separated format (.tsv) or comma-separated format (.csv)</span>
            <span class="c3">. </span>
        </p>
        <p class="c7">
            <span class="c3">Use the file browser to select and upload your library file. </span>
        </p>
        <p class="c7">
            <span class="c3">Next, specify the following parameters:</span>
        </p>
        <p class="c13">
            <span class="c10">5 &rsquo;-adapter: </span>
        </p>
        <p class="c7">
            <span class="c3">This specifies the sequence that lies 5 &rsquo;of the 20bp sgRNA in the sgRNA cassette (see image below). There are no restriction to sequence length, but </span>
            <span class="c19">20-25 bp</span>
            <span class="c3">&nbsp;are recommended. This sequence will depend on the cloning strategy of your library. Use a sequence mapping program like </span>
            <span class="c6">
                <a class="c5" href="https://www.google.com/url?q=http://www.snapgene.com/products/snapgene_viewer/&amp;sa=D&amp;ust=1489177904532000&amp;usg=AFQjCNE3d0iK7XqsfFyvGA6jjqzkfX9_-w">SnapGene Viewer</a>
            </span>
            <span class="c3">&nbsp;to lay out the sequence of your sgRNA cassette as it will appear in your reads. </span>
        </p>
        <p class="c13">
            <span class="c10">3 &rsquo;-adapter: </span>
        </p>
        <p class="c7">
            <span class="c3">This specifies the sequence that lies 3 &rsquo;of the 20bp sgRNA in the sgRNA cassette (see image below). There are no restriction to sequence length, but </span>
            <span class="c19">20-25 bp</span>
            <span class="c3">&nbsp;are recommended. This sequence will depend on the cloning strategy of your library. Use a sequence mapping program like </span>
            <span class="c6">
                <a class="c5" href="https://www.google.com/url?q=http://www.snapgene.com/products/snapgene_viewer/&amp;sa=D&amp;ust=1489177904534000&amp;usg=AFQjCNFH6WwHfGmbP7KuEtPys2m0gK1aKQ">SnapGene Viewer</a>
            </span>
            <span class="c47 c48">&nbsp;</span>
            <span class="c3">to lay out the sequence of your sgRNA cassette as it will appear in your reads. </span>
        </p>
      	<div class="row" style="margin-top: 3em;">
      		<column class="shrink">
              <img alt="" src="images/image00.png" title="" style="max-width: 40em;">
      		</column>
    		</div>
    		<div class="row">
      		<column class="shrink">
      		<small>Read structure with adapters</small>
      		</column>
      	</div>
        <p class="c7 c22" id="h.lnxbz9">
            <span class="c3"></span>
        </p>
        <p class="c7 c22">
            <span class="c3"></span>
        </p>
        <p class="c7 c22">
            <span class="c3"></span>
        </p>
        <p class="c13">
            <span class="c10">Prefix for non-targeting controls:</span>
        </p>
        <p class="c7">
            <span class="c3">If your library contains non-targeting controls, enter a </span>
            <span class="c19">prefix</span>
            <span class="c3">&nbsp;that is used in the gene identifier in the library spreadsheet to define sgRNAs containing non-targeting controls. The prefix does not need to have a minimal length or a certain format, but it must be specific for non-targeting controls (In the example below it would be &ldquo;Non_Target &rdquo;). If your library does not contain non-targeting controls, just enter </span>
            <span class="c19">&ldquo;(none)&rdquo;</span>
        </p>
        <a id="t.00722540dd31d31b4016206294d288ed6f82b1bc"></a>
        <a id="t.1"></a>
        <table class="c44">
            <tbody>
                <tr class="c29">
                    <td class="c41" colspan="1" rowspan="1">
                        <p class="c7">
                            <span class="c30">gene_ID</span>
                        </p>
                    </td>
                    <td class="c16" colspan="1" rowspan="1">
                        <p class="c7">
                            <span class="c30">sgRNA_ID</span>
                        </p>
                    </td>
                    <td class="c15" colspan="1" rowspan="1">
                        <p class="c7">
                            <span class="c30">Seq</span>
                        </p>
                    </td>
                </tr>
                <tr class="c29">
                    <td class="c41" colspan="1" rowspan="1">
                        <p class="c7">
                            <span class="c30">Non_Target_0001</span>
                        </p>
                    </td>
                    <td class="c16" colspan="1" rowspan="1">
                        <p class="c7">
                            <span class="c30">CustomLib34556</span>
                        </p>
                    </td>
                    <td class="c15" colspan="1" rowspan="1">
                        <p class="c7">
                            <span class="c30">ACGGAGGCTAAGCGTCGCAA</span>
                        </p>
                    </td>
                </tr>
                <tr class="c29">
                    <td class="c41" colspan="1" rowspan="1">
                        <p class="c7">
                            <span class="c30">Non_Target_0002</span>
                        </p>
                    </td>
                    <td class="c16" colspan="1" rowspan="1">
                        <p class="c7">
                            <span class="c30">CustomLib34557</span>
                        </p>
                    </td>
                    <td class="c15" colspan="1" rowspan="1">
                        <p class="c7">
                            <span class="c30">CGCTTCCGCGGCCCGTTCAA</span>
                        </p>
                    </td>
                </tr>
                <tr class="c29">
                    <td class="c41" colspan="1" rowspan="1">
                        <p class="c7">
                            <span class="c30">Non_Target_0003</span>
                        </p>
                    </td>
                    <td class="c16" colspan="1" rowspan="1">
                        <p class="c7">
                            <span class="c30">CustomLib34558</span>
                        </p>
                    </td>
                    <td class="c15" colspan="1" rowspan="1">
                        <p class="c7">
                            <span class="c30">ATCGTTTCCGCTTAACGGCG</span>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="c7">
            <span class="c3">&hellip;.</span>
        </p>
        <p class="c13">
            <span class="c10">Number of sgRNAs per gene:</span>
        </p>
        <p class="c7">
            <span class="c3">Specifies the number of sgRNAs targeting a single gene (excluding non-targeting controls, miRNAs and other non-genes in your library). This is </span>
            <span class="c19">only relevant if you choose &ldquo;ES &rdquo;</span>
            <span class="c3">for your gene ranking method since this metric normalizes by the number of sgRNAs targeting a gene! </span>
        </p>
        <hr style="page-break-before:always;display:none;">
        <h1 class="c24" id="h.35nkun2">
            <span class="c38">Description of the PinAPL-Py Analysis output</span>
        </h1>
        <p class="c7 c22">
            <span class="c3"></span>
        </p>
        <p class="c7">
            <span>The PinAPL-Py output is structured by logical order into tabs and subtabs on the results page. In addition, all output can be downloaded via the </span>
            <span class="c40">&ldquo;Download Results Archive &rdquo;</span>
            <span class="c3">button as a single .zip file. Images are saved as high-resolution .png and, optionally, as .svg vector graphics which can be further processed in Adobe Illustrator or similar image processing software. </span>
        </p>
        <p class="c7">
            <span>NOTE for Windows users: It is recommended to use </span>
            <span class="c37 c40 c52">
                <a class="c5" href="https://www.google.com/url?q=https://notepad-plus-plus.org/download/v7.2.1.html&amp;sa=D&amp;ust=1489177904554000&amp;usg=AFQjCNGtnWy7SJTG5_WtBa-vynBvN82Ktw">Notepad++</a>
            </span>
            <span>&nbsp;to view text files (.txt/.tsv/.csv)</span>
        </p>
        <p class="c9" id="h.1ksv4uv">
            <span class="c8">Enrichment/Depletion</span>
        </p>
        <p class="c1">
            <span class="c12">Gene Rankings:</span>
        </p>
        <p class="c7">
            <span class="c3">This tab contains the results of the gene ranking analysis. Genes are ranked by the level of enrichment/depletion of the sgRNAs that target it. The columns are:</span>
        </p>
        <ul class="c4 lst-kix_list_11-0 start">
            <li>
                <span class="c19">gene:</span>
                <span class="c3">&nbsp;Name of gene (as defined in the library file)</span>
            </li>
            <li>
                <span class="c19">&lt;gene metric&gt;:</span>
                <span class="c3">&nbsp;Value of the computed gene metric score. &lt;gene metric&gt;is either aRRA, STARS or ES, as chosen in on configuration page</span>
            </li>
            <li>
                <span class="c19">&lt;gene metric&gt; p-value</span>
                <span class="c3">: Estimated p-value of the gene metric score </span>
            </li>
            <li>
                <span class="c19">&lt;gene metric&gt; FDR:</span>
                <span class="c3">&nbsp;Estimated adjusted p-value (FDR) of the gene metric value, adjusted for multiple testing</span>
            </li>
            <li>
                <span class="c19">significant:</span>
                <span class="c3">&nbsp;Statistical significance of the obtained gene metric score. Declared &ldquo;True &rdquo;if the FDR is smaller than the significance threshold alpha, defined on the configuration page </span>
            </li>
            <li>
                <span class="c19"># signif. sgRNAs:</span>
                <span class="c3">&nbsp;Number of sgRNAs (targeting the particular gene) that reached statistical significance in the sgRNA ranking</span>
            </li>
        </ul>
        <p class="c1">
            <span class="c12">sgRNA Rankings:</span>
        </p>
        <p class="c7">
            <span class="c3">This tab contains the results of the sgRNA ranking analysis. The higher a sgRNA scores in this list, the more dominant it is in the enrichment/depletion screen. The columns are:</span>
        </p>
        <ul class="c4 lst-kix_list_10-0 start">
            <li>
                <span class="c19">sgRNA:</span>
                <span class="c3">&nbsp;Identifier of sgRNA </span>
            </li>
            <li>
                <span class="c19">gene</span>
                <span class="c3">: Name of target gene </span>
            </li>
            <li>
                <span class="c19">counts [norm.]:</span>
                <span class="c3">&nbsp;(Normalized) Read count</span>
            </li>
            <li>
                <span class="c19">Control mean [norm.]: </span>
                <span class="c3">Average (normalized) read count in the control samples </span>
            </li>
            <li>
                <span class="c19">Control stdev [norm.]</span>
                <span class="c3">: Standard deviation of (normalized) read counts in the control samples</span>
            </li>
            <li>
                <span class="c19">fold change:</span>
                <span class="c3">&nbsp;The ratio of (normalized) read counts in the sample versus the control average</span>
            </li>
            <li>
                <span class="c19">p-value:</span>
                <span class="c3">&nbsp;The non-corrected p-value of the (normalized) read count indicating whether it is significantly higher/lower than the control average (enrichment/depletion screen)</span>
            </li>
            <li>
                <span class="c19">FDR:</span>
                <span class="c3">&nbsp;The adjusted p-value (false discovery rate, FDR), corrected for multiple testing</span>
            </li>
            <li>
                <span class="c19">significant:</span>
                <span class="c3">&nbsp;Statistical significance of the obtained (normalized) read count. Declared &ldquo;True &rdquo;if the FDR is smaller than the significance threshold alpha, defined on the configuration page</span>
            </li>
        </ul>
        <p class="c13">
            <span class="c10">sgRNA_Efficacy:</span>
        </p>
        <p class="c7">
            <span class="c3">This plot shows information about the efficacy of different sgRNAs targeting the same gene. Genes are categorized by the number of targeting sgRNAs reaching statistical significance. Genes having no significant sgRNAs are omitted. </span>
        </p>
        <p class="c1">
            <span class="c12">p-values:</span>
        </p>
        <p class="c7">
            <span class="c3">This tab contains various plots visualizing the fraction of sgRNAs and genes that reached statistical significance in the ranking.</span>
        </p>
        <ul class="c4 lst-kix_list_2-0 start">
            <li>
                <span class="c18">Gene Significance:</span>
                <span class="c0">&nbsp;The plot shows the distribution of p-values obtained in the gene ranking analysis with the specified metric, both before and after adjustment for multiple tests. In order for low p-values to be credible, this distribution should be noticeably different from a uniform distribution.</span>
            </li>
            <li>
                <span class="c18">sgRNA Significance:</span>
                <span class="c0">&nbsp;The plot shows the distribution of p-values obtained in the sgRNA ranking analysis, both before and after adjustment for multiple tests. In order for low p-values to be credible, this distribution should be noticeably different from a uniform distribution. </span>
            </li>
            <li>
                <span class="c18">sgRNA QQ:</span>
                <span class="c0">&nbsp;The plot visualizes the degree by which the p-values obtained from the sgRNA ranking analysis differ from a uniform distribution (=&ldquo;expected p-values &rdquo;). In order for low p-values to be credible, they should show be noticeable distance from the dotted line. p-values are capped at 1e-16 for technical purposes.</span>
            </li>
            <li>
                <span class="c18">sgRNA Volcano:</span>
                <span class="c0">&nbsp;The plot visualizes the fraction of sgRNAs whose fold change in enrichment/depletion compared to the control yielded statistical significance. p-values are capped at 1e-16 for technical purposes. </span>
            </li>
            <li>
                <span class="c18">sgRNA z-Scores:</span>
                <span class="c0">&nbsp;The plot visualizes the fraction of sgRNAs whose z-Score (=normalized deviation from the mean read count) yielded statistical significance.</span>
            </li>
        </ul>
        <p class="c9" id="h.44sinio">
            <span class="c8">Statistics</span>
        </p>
        <p class="c1">
            <span class="c12">Read Count Statistics:</span>
        </p>
        <p class="c7">
            <span class="c3">This tab contains information about the statistical distribution of sgRNA read counts. </span>
        </p>
        <ul class="c4 lst-kix_list_2-0">
            <li>
                <span class="c18">ReadCounts_LorenzCurve:</span>
                <span class="c0">&nbsp;Lorenz curves and Gini coefficients for read counts per sgRNA and gene, respectively. The Lorenz curve shows what fraction of sgRNAs/genes is represented by what fraction of reads, and thus serves as an indicator of the strength of selection in a sample. A perfectly even distribution of reads counts (no selection) results in a diagonal curve (Gini coefficient = 0). &nbsp;An extreme uneven distribution (strong selection) results in a flat curve (Gini coefficient = 1).</span>
            </li>
            <li>
                <span class="c18">ReadCounts_Distribution</span>
                <span class="c0">: Boxplots and histograms for the read counts per sgRNA or gene, respectively. Outliers are omitted for visualization purposes.</span>
            </li>
            <li>
                <span class="c18">ReadCount_Statistics:</span>
                <span class="c35 c25">&nbsp;</span>
                <span class="c0">Text file summarizing statistical properties of the read count distribution of sgRNAs and genes. </span>
                <span class="c35 c25">sgRNA/Gene Representation </span>
                <span class="c0">measures the number of different sgRNAs/genes detected in the sample (as percentage of the full library). </span>
                <span class="c35 c25">Gini coefficient</span>
                <span class="c0">&nbsp;is a measure of the disparity of read counts throughout the sample (0 = perfect uniformity. All sgRNAs having the same read counts; 1 = perfect disparity. One sgRNA having all the read counts, the remainder having zero).</span>
            </li>
        </ul>
        <p class="c1">
            <span class="c12">Read Count Dispersion:</span>
        </p>
        <p class="c7">
            <span class="c3">This tab contains information about the statistical distribution of read counts as inferred from the control samples.</span>
        </p>
        <ul class="c4 lst-kix_list_2-0">
            <li>
                <span class="c18">Control_MeanVariance:</span>
                <span class="c0">&nbsp;The left images represents the variance in read counts as a function of the mean read counts in the control samples. It indicates the degree of overdispersion in the dataset (by how much the variance exceeds the mean). The right image shows the computed regression line, which is used to estimate the dispersion, i.e. the relationship between read count variance and mean read count.</span>
            </li>
        </ul>
        <p class="c1">
            <span class="c12">Alignment:</span>
        </p>
        <p class="c7">
            <span class="c3">This tab contains statistical information about the alignment process. </span>
        </p>
        <ul class="c4 lst-kix_list_2-0">
            <li>
                <span class="c18">MappingQuality.png:</span>
                <span class="c0">&nbsp;Histogram of the overall quality by which the reads map to the library. Reads that uniquely align to a single library sequence yield a high mapping quality score. Reads that ambiguously align to multiple library sequences or that do not align to any library sequence yield a low mapping quality score. For more detailed information about mapping quality, refer to the </span>
                <span class="c6">
                    <a class="c5" href="https://www.google.com/url?q=http://computing.bio.cam.ac.uk/local/doc/bowtie2.html%23mapping-quality-higher-more-unique&amp;sa=D&amp;ust=1489177904584000&amp;usg=AFQjCNG8RCxLEwBhEiMDqhQZQjzZQi3uag">Bowtie2 manual</a>
                </span>
                <span class="c0">.</span>
            </li>
            <li>
                <span class="c18">AlignmentScores.png:</span>
                <span class="c0">&nbsp;Barplot showing the primary (best) and secondary (second-best) alignment scores achieved for each read. If a read uniquely aligns to only one library sequence, its primary alignment score will be high, and its secondary alignment score will be 0. If a read aligns ambiguously to multiple library sequences, its secondary alignment score will be close to its primary alignment score. If a read does not align to any library sequence, both its primary and secondary alignment scores will be 0. The fraction marked in red is discarded from the analysis. For more detailed information about alignment scores, refer to the </span>
                <span class="c6">
                    <a class="c5" href="https://www.google.com/url?q=http://computing.bio.cam.ac.uk/local/doc/bowtie2.html%23mapping-quality-higher-more-unique&amp;sa=D&amp;ust=1489177904585000&amp;usg=AFQjCNFxui5-_eRmWKLWBupr3EMwv9HN-Q">Bowtie2 manual</a>
                </span>
                <span class="c0">. </span>
            </li>
            <li>
                <span class="c18">AlignmentResults:</span>
                <span class="c0">
                    &nbsp;This text file provides information about the success of the alignment, i.e. about the number of reads in each of the following fractions:<br>
                    <br>
                </span>
                <span class="c35 c25">Unique Alignments:</span>
                <span class="c0">
                    &nbsp;The read aligns to only one library sequence.<br>
                    <br>
                </span>
                <span class="c25 c35">Alignments above ambiguity tolerance:</span>
                <span class="c0">
                    &nbsp;The read aligns to more than one library sequence, but the discrepancy in alignment quality is high enough to discard the second-best match.<br>
                    <br>
                </span>
                <span class="c35 c25">Alignments below ambiguity tolerance:</span>
                <span class="c0">
                    &nbsp;The read aligns to more than one library sequence, but the discrepancy in alignment quality is not high enough to discern between the best and the second-best match.<br>
                    <br>
                </span>
                <span class="c35 c25">Failed Alignments:</span>
                <span class="c0">
                    &nbsp;The read does not align to any library sequence.<br>
                    <br>Alignments below ambiguity tolerance and failed alignments are discarded before the remaining data analysis. For an explanation of the parameter settings reported at the end of the file, see the section on parameter description. 
                </span>
            </li>
        </ul>
        <p class="c1">
            <span class="c12">Read Trimming:</span>
        </p>
        <p class="c7">
            <span class="c46">This tab shows the log of the adapter trimming process, giving</span>
            <span>&nbsp;statistics about the distribution of adapter sequence lengths and more. The output is explained in detail in the </span>
            <span class="c37">
                <a class="c5" href="https://www.google.com/url?q=http://cutadapt.readthedocs.io/en/stable/guide.html%23cutadapt-s-output&amp;sa=D&amp;ust=1489177904589000&amp;usg=AFQjCNGmSztyHg8BoMvTbnKQVGLIuA1quA">cutadapt manual</a>
            </span>
            <span class="c3">.</span>
        </p>
        <p class="c1">
            <span class="c12">Sequence Quality:</span>
        </p>
        <p class="c7">
            <span class="c3">This tab contains graphs for sequence quality control (produced by fastqc).</span>
        </p>
        <ul class="c4 lst-kix_list_2-0">
            <li  id="h.2jxsxqh">
                <span class="c18">per_sequence_gc_content</span>
                <span class="c0">: This plot shows the mean GC content per read. </span>
            </li>
            <li>
                <span class="c18">per_base_sequence_content</span>
                <span class="c0">: This plot shows the fractions of T, C, A and G for every base position in the read. </span>
            </li>
            <li>
                <span class="c18">per_sequence_quality</span>
                <span class="c0">: This plot shows a sequence quality histogram. Preferably, sequence quality should peak at a score&gt;= 35.</span>
            </li>
            <li>
                <span class="c18">per_base_quality</span>
                <span class="c0">: This plot shows the quality distribution for every base position in the read.</span>
            </li>
        </ul>
        <p class="c13">
            <span class="c10">Sequencing Depth:</span>
        </p>
        <p class="c7">
            <span class="c3">This tab shows the sequencing depth per sample. Results from the alignment analysis are superimposed on each bar.</span>
        </p>
        <p class="c9" id="h.z337ya">
            <span class="c8">Scatter Plots</span>
        </p>
        <p class="c1">
            <span class="c12">Treatment vs Control:</span>
        </p>
        <p class="c7">
            <span class="c3">Scatterplots of (normalized) sgRNA counts in the sample versus the average (normalized) count in the controls. The fraction reaching significant enrichment/depletion compared to the control is marked in green. Non-coding sgRNAs (if present in the library) are marked in orange.</span>
        </p>
        <p class="c1">
            <span class="c12">Replicate Correlation:</span>
        </p>
        <p class="c7">
            <span class="c3">Scatterplots showing the (normalized) sgRNA counts in one replicate of each treatment versus another. Pearson and Spearman correlation coefficients are reported. Non-coding sgRNAs (if present in the library) are marked in orange.</span>
        </p>
        <p class="c9" id="h.3j2qqm3">
            <span class="c8">Heatmap</span>
        </p>
        <p class="c7" style="padding-top: 18pt">
            <span class="c3">Clustering of all samples in the dataset, based on to the most variable or most abundant/depleted sgRNAs (as set up on the configuration page). Log-transformed (normalized) read counts are color-coded from yellow (lowest) to red (highest). </span>
        </p>
        <p class="c9" id="h.1y810tw">
            <span class="c8">Run Info</span>
        </p>
        <p class="c1">
            <span class="c12">Output Log:</span>
        </p>
        <p class="c7">
            <span class="c3">This tab shows a the program execution log.</span>
        </p><p class="c1">
            <span class="c12">Configuration</span>
        </p>
        <p class="c7">
            <span class="c3">This tab shows the parameters used for the run</span>
        </p><p class="c1">
            <span class="c12">Sample Names</span>
        </p>
        <p class="c7">
            <span class="c3">This tab shows which filenames correspond to which sample names</span>
        </p>
        <p class="c7 c22">
            <span class="c3"></span>
        </p>
        <p class="c7 c22">
            <span class="c3"></span>
        </p>
        <p class="c7 c22">
            <span class="c3"></span>
        </p>

        <h1 class="c24" id="refrences-section">
            <span class="c38">REFERENCES:</span>
        </h1>
        <p class="c7 c22">
            <span class="c3"></span>
        </p>
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
        <p class="c7 c26">
            <span>Subramanian,A. </span>
            <span class="c25">et al.</span>
            <span>&nbsp;(2005) Gene set enrichment analysis: a knowledge-based approach for interpreting genome-wide expression profiles. </span>
            <span class="c25">PNAS</span>
            <span>, </span>
            <span class="c40">102</span>
            <span class="c3">, 15545 &ndash;50.</span>
        </p>
@stop
@section('customCSS')
	<style type="text/css">
	            @import url('https://themes.googleusercontent.com/fonts/css?kit=fpjTOVmNbO4Lz34iLyptLTi9jKYd1gJzj5O2gWsEpXoyck2WCYPEMNySjZN0CHedca1e3wzjYK5A0tl3JJ4t5mDWJzaElwWlMs_TjJCn9-E');
	            ul.lst-kix_list_9-3 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_9-4 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_9-1 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_9-2 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_9-7 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_9-8 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_9-5 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_9-6 {
	                list-style-type: none
	            }

	            ol.lst-kix_list_1-5.start {
	                counter-reset: lst-ctn-kix_list_1-5 0
	            }

	            ul.lst-kix_list_9-0 {
	                list-style-type: none
	            }

	            .lst-kix_list_1-2>li {
	                counter-increment: lst-ctn-kix_list_1-2
	            }

	            .lst-kix_list_5-0>li:before {
	                content: "\0025cf  "
	            }

	            .lst-kix_list_1-4>li {
	                counter-increment: lst-ctn-kix_list_1-4
	            }

	            ol.lst-kix_list_1-6.start {
	                counter-reset: lst-ctn-kix_list_1-6 0
	            }

	            .lst-kix_list_5-3>li:before {
	                content: "\0025cf  "
	            }

	            .lst-kix_list_5-2>li:before {
	                content: "\0025aa  "
	            }

	            .lst-kix_list_5-1>li:before {
	                content: "o  "
	            }

	            .lst-kix_list_5-7>li:before {
	                content: "o  "
	            }

	            ul.lst-kix_list_8-4 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_8-5 {
	                list-style-type: none
	            }

	            .lst-kix_list_5-6>li:before {
	                content: "\0025cf  "
	            }

	            .lst-kix_list_5-8>li:before {
	                content: "\0025aa  "
	            }

	            ul.lst-kix_list_8-2 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_8-3 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_8-8 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_8-6 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_8-7 {
	                list-style-type: none
	            }

	            .lst-kix_list_5-4>li:before {
	                content: "o  "
	            }

	            .lst-kix_list_5-5>li:before {
	                content: "\0025aa  "
	            }

	            ul.lst-kix_list_8-0 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_8-1 {
	                list-style-type: none
	            }

	            ol.lst-kix_list_1-0.start {
	                counter-reset: lst-ctn-kix_list_1-0 0
	            }

	            .lst-kix_list_6-1>li:before {
	                content: "o  "
	            }

	            .lst-kix_list_6-3>li:before {
	                content: "\0025cf  "
	            }

	            .lst-kix_list_6-0>li:before {
	                content: "\0025cf  "
	            }

	            .lst-kix_list_6-4>li:before {
	                content: "o  "
	            }

	            .lst-kix_list_6-2>li:before {
	                content: "\0025aa  "
	            }

	            .lst-kix_list_6-8>li:before {
	                content: "\0025aa  "
	            }

	            .lst-kix_list_6-5>li:before {
	                content: "\0025aa  "
	            }

	            .lst-kix_list_6-7>li:before {
	                content: "o  "
	            }

	            .lst-kix_list_6-6>li:before {
	                content: "\0025cf  "
	            }

	            ol.lst-kix_list_1-3 {
	                list-style-type: none
	            }

	            ol.lst-kix_list_1-4 {
	                list-style-type: none
	            }

	            .lst-kix_list_2-7>li:before {
	                content: "o  "
	            }

	            ol.lst-kix_list_1-5 {
	                list-style-type: none
	            }

	            .lst-kix_list_7-4>li:before {
	                content: "o  "
	            }

	            .lst-kix_list_7-6>li:before {
	                content: "\0025cf  "
	            }

	            ol.lst-kix_list_1-6 {
	                list-style-type: none
	            }

	            ol.lst-kix_list_1-0 {
	                list-style-type: none
	            }

	            .lst-kix_list_2-5>li:before {
	                content: "\0025aa  "
	            }

	            ol.lst-kix_list_1-1 {
	                list-style-type: none
	            }

	            ol.lst-kix_list_1-2 {
	                list-style-type: none
	            }

	            .lst-kix_list_7-2>li:before {
	                content: "\0025aa  "
	            }

	            ul.lst-kix_list_3-7 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_3-8 {
	                list-style-type: none
	            }

	            .lst-kix_list_10-1>li:before {
	                content: "o  "
	            }

	            ul.lst-kix_list_3-1 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_3-2 {
	                list-style-type: none
	            }

	            .lst-kix_list_7-8>li:before {
	                content: "\0025aa  "
	            }

	            ul.lst-kix_list_3-0 {
	                list-style-type: none
	            }

	            ol.lst-kix_list_1-7 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_3-5 {
	                list-style-type: none
	            }

	            ol.lst-kix_list_1-8 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_3-6 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_3-3 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_3-4 {
	                list-style-type: none
	            }

	            .lst-kix_list_10-7>li:before {
	                content: "o  "
	            }

	            .lst-kix_list_10-5>li:before {
	                content: "\0025aa  "
	            }

	            .lst-kix_list_10-3>li:before {
	                content: "\0025cf  "
	            }

	            ul.lst-kix_list_11-7 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_11-6 {
	                list-style-type: none
	            }

	            .lst-kix_list_4-1>li:before {
	                content: "o  "
	            }

	            ul.lst-kix_list_11-5 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_11-4 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_11-3 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_11-2 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_11-1 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_11-0 {
	                list-style-type: none
	            }

	            .lst-kix_list_9-2>li:before {
	                content: "\0025aa  "
	            }

	            .lst-kix_list_4-3>li:before {
	                content: "\0025cf  "
	            }

	            .lst-kix_list_4-5>li:before {
	                content: "\0025aa  "
	            }

	            .lst-kix_list_1-8>li {
	                counter-increment: lst-ctn-kix_list_1-8
	            }

	            ul.lst-kix_list_11-8 {
	                list-style-type: none
	            }

	            ol.lst-kix_list_1-4.start {
	                counter-reset: lst-ctn-kix_list_1-4 0
	            }

	            ol.lst-kix_list_1-1.start {
	                counter-reset: lst-ctn-kix_list_1-1 0
	            }

	            .lst-kix_list_9-0>li:before {
	                content: "\0025cf  "
	            }

	            .lst-kix_list_9-6>li:before {
	                content: "\0025cf  "
	            }

	            .lst-kix_list_9-4>li:before {
	                content: "o  "
	            }

	            .lst-kix_list_11-3>li:before {
	                content: "\0025cf  "
	            }

	            ol.lst-kix_list_1-3.start {
	                counter-reset: lst-ctn-kix_list_1-3 0
	            }

	            ul.lst-kix_list_2-8 {
	                list-style-type: none
	            }

	            ol.lst-kix_list_1-2.start {
	                counter-reset: lst-ctn-kix_list_1-2 0
	            }

	            .lst-kix_list_11-5>li:before {
	                content: "\0025aa  "
	            }

	            ul.lst-kix_list_2-2 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_2-3 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_2-0 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_2-1 {
	                list-style-type: none
	            }

	            .lst-kix_list_9-8>li:before {
	                content: "\0025aa  "
	            }

	            ul.lst-kix_list_2-6 {
	                list-style-type: none
	            }

	            .lst-kix_list_1-1>li:before {
	                content: "" counter(lst-ctn-kix_list_1-1,lower-latin) ". "
	            }

	            ul.lst-kix_list_2-7 {
	                list-style-type: none
	            }

	            .lst-kix_list_11-7>li:before {
	                content: "o  "
	            }

	            ul.lst-kix_list_2-4 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_2-5 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_10-0 {
	                list-style-type: none
	            }

	            .lst-kix_list_1-3>li:before {
	                content: "" counter(lst-ctn-kix_list_1-3,decimal) ". "
	            }

	            ul.lst-kix_list_10-8 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_10-7 {
	                list-style-type: none
	            }

	            .lst-kix_list_1-7>li:before {
	                content: "" counter(lst-ctn-kix_list_1-7,lower-latin) ". "
	            }

	            ul.lst-kix_list_10-6 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_10-5 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_10-4 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_10-3 {
	                list-style-type: none
	            }

	            .lst-kix_list_1-3>li {
	                counter-increment: lst-ctn-kix_list_1-3
	            }

	            .lst-kix_list_1-5>li:before {
	                content: "" counter(lst-ctn-kix_list_1-5,lower-roman) ". "
	            }

	            ul.lst-kix_list_10-2 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_10-1 {
	                list-style-type: none
	            }

	            .lst-kix_list_2-1>li:before {
	                content: "o  "
	            }

	            .lst-kix_list_2-3>li:before {
	                content: "\0025cf  "
	            }

	            .lst-kix_list_1-1>li {
	                counter-increment: lst-ctn-kix_list_1-1
	            }

	            .lst-kix_list_3-0>li:before {
	                content: "\0025cf  "
	            }

	            ul.lst-kix_list_5-7 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_5-8 {
	                list-style-type: none
	            }

	            .lst-kix_list_3-1>li:before {
	                content: "o  "
	            }

	            .lst-kix_list_3-2>li:before {
	                content: "\0025aa  "
	            }

	            ul.lst-kix_list_5-5 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_5-6 {
	                list-style-type: none
	            }

	            .lst-kix_list_8-1>li:before {
	                content: "o  "
	            }

	            ol.lst-kix_list_1-8.start {
	                counter-reset: lst-ctn-kix_list_1-8 0
	            }

	            .lst-kix_list_8-2>li:before {
	                content: "\0025aa  "
	            }

	            .lst-kix_list_3-5>li:before {
	                content: "\0025aa  "
	            }

	            ul.lst-kix_list_5-0 {
	                list-style-type: none
	            }

	            .lst-kix_list_3-4>li:before {
	                content: "o  "
	            }

	            ul.lst-kix_list_5-3 {
	                list-style-type: none
	            }

	            .lst-kix_list_3-3>li:before {
	                content: "\0025cf  "
	            }

	            ul.lst-kix_list_5-4 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_5-1 {
	                list-style-type: none
	            }

	            .lst-kix_list_8-0>li:before {
	                content: "\0025cf  "
	            }

	            ul.lst-kix_list_5-2 {
	                list-style-type: none
	            }

	            .lst-kix_list_8-7>li:before {
	                content: "o  "
	            }

	            .lst-kix_list_3-8>li:before {
	                content: "\0025aa  "
	            }

	            .lst-kix_list_8-5>li:before {
	                content: "\0025aa  "
	            }

	            .lst-kix_list_8-6>li:before {
	                content: "\0025cf  "
	            }

	            .lst-kix_list_8-3>li:before {
	                content: "\0025cf  "
	            }

	            .lst-kix_list_3-6>li:before {
	                content: "\0025cf  "
	            }

	            .lst-kix_list_3-7>li:before {
	                content: "o  "
	            }

	            .lst-kix_list_8-4>li:before {
	                content: "o  "
	            }

	            .lst-kix_list_11-2>li:before {
	                content: "\0025aa  "
	            }

	            .lst-kix_list_11-1>li:before {
	                content: "o  "
	            }

	            .lst-kix_list_11-0>li:before {
	                content: "\0025cf  "
	            }

	            .lst-kix_list_8-8>li:before {
	                content: "\0025aa  "
	            }

	            .lst-kix_list_4-8>li:before {
	                content: "\0025aa  "
	            }

	            .lst-kix_list_4-7>li:before {
	                content: "o  "
	            }

	            ul.lst-kix_list_4-8 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_4-6 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_4-7 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_4-0 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_4-1 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_4-4 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_4-5 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_4-2 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_4-3 {
	                list-style-type: none
	            }

	            .lst-kix_list_7-0>li:before {
	                content: "\0025cf  "
	            }

	            .lst-kix_list_2-6>li:before {
	                content: "\0025cf  "
	            }

	            .lst-kix_list_2-4>li:before {
	                content: "o  "
	            }

	            .lst-kix_list_2-8>li:before {
	                content: "\0025aa  "
	            }

	            .lst-kix_list_7-1>li:before {
	                content: "o  "
	            }

	            .lst-kix_list_7-5>li:before {
	                content: "\0025aa  "
	            }

	            .lst-kix_list_7-3>li:before {
	                content: "\0025cf  "
	            }

	            ul.lst-kix_list_7-5 {
	                list-style-type: none
	            }

	            .lst-kix_list_10-0>li:before {
	                content: "\0025cf  "
	            }

	            ul.lst-kix_list_7-6 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_7-3 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_7-4 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_7-7 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_7-8 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_7-1 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_7-2 {
	                list-style-type: none
	            }

	            .lst-kix_list_1-7>li {
	                counter-increment: lst-ctn-kix_list_1-7
	            }

	            ul.lst-kix_list_7-0 {
	                list-style-type: none
	            }

	            .lst-kix_list_7-7>li:before {
	                content: "o  "
	            }

	            .lst-kix_list_10-4>li:before {
	                content: "o  "
	            }

	            .lst-kix_list_10-8>li:before {
	                content: "\0025aa  "
	            }

	            .lst-kix_list_4-0>li:before {
	                content: "\0025cf  "
	            }

	            .lst-kix_list_10-2>li:before {
	                content: "\0025aa  "
	            }

	            ol.lst-kix_list_1-7.start {
	                counter-reset: lst-ctn-kix_list_1-7 0
	            }

	            .lst-kix_list_4-4>li:before {
	                content: "o  "
	            }

	            .lst-kix_list_1-5>li {
	                counter-increment: lst-ctn-kix_list_1-5
	            }

	            .lst-kix_list_4-2>li:before {
	                content: "\0025aa  "
	            }

	            .lst-kix_list_4-6>li:before {
	                content: "\0025cf  "
	            }

	            .lst-kix_list_9-3>li:before {
	                content: "\0025cf  "
	            }

	            .lst-kix_list_10-6>li:before {
	                content: "\0025cf  "
	            }

	            .lst-kix_list_9-1>li:before {
	                content: "o  "
	            }

	            .lst-kix_list_9-7>li:before {
	                content: "o  "
	            }

	            .lst-kix_list_11-4>li:before {
	                content: "o  "
	            }

	            .lst-kix_list_9-5>li:before {
	                content: "\0025aa  "
	            }

	            ul.lst-kix_list_6-6 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_6-7 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_6-4 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_6-5 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_6-8 {
	                list-style-type: none
	            }

	            .lst-kix_list_11-6>li:before {
	                content: "\0025cf  "
	            }

	            .lst-kix_list_1-0>li:before {
	                content: "5." counter(lst-ctn-kix_list_1-0,decimal) ".  "
	            }

	            ul.lst-kix_list_6-2 {
	                list-style-type: none
	            }

	            .lst-kix_list_11-8>li:before {
	                content: "\0025aa  "
	            }

	            ul.lst-kix_list_6-3 {
	                list-style-type: none
	            }

	            .lst-kix_list_1-2>li:before {
	                content: "" counter(lst-ctn-kix_list_1-2,lower-roman) ". "
	            }

	            ul.lst-kix_list_6-0 {
	                list-style-type: none
	            }

	            ul.lst-kix_list_6-1 {
	                list-style-type: none
	            }

	            .lst-kix_list_1-4>li:before {
	                content: "" counter(lst-ctn-kix_list_1-4,lower-latin) ". "
	            }

	            .lst-kix_list_1-0>li {
	                counter-increment: lst-ctn-kix_list_1-0
	            }

	            .lst-kix_list_1-6>li {
	                counter-increment: lst-ctn-kix_list_1-6
	            }

	            .lst-kix_list_1-6>li:before {
	                content: "" counter(lst-ctn-kix_list_1-6,decimal) ". "
	            }

	            .lst-kix_list_2-0>li:before {
	                content: "\0025cf  "
	            }

	            .lst-kix_list_1-8>li:before {
	                content: "" counter(lst-ctn-kix_list_1-8,lower-roman) ". "
	            }

	            .lst-kix_list_2-2>li:before {
	                content: "\0025aa  "
	            }

	            #content ol {
	                margin: 0;
	                padding: 0
	            }

	            #content table td,table th {
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
	                font-style: normal
	            }

	            .c3 {
	                color: #000000;
	                font-weight: 400;
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

	            .c4 {
	                padding: 0;
	                margin: 0
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

	            #content li {
	                color: #000000;
	                font-size: 11pt;
							    line-height: 1;
							    text-indent: -1em;
							    padding-left: 3em;
							    margin-bottom: .5em;
	            }

	            #content p {
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
	                font-size: 14pt;
	                line-height: 1.0;
	                page-break-after: avoid;
	                text-align: justify
	            }

	            #content h3 {
	                padding-top: 10pt;
	                color: #4f81bd;
	                font-weight: 700;
	                font-size: 11pt;
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