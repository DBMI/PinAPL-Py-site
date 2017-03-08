<?php

return [
	"parameter_groups" =>[
		"Required" => [	
			"ScreenType" => [
				"display_name"=>"Screen Type",
				"default"=>"enrichment",
				"help_text"=>"Specifies the type of screen.",
				"in_quotes"=>true,
				"rules" => "string|required|in:enrichment,depletion",
				"type"=> "select",
				"options" => ["enrichment"=>"Enrichment", "depletion"=>"Depletion"]
			],
			"LibFilename" => [ 
				"display_name"=>"Library",
				"default"=> "GeCKOv2_library.tsv",
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
			"seq_3_end" => [
				"display_name"=>"3'-adapter",
				"default"=>"GTTTTAGAGCTAGAAATAGCAAGTT",
				"help_text"=>"sequence 3' of sgRNA in read",
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
			"sgRNAsPerGene" => [
				"display_name"=>"#sgRNAs per Gene",
				"default"=>"6",
				"help_text"=>"number of sgRNAs targeting each gene (excluding non-targeting controls and miRNAs). ONLY IMPORTANT IF 'ES' is chosen for gene ranking method !",
				"in_quotes"=>false,
				"hidden" =>true,
				"rules" => "numeric|min:1",
				"type"=>'number'
			]
		],
		"Read Counting" => [
			"Normalization" => [
				"default"=>"cpm",
				"help_text"=>"Method of read count normalization. cpm = counts per million reads.",
				"in_quotes"=>true,
				"hidden" =>false,
				"rules" => "string|in:cpm,size",
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
		],
		"Heatmap" => [
			"ClusterBy" => [
				"display_name"=>"Cluster by",
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
				"help_text"=>"Number of sgRNAs to be taken into account for clustering. If ClusterBy is set to ‘counts’ the union of the TopN enriched/depleted sgRNAs over all samples is taken.",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "numeric|min:0",
				"type"=>'number'
			],
		],
		"Gene Ranking" => [
			"GeneMetric" => [
				"display_name"=>"Gene Ranking Metric",
				"default"=>"aRRA",
				"help_text"=>"Metric for gene ranking analysis.",
				"in_quotes"=>true,
				"hidden" =>false,
				"rules" => "string|in:aRRA,STARS,ES",
				"type" =>"select",
				"options" => ["aRRA"=>"aRRA","STARS"=>"STARS","ES"=>"ES"]
			],
			"Np" => [
				"display_name"=>"Number of permutations",
				"default"=>"1000",
				"help_text"=>"Number of permutations to run to estimate p-values in gene ranking analysis. CAUTION: Different ranking methods take more computation time than others, so adjust according to method!",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "numeric|min:0",
				"type"=>'number'
			],
			"thr_STARS" => [
				"display_name"=>"% Genes Displayed (STARS only)",
				"default"=>"10",
				"help_text"=>"Percentage of reported genes after ranking analysis. ONLY RELEVANT IF ‘STARS’ METHOD IS CHOSEN.",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "numeric|min:0",
				"type"=>'number'
			],
		],
		"Statistical Significance" => [
			"alpha" => [
				"default"=>"0.1",
				"display_name"=>"FDR",
				"help_text"=>"Significance threshold.",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "between:0,1",
				"type"=>'number'
			],
			"padj" => [
				"display_name"=>"p-value adjustment",
				"default"=>"fdr_bh",
				"help_text"=>"Method for p-value adjustment for multiple tests.",
				"in_quotes"=>true,
				"hidden" =>false,
				"rules" => "string|in:fdr_bh,fdr_tsbh",
				"type" =>"select",
				"options" => ["fdr_bh"=>"fdr_bh", "fdr_tsbh"=>"fdr_tsbh"]
			],
		],
		"Adapter Trimming" => [
			"R_min" => [
				"display_name"=>"Minimal Read Length",
				"default"=>"10",
				"help_text"=>"Minimal allowed read length after cutting the 5' adapter. Reads with length shorter than R_min after cutting the adaptor will be discarded. Refer to the cutadapt manual for more information.",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "numeric|min:0",
				"type"=>'number'
			],
			"CutErrorTol" => [
				"display_name"=>"Error Tolerance",
				"default"=>"0.25",
				"help_text"=>"Allowed error rate for Identification of the 5’ and 3’ read adapters. Refer to the cutadapt manual for more information.",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "between:0,1",
				"type"=>'number'
			],
		],
		"Alignment" => [
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
				"type" =>"select",
				"options" => ["True"=>"True", "False"=>"False"]
			],
			"Theta" => [
				"default"=>"2",
				"help_text"=>"Minimum required difference between primary and secondary alignment score in order to consider the read successfully matched. Reads with lower difference between primary and secondary alignment will be discarded. Increase Theta to increase the stringency of the alignment. Decrease Theta to increase sensitivity.",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "numeric|min:0",
				"type"=>'number'
			],
			"L_bw" => [
				"default"=>"11",
				"help_text"=>"Bowtie2 seed length parameter. Refer to the Bowtie2 manual for more information.",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "numeric|min:0",
				"type"=>'number'
			],
			"N_bw" => [
				"default"=>"1",
				"help_text"=>"Bowtie2 seed number parameter. Refer to the Bowtie2 manual for more information.",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "numeric|in:0,1,2",
				"type"=>'select',
				"options" => ["0"=>"0", "1"=>"1", "2"=>"2"]
			],
			"i_bw" => [
				"default"=>"S,1,0.75",
				"help_text"=>"Bowtie2 seed interval parameter. Refer to the Bowtie2 manual for more information.",
				"in_quotes"=>true,
				"hidden" =>false,
				"rules" => "string"
			],
			"delta" => [
				"default"=>"1",
				"help_text"=>"Shift in read counts to avoid errors with zero counts during log transformation, fold change calculation etc.",
				"in_quotes"=>false,
				"hidden" =>true,
				"rules" => "min:0",
				"type"=>'number'
			],
		],
		"Output Formatting" => [
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
			"dotsize" => [
				"default"=>"10",
				"help_text"=>"Dot size in scatterplots.",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "numeric|min:1",
				"type"=>'number'
			],
			"logbase" => [
				"default"=>"10",
				"help_text"=>"Base of logarithm for log transformation of read counts.",
				"in_quotes"=>false,
				"hidden" =>false,
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
			"scatter_annotate" => [
				"default"=>"False",
				"help_text"=>"Annotate scatterplot with sgRNA IDs?",
				"in_quotes"=>false,
				"hidden" =>true,
				"rules" => "string|in:True,False",
				"type" =>"select",
				"options" => ["True"=>"True", "False"=>"False"]
			],
			"max_q" => [
				"default"=>"95",
				"help_text"=>"Maximum quantile to be plotted in read count distribution histograms.",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "numeric|between:0,100",
				"type"=>'number'
			],
			"svg" => [
				"default"=>"True",
				"help_text"=>"Additional output of all plots as vector graphics.",
				"in_quotes"=>false,
				"hidden" =>true,
				"rules" => "string|in:True,False",
				"type" =>"select",
				"options" => ["True"=>"True", "False"=>"False"]
			],
			"HitListFormat" => [
				"display_name"=>"Spreadsheet Format",
				"default"=>"xlsx",
				"help_text"=>"Format of results spreadsheets (sgRNA hits and gene ranking)",
				"in_quotes"=>true,
				"hidden" =>true,
				"rules" => "string|in:tsv,xlsx",
				"type" =>"select",
				"options" => ["tsv"=>"tsv only", "xlsx"=>"xlsx"]
			],
		]
	],
	"directories"=> 
		"WorkingDir: '/workingdir/' \n".
		"DataDir: '/workingdir/Data/' \n".
		"LibDir: '/workingdir/Library/' \n".
		// If custom instead make point to /workingdir/Library
		"IndexDir: '/workingdir/Library/Bowtie2_Index/' \n".
		"ScriptsDir: '/opt/PinAPL-Py/Scripts/' \n".
		"AlignDir: '/workingdir/Alignments/' \n".
		"AnalysisDir: '/workingdir/Analysis/' \n".
		"HitDir: '/workingdir/Analysis/sgRNA_Rankings' \n".
		"GeneDir: '/workingdir/Analysis/Gene_Rankings' \n".
		"ControlDir: '/workingdir/Analysis/Control/' \n".
		"HeatDir: '/workingdir/Analysis/Heatmap/' \n".
		"AlnQCDir: '/workingdir/Analysis/Alignment_Statistics/' \n".
		"CountQCDir: '/workingdir/Analysis/ReadCount_Statistics/' \n".
		"ScatterDir: '/workingdir/Analysis/ReadCount_Scatterplots/' \n".
		"CorrelDir: '/workingdir/Analysis/Replicate_Correlation/' \n".
		"EffDir: '/workingdir/Analysis/sgRNA_Efficiency/' \n".
		"DepthDir: '/workingdir/Analysis/Read_Depth/'  \n".
		"pvalDir: '/workingdir/Analysis/p-values/'  \n".
		"LogFileDir: '/workingdir/Analysis/Log_File/' \n".
		"bw2Dir: '/usr/bin/' \n".
		"CutAdaptDir: '/root/.local/bin/'    \n".
		"STARSDir: '/opt/PinAPL-Py/Scripts/STARS_mod/' \n"
	,
	"script_filenames" => 
		"script00: 'BuildLibraryIndex' \n".
		"script01: 'LoadDataSheet' \n".
		"script02: 'PlotNumReads' \n".
		"script03: 'AlignReads' \n".
		"script04: 'NormalizeReadCounts' \n".
		"script05: 'AnalyzeReadCounts' \n".
		"script06: 'AnalyzeControl' \n".
		"script07: 'FindHits' \n".
		"script08: 'RankGenes' \n".
		"script09: 'PlotCounts' \n".
		"script10: 'PlotReplicates' \n".
		"script11: 'PlotHeatmap' \n"
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
		"Human_improved_genome-wide_KnockOut_v1.tsv" => "Human improved genome-wide Knockout v1",
		"GeCKOv2_Mouse.csv" => "Mouse GeCKO v2 (Full)",
		"Mouse_GeCKOv2_Library_A.csv" => "Mouse GeCKO v2 (Half_A)",
		"Mouse_GeCKOv2_Library_B.csv" => "Mouse GeCKO v2 (Half_B)",
		"Mouse_improved_genome-wide_KnockOut_v2.tsv" => "Mouse improved genome-wide KnockOut v2",
		"Oxford_genome-wide.tsv" => "Oxford Drosophila genome-wide",
		"Toronto_KnockOut_genome-wide_base.tsv" => "Toronto KnockOut (Base Library)",
		"Toronto_KnockOut_genome-wide_base&supplemental.csv" => "Toronto KnockOut (Base & Supplemental Library)",
		"Toronto_KnockOut_genome-wide_supplemental.tsv" => "Toronto KnockOut (Supplemental Library)",
	],
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