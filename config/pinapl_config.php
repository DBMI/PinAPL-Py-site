<?php

return [
	"parameter_groups" =>[
		"Required" => [	
			"ScreenType" => [
				"display_name"=>"Screen Type",
				"default"=>"enrichment",
				"placeholder"=>"Please select",
				"help_text"=>"Specifies the type of screen.",
				"in_quotes"=>true,
				"rules" => "string|required|in:enrichment,depletion",
				"type"=> "select",
				"options" => ["enrichment"=>"Enrichment", "depletion"=>"Depletion"]
			],
			"LibFilename" => [ 
				"display_name"=>"Library",
				"default"=> "GeCKOv2_library.tsv",
				"placeholder"=> "Please select",
				"help_text"=>"filename of library spreadsheet",
				"in_quotes"=>true,
				"rules" => "",
				"type"=>"select"
			]
		],
		"Library Parameters" => [	
			"seq_5_end" => [
				"display_name"=>"5'-adapter",
				"default"=>"TCTTGTGGAAAGGACGAAACACCG",
				"help_text"=>"sequence 5' of sgRNA in read",
				"in_quotes"=>true,
				"hidden" =>true,
				"rules" => "string|min:20|regex:/[TCGA]+/"
			],
			"NonTargetPrefix" => [
				"display_name"=>"Prefix for non-targeting controls",
				"default"=>"NonTargeting",
				"help_text"=>"prefix for non-targeting sgRNAs in library (keep at default if none present)",
				"in_quotes"=>true,
				"hidden" =>true,
				"rules" => "string"
			],
			"NumGuidesPerGene" => [
				"display_name"=>"Number of sgRNAs per gene",
				"default"=>"6",
				"help_text"=>"number of sgRNAs targeting each gene (excluding non-targeting controls and miRNAs). ONLY IMPORTANT IF 'ES' is chosen for gene ranking method !",
				"in_quotes"=>false,
				"hidden" =>true,
				"rules" => "numeric|min:1",
				"type"=>'number'
			]
		],
		"Alignment" => [
			"sgRNALength" => [
				"display_name"=>"sgRNA Length (bp)",
				"default"=>"20",
				"help_text"=>"Length of sgRNA sequence (bp)",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "numeric|min:0",
				"type"=>'number'
			],
			"CutErrorTol" => [
				"display_name"=>"Adapter Error Rate",
				"default"=>"0.1",
				"help_text"=>"Allowed error rate for Identification of the 5’ adapters. Refer to the cutadapt manual for more information.",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "numeric|min:0|max:1",
				"type"=>'float'
			],
			"AS_min" => [
				"display_name"=>"Matching Threshold",
				"default"=>"40",
				"help_text"=>"Minimal alignment score required for accepting read. For perfect match: 2*sgRNA Length",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "numeric|min:0",
				"type"=>'number'
			],
			"Theta" => [
				"default"=>"2",
				'display_name'=>'Ambiguity Threshold',
				"help_text"=>"Minimum required difference between best and second best match for accepting read (0 = allow ambiguous reads)",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "numeric|min:0",
				"type"=>'number'
			],
			"L_bw" => [
				'display_name'=>'Seed Length',
				"default"=>"11",
				"help_text"=>"Bowtie2 seed length parameter. Refer to the Bowtie2 manual for more information.",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "numeric|min:0",
				"type"=>'number'
			],
			"N_bw" => [
				'display_name'=>'Seed Number',
				"default"=>"1",
				"help_text"=>"Bowtie2 seed number parameter. Refer to the Bowtie2 manual for more information.",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "numeric|in:0,1,2",
				"type"=>'select',
				"options" => ["0"=>"0", "1"=>"1", "2"=>"2"]
			],
			"i_bw" => [
				'display_name'=>'Interval Function',
				"default"=>"S,1,0.75",
				"help_text"=>"Bowtie2 seed interval parameter. Refer to the Bowtie2 manual for more information.",
				"in_quotes"=>true,
				"hidden" =>false,
				"rules" => "string"
			],
			"AlnOutput" => [
				"display_name"=>"Alignment Output",
				"default"=>"Delete",
				"help_text"=>"Keep raw alignment output?",
				"in_quotes"=>true,
				"hidden" =>true,
				"rules" => "string|in:Keep,Compress,Delete",
				"type" =>"select",
				"options" => ["Keep"=>"Keep", "Compress"=>"Compress", "Delete"=>"Delete"]
			],
			"keepCutReads" => [
				"display_name"=>"Keep Trimmed Reads",
				"default"=>"False",
				"help_text"=>"Keep files containing trimmed reads?",
				"in_quotes"=>false,
				"hidden" =>true,
				"rules" => "string|in:True,False",
				'placeholder'=>'No',
				"type" =>"select",
				'placeholder'=>'No',
				"options" => ["True"=>"Yes", "False"=>"No"]
			],
			"delta" => [
				"default"=>"1",
				"help_text"=>"Shift in read counts to avoid errors with zero counts during log transformation, fold change calculation etc.",
				"in_quotes"=>false,
				"hidden" =>true,
				"rules" => "numeric|min:0",
				"type"=>'number'
			],
			"R_min" => [
				"display_name"=>"Minimal Read Length",
				"default"=>"20",
				"help_text"=>"Minimal allowed read length after cutting the 5' adapter. Reads with length shorter than R_min after cutting the adaptor will be discarded. Refer to the cutadapt manual for more information.",
				"in_quotes"=>false,
				"hidden" =>true,
				"rules" => "numeric|min:0",
				"type"=>'number'
			],
		],
		"Read Counting" => [
			"Normalization" => [
				"default"=>"cpm",
				"help_text"=>"Method of read count normalization. cpm = counts per million reads.",
				"in_quotes"=>true,
				"hidden" =>false,
				"rules" => "string|in:cpm,size,total",
				"type" =>"select",
				"options" => ["cpm"=>"cpm","size"=>"size","total"=>"total"]
			],
			"Cutoff" => [
				"default"=>"0",
				"help_text"=>"Read counts lower than this number are set to 0",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "numeric|min:0",
				"type"=>'number'
			],
			"RoundCount" => [
				"display_name"=>"Round Counts",
				"default"=>"False",
				"help_text"=>"Round counts to avoid fractions?",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "string|in:True,False",
				"type" =>"select",
				'placeholder'=>'No',
				"options" => ["True"=>"Yes", "False"=>"No"]
			],
			"repl_avg" => [
				"display_name"=>"Averaging",
				"default"=>"median",
				"help_text"=>"Method of read count averaging",
				"in_quotes"=>true,
				"hidden" =>false,
				"rules" => "string|in:median,mean",
				"type" =>"select",
				"options" => ["Median"=>"median","Mean"=>"mean"]
			],
		],
		"Gene Ranking" => [
			"GeneMetric" => [
				"display_name"=>"Gene Ranking Metric",
				"default"=>"aRRA",
				"help_text"=>"Metric for gene ranking analysis.",
				"in_quotes"=>true,
				"hidden" =>false,
				"rules" => "string|in:aRRA,STARS,AVGLFC",
				"type" =>"select",
				"options" => ["aRRA"=>"aRRA","STARS"=>"STARS", "AVGLFC"=>"AVGLFC"]
			],
			"Np" => [
				"display_name"=>"Number of permutations",
				"default"=>"1000",
				"help_text"=>"Number of permutations to run to estimate p-values in gene ranking analysis (recommended 1000 for aRRA, 10 for STARS.)",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "numeric|min:0",
				"type"=>'number'
			],
			"P_0" => [
				"display_name"=>"sgRNA p-value Threshold (aRRA only)",
				"default"=>"0.01",
				"help_text"=>"Maximum allowed p-value for sgRNA to be taken into account for aRRA score",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "numeric|min:0|max:1",
				"type"=>'float'
			],
			"thr_STARS" => [
				"display_name"=>"% sgRNAs Included (STARS only)",
				"default"=>"10",
				"help_text"=>"Percentage of sgRNAs included in ranking analysis (STARS only)",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "numeric|min:0",
				"type"=>'number'
			],
		],
		"Statistical Significance" => [
			"alpha_s" => [
				"default"=>"0.01",
				"display_name"=>"Signif. level (sgRNA Ranking)",
				"help_text"=>"Significance level for enrichment/depletion analysis of sgRNAs",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "numeric|min:0|max:1",
				"type"=>'float'
			],
			"alpha_g" => [
				"default"=>"0.01",
				"display_name"=>"Signif. Level (Gene Ranking)",
				"help_text"=>"Significance level for enrichment/depletion analysis of genes",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "numeric|min:0|max:1",
				"type"=>'float'
			],
			"padj" => [
				"display_name"=>"p-value Adjustment",
				"default"=>"fdr_bh",
				"help_text"=>"Method for p-value adjustment for multiple tests.",
				"in_quotes"=>true,
				"hidden" =>false,
				"rules" => "string|in:fdr_bh,fdr_tsbh,sidak,bonferroni",
				"type" =>"select",
				"options" => [
					"fdr_bh"=>"FDR (Benjamini/Hochberg)",
					"fdr_tsbh"=>"Two-stage FDR (Benjamini/Hochberg)",
					"sidak"=>"Sidak",
					"bonferroni" => "Bonferroni"
				]
			],
			"p_overdisp" => [
				"display_name"=>"Signif. Level (Model Selection)",
				"default"=>"0.01",
				"help_text"=>"p-value threshold for rejecting Poisson distribution of read counts.",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "numeric|min:0|max:1",
				"type"=>'float'
			],
		],
		"Sample Clustering" => [
			"ClusterBy" => [
				"display_name"=>"Cluster by...",
				"default"=>"variance",
				"help_text"=>"Clustering of samples either based on most variable sgRNAs or most enriched/depleted sgRNAs.",
				"in_quotes"=>true,
				"hidden" =>false,
				"rules" => "string|in:variance,counts",
				"type" =>"select",
				"options" => ["variance"=>"Variance","counts"=>"Counts"]
			],
			"TopN" => [
				"display_name"=>"#sgRNAs for clustering",
				"default"=>"25",
				"help_text"=>"Number of sgRNAs to be taken into account for clustering.",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "numeric|min:0",
				"type"=>'number'
			],
		],
		"Visualization" => [
			"dotsize" => [
				"default"=>"10",
				"help_text"=>"Dot size in scatterplots.",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "numeric|max:20|min:1",
				"type"=>'number'
			],
			"TransparencyLevel" => [
				"display_name"=> "Transparency Level",
				"default"=>"0.1",
				"help_text"=>"Transparency of points in scatterplots",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "numeric|min:0|max:1",
				"type"=>'float'
			],
			"scatter_annotate" => [
				"display_name"=>"sgRNA Annotation",
				"default"=>"False",
				"help_text"=>"Annotate sgRNAs when highlighting a gene in scatterplots",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "string|in:True,False",
				"type" =>"select",
				'placeholder'=>'No',
				"options" => ["True"=>"Yes", "False"=>"No"]
			],
			"ShowNonTargets" => [
				"display_name"=> "Highlight non-targeting controls",
				"default"=>"False",
				"help_text"=>"Highlight non-targeting control sgRNAs in scatterplots",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "string|in:True,False",
				"type" =>"select",
				'placeholder'=>'No',
				"options" => ["True"=>"Yes", "False"=>"No"]
			],
			"logbase" => [
				"default"=>"10",
				"help_text"=>"Base of logarithm for log transformation of read counts.",
				"in_quotes"=>false,
				"hidden" =>true,
				"rules" => "numeric|in:2,10",
				"type"=>'select',
				"options" => ["2"=>"2", "10"=>"10"]
			],
			"width_p" => [
				"default"=>"800",
				"help_text"=>"Width of heatmap image (pixels)",
				"in_quotes"=>false,
				"hidden" =>true,
				"rules" => "numeric|min:800|same:height_p",
				"type"=>'number'
			],
			"height_p" => [
				"default"=>"800",
				"help_text"=>"Height of heatmap image (pixels)",
				"in_quotes"=>false,
				"hidden" =>true,
				"rules" => "numeric|min:800|same:width_p",
				"type"=>'number'
			],
			"fontsize_p" => [
				"default"=>"14",
				"help_text"=>"Fontsize in heatmap image",
				"in_quotes"=>false,
				"hidden" =>true,
				"rules" => "numeric|min:1",
				"type"=>'number'
			],
			"marginsize" => [
				"default"=>"10",
				"help_text"=>"Size of margin in heatmap image (increase if sample names are clipped)",
				"in_quotes"=>false,
				"hidden" =>true,
				"rules" => "numeric|min:0",
				"type"=>'number'
			],
			"max_q" => [
				"default"=>"95",
				"help_text"=>"Maximum quantile to be plotted in read count distribution histograms.",
				"in_quotes"=>false,
				"hidden" =>True,
				"rules" => "numeric|numeric|min:0|max:100",
				"type"=>'number'
			],
			"svg" => [
				"default"=>"True",
				"help_text"=>"Additional output of all plots as vector graphics.",
				"in_quotes"=>false,
				"hidden" =>true,
				"rules" => "string|in:True,False",
				"type" =>"select",
				'placeholder'=>'Yes',
				"options" => ["True"=>"Yes", "False"=>"No"]
			],
			"dpi" => [
				"display_name"=>"PNG Resolution",
				"default"=>"300",
				"help_text"=>"Resolution of PNG graphics.",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "numeric|in:150,300,600",
				"type"=>'select',
				"options" => ["150"=>"150", "300"=>"300", "600"=>"600"]
			],
			"HitListFormat" => [
				"display_name"=>"Spreadsheet Format",
				"default"=>"tsv",
				"help_text"=>"Set to Excel to have tables automatically converted to Excel xlsx files. (WARNING: This slows down the workflow)",
				"in_quotes"=>true,
				"hidden" =>false,
				"rules" => "string|in:tsv,xlsx",
				"type" =>"select",
				'placeholder'=>'Text Only (tsv)',
				"options" => ["tsv"=>"Text Only (tsv)", "xlsx"=>"Excel"]
			],
		]
	],
	"directories"=> 
		"WorkingDir: '/workingdir/'\n".
		"DataDir: '/workingdir/Data/'\n".
		"TempDataDir: '/workingdir/TempData/'\n".
		"LibDir: '/workingdir/Library/'\n".
		"IndexDir: '/workingdir/Library/Bowtie2_Index/'\n".
		"ScriptsDir: '/opt/PinAPL-Py/Scripts/'\n".
		"AlignDir: '/workingdir/Alignments/'\n".
		"AnalysisDir: '/workingdir/Analysis/'\n".
		"TrimLogDir: '/workingdir/Analysis/Read_Trimming'\n".
		"HitDir: '/workingdir/Analysis/sgRNA_Rankings'\n".
		"GeneDir: '/workingdir/Analysis/Gene_Rankings'\n".
		"ControlDir: '/workingdir/Analysis/Control/'\n".
		"HeatDir: '/workingdir/Analysis/Heatmap/'\n".
		"AlnQCDir: '/workingdir/Analysis/Alignment_Statistics/'\n".
		"CountQCDir: '/workingdir/Analysis/ReadCount_Statistics/'\n".
		"ScatterDir: '/workingdir/Analysis/ReadCount_Scatterplots/'\n".
		"HiLiteDir: '/workingdir/Analysis/ReadCount_Scatterplots/Highlighted_Genes/'\n".
		"CorrelDir: '/workingdir/Analysis/Replicate_Correlation/'\n".
		"HiLiteDir2: '/workingdir/Analysis/Replicate_Correlation/Highlighted_Genes'\n".
		"EffDir: '/workingdir/Analysis/sgRNA_Efficacy/'\n".
		"DepthDir: '/workingdir/Analysis/Read_Depth/'\n".
		"SeqQCDir: '/workingdir/Analysis/Sequence_Quality/'\n".
		"pvalDir: '/workingdir/Analysis/p-values/' \n".
		"LogFileDir: '/workingdir/Analysis/Log_File/'\n".
		"bw2Dir: '/usr/bin/'\n".
		"CutAdaptDir: '/root/.local/bin/'   \n".
		"STARSDir: '/opt/PinAPL-Py/Scripts/STARS_mod/'\n"
	,
	"script_filenames" => 
		"SanityScript: 'CheckCharacters'\n".
		"IndexScript: 'BuildLibraryIndex'\n".
		"LoaderScript: 'LoadDataSheet'\n".
		"ReadDepthScript: 'PlotNumReads'\n".
		"SeqQCScript: 'CheckSequenceQuality'\n".
		"TrimScript: 'TrimReads'\n".
		"AlignScript: 'AlignReads'\n".
		"NormalizeScript: 'NormalizeReadCounts'\n".
		"AverageCountsScript: 'AverageCounts'\n".
		"StatsScript: 'AnalyzeReadCounts'\n".
		"ControlScript: 'AnalyzeControl'\n".
		"sgRNARankScript: 'FindHits'\n".
		"GeneRankScript: 'RankGenes'\n".
		"CombineScript: 'CombineGeneRanks'\n".
		"ScatterScript: 'PlotCounts'\n".
		"ReplicateScript: 'PlotReplicates'\n".
		"ClusterScript: 'PlotHeatmap'\n"
	,
	"libraries" => [
		"Activity-optimized_human_genome-wide.tsv" => "Activity-optimized human genome-wide",
		"Brie_Genome-wide_including_Controls.tsv" => "Brie Mouse genome-wide",
		"Brie_Kinome.tsv" => "Brie Mouse kinome",
		"Brunello_genome-wide.tsv" => "Brunello human genome-wide",
		"Brunello_kinome_guides1-4.tsv" => "Brunello human kinome (guides 1-4)",
		"Brunello_kinome_guides5-8.tsv" => "Brunello human kinome (guides 5-8)",
		"Brunello_kinome_guides1-4&5-8.tsv" => "Brunello human kinome (guides 1-4&5-8)",
		"GeCKOv2_Human.tsv" => "Human GeCKO v2 (Full)",
		"Human_GeCKOv2_Library_A.csv" => "Human GeCKO v2 (Half_A)",
		"Human_GeCKOv2_Library_B.csv" => "Human GeCKO v2 (Half_B)",
		"GeCKOv21_Human.tsv" => "Human GeCKO v2 (Full, NonTargeting duplicates removed)",
		"Human_improved_genome-wide_KnockOut_v1.tsv" => "Human improved genome-wide Knockout v1",
		"GeCKOv2_Mouse.csv" => "Mouse GeCKO v2 (Full)",
		"Mouse_GeCKOv2_Library_A.csv" => "Mouse GeCKO v2 (Half_A)",
		"Mouse_GeCKOv2_Library_B.csv" => "Mouse GeCKO v2 (Half_B)",
		"Mouse_improved_genome-wide_KnockOut_v2.tsv" => "Mouse improved genome-wide KnockOut v2",
		"Oxford_genome-wide.tsv" => "Oxford Drosophila genome-wide",
		"Toronto_KnockOut_genome-wide_base.tsv" => "Toronto KnockOut (Base Library)",
		"Toronto_KnockOut_genome-wide_base&supplemental.csv" => "Toronto KnockOut (Base & Supplemental Library)",
		"Toronto_KnockOut_genome-wide_supplemental.tsv" => "Toronto KnockOut (Supplemental Library)",
	]
];


/*
	
		"ArgName" => [
			"default"=>"ArgDefault",
			"help_text"=>"ArgHelpText",
			"in_quotes"=>true,
			"hidden" =>false,
			"rules" => ""
		],

 */