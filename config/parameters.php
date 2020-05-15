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
		"Gene Ranking" => [
			"GeneMetric" => [
				"display_name"=>"Gene Ranking Metric",
				"default"=>"SigmaFC",
				"placeholder" => "SUMLFC",
				"help_text"=>"Metric for gene ranking analysis.",
				"in_quotes"=>true,
				"hidden" =>false,
				"rules" => "string|in:SigmaFC,AvgLogFC,aRRA,STARS",
				"type" =>"select",
				"options" => ["SigmaFC"=>"SUMLFC","AvgLogFC"=>"AVGLFC", "aRRA"=>"aRRA", "STARS"=>"STARS"]
			],
			"Np" => [
				"display_name"=>"Number of permutations",
				"default"=>"10000",
				"help_text"=>"Number of permutations to run to estimate p-values in gene ranking analysis (recommended 10000 for aRRA, 10 for STARS.)",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "numeric|min:0|max:100000",
				"type"=>'number'
			],
			"alpha_g" => [
				"display_name"=>"Significance Level",
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
				"rules" => "numeric|min:0|max:100",
				"type"=>'number'
			],
			"IncludeGeneRankCombination" => [
				"display_name"=>"IncludeGeneRankCombination",
				"default"=>"False",
				"help_text"=>"Fishers statistic for p-value combination",
				"in_quotes"=>false,
				"hidden" =>true,
				"rules" => "string|in:False,True",
				"type" =>"select",
				'placeholder'=>'No',
				"options" => ["False"=>"No", "True"=>"Yes"] 
			],
			"w_SigmaFC" => [
				"default"=>"[0,1,2,3,4,5,6]",
				"help_text"=>"DEFAULT FALSE(?)",
				"in_quotes"=>false,
				"hidden" =>true,
				"rules" => "string|in:True,False",
				"type" =>"select",
				'placeholder'=>'Yes',
			],
		],
		"sgRNA Ranking" => [			
			"padj" => [
				"display_name"=>"p-value Adjustment",
				"default"=>"Sidak",
				"help_text"=>"Method for p-value adjustment for multiple tests.",
				"in_quotes"=>true,
				"hidden" =>false,
				"rules" => "string|in:sidak,bonferroni,fdr_bh",
				"type" =>"select",
				"options" => [
					"sidak"=>"Sidak",
					"bonferroni" => "Bonferroni",
					"fdr_bh"=>"FDR (Benjamini/Hochberg)",
				]
			],
			"alpha_s" => [
				"default"=>"0.01",
				"display_name"=>"Significance Level",
				"help_text"=>"Significance level for enrichment/depletion analysis of sgRNAs",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "numeric|min:0|max:1",
				"type"=>'float'
			],
			"ClusterBy" => [
				"display_name"=>"Cluster by...",
				"default"=>"variance",
				"placeholder"=>"Highest Variance",
				"help_text"=>"Clustering of samples either based on most variable sgRNAs or most enriched/depleted sgRNAs.",
				"in_quotes"=>true,
				"hidden" =>false,
				"rules" => "string|in:variance,counts",
				"type" =>"select",
				"options" => ["variance"=>"Highest Variance","counts"=>"Highest Counts"]
			],
			"TopN" => [
				"display_name"=>"Top % of sgRNAs for clustering",
				"default"=>"25",
				"help_text"=>"Number of sgRNAs to be taken into account for clustering.",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "numeric|min:0|max:100",
				"type"=>'number'
			],
		],
		"Read Counting" => [
			"Normalization" => [
				"default"=>"cpm",
				"help_text"=>"Method of read count normalization. cpm = counts per million reads.",
				"in_quotes"=>true,
				"hidden" =>false,
				"rules" => "string|in:total,cpm,size",
				"type" =>"select",
				"options" => ["total"=>"total","cpm"=>"cpm","size"=>"size"]
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
				"rules" => "string|in:False,True",
				"type" =>"select",
				'placeholder'=>'No',
				"options" => ["False"=>"No", "True"=>"Yes"]
			],
			"repl_avg" => [
				"display_name"=>"Averaging",
				"default"=>"median",
				"placeholder"=>"Median",
				"help_text"=>"Method of read count averaging",
				"in_quotes"=>true,
				"hidden" =>false,
				"rules" => "string|in:median,mean",
				"type" =>"select",
				"options" => ["median"=>"Median","mean"=>"Mean"]
			],
		],
		"Alignment" => [
			"sgRNALength" => [
				"display_name"=>"sgRNA Length",
				"default"=>"20",
				"help_text"=>"Length of sgRNA sequence (bp)",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "numeric|min:0",
				"type"=>'number'
			],
			"CutErrorTol" => [
				"display_name"=>"Adapter Error Tolerance",
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
		"Plotting" => [
			"ShowNonTargets" => [
				"display_name"=> "Show Non-targeting Controls",
				"default"=>"True",
				"help_text"=>"Highlight non-targeting control sgRNAs in scatterplots",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "string|in:True,False",
				"type" =>"select",
				'placeholder'=>'Yes',
				"options" => ["True"=>"Yes", "False"=>"No"]
			],
			"scatter_annotate" => [
				"display_name"=>"Annotate sgRNAs",
				"default"=>"False",
				"help_text"=>"Annotate sgRNAs when highlighting a gene in scatterplots",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "string|in:False,True",
				"type" =>"select",
				'placeholder'=>'No',
				"options" => ["False"=>"No", "True"=>"Yes"]
			],
			"TransparencyLevel" => [
				"display_name"=> "Transparency Level",
				"default"=>"0.05",
				"help_text"=>"Transparency of points in scatterplots",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "numeric|min:0|max:1",
				"type"=>'float'
			],
			"dotsize" => [
				"display_name"=>"Dotsize",
				"default"=>"10",
				"help_text"=>"Dot size in scatterplots.",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "numeric|max:20|min:1",
				"type"=>'number'
			],
			"dpi" => [
				"display_name"=>"PNG resolution",
				"default"=>"300",
				"help_text"=>"resolution of png graphics.",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "numeric|in:150,300,600",
				"type"=>'select',
				"options" => ["150"=>"150", "300"=>"300", "600"=>"600"]
			],
			"HitListFormat" => [
				"display_name"=>"Spreadsheet Format",
				"default"=>"xlsx",
				"help_text"=>"Set to Excel to have tables automatically converted to Excel xlsx files. (WARNING: This slows down the workflow)",
				"in_quotes"=>true,
				"hidden" =>false,
				"rules" => "string|in:xlsx,tsv",
				"type" =>"select",
				'placeholder'=>'Excel',
				"options" => ["xlsx"=>"Excel", "tsv"=>"Text Only (tsv)"]
			],
			"AutoHighlight" => [
				"display_name"=>"AutoHighlight Top Hits",
				"default"=>"True",
				"help_text"=>"",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "string|in:True,False",
				"type" =>"select",
				'placeholder'=>'Yes',
				"options" => ["True"=>"Yes", "False"=>"No"]
			],
			"IncludeDensityPlots" => [
				"display_name"=>"Include Density Plot",
				"default"=>"True",
				"help_text"=>"",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "string|in:True,False",
				"type" =>"select",
				'placeholder'=>'Yes',
				"options" => ["True"=>"Yes", "False"=>"No"]
			],
			"p_overdisp" => [
				"display_name"=>"Signif. Level (Model Selection)",
				"default"=>"0.05",
				"help_text"=>"p-value threshold for rejecting Poisson distribution of read counts.",
				"in_quotes"=>false,
				"hidden" =>false,
				"rules" => "numeric|min:0|max:1",
				"type"=>'float'
			],
			"PrintHighlights" => [
				"default"=>"false",
				"help_text"=>"print highlighted sgRNA info in console [True/False]",
				"in_quotes"=>false,
				"hidden" =>true,
				"rules" => "string|in:False,True",
				"type" =>"select",
				'placeholder'=>'No',
				"options" => ["False"=>"No", "True"=>"Yes"]
			],
			"FCmin_SigmaFC" => [
				"default"=>"0",
				"help_text"=>"minimal FC required for SigmaFC",
				"in_quotes"=>false,
				"hidden" =>true,
				"rules" => "numeric|min:0",
				"type"=>'number'
			],
			"delta" => [
				"default"=>"1",
				"help_text"=>"Shift in read counts to avoid errors with zero counts during log transformation, fold change calculation etc.",
				"in_quotes"=>false,
				"hidden" =>true,
				"rules" => "numeric|min:0",
				"type"=>'number'
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
		],
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
		"TrimLogDir: '/workingdir/Analysis/01_Alignment_Results/Read_Trimming/'\n".	
		"sgRNARanksDir: '/workingdir/Analysis/02_sgRNA-Ranking_Results/sgRNA_Rankings/'\n".
		"GeneDir: '/workingdir/Analysis/03_GeneRanking_Results/Gene_Rankings'\n".
		"ControlDir: '/workingdir/Analysis/02_sgRNA-Ranking_Results/ControlSample_Analysis/'\n".
		"HeatDir: '/workingdir/Analysis/02_sgRNA-Ranking_Results/Heatmap/'\n".
		"AlnQCDir: '/workingdir/Analysis/01_Alignment_Results/Alignment_Statistics/'\n".
		"sgRNAReadCountDir: '/workingdir/Analysis/01_Alignment_Results/ReadCounts_per_sgRNA/'\n".
		"GeneReadCountDir: '/workingdir/Analysis/01_Alignment_Results/ReadCounts_per_Gene/'\n".
		"CountQCDir: '/workingdir/Analysis/02_sgRNA-Ranking_Results/ReadCount_Distribution/'\n".
		"ScatterDir: '/workingdir/Analysis/02_sgRNA-Ranking_Results/sgRNA_Scatterplots/'\n".
		"DensityDir: '/workingdir/Analysis/02_sgRNA-Ranking_Results/sgRNA_Densities/'\n".	
		"GenePlotDir: '/workingdir/Analysis/03_GeneRanking_Results/GeneScore_Scatterplots/'\n".
		"HiLiteDir: '/workingdir/Analysis/02_sgRNA-Ranking_Results/ReadCount_Scatterplots/Highlighted_Genes/'\n".
		"CorrelDir: '/workingdir/Analysis/02_sgRNA-Ranking_Results/Replicate_Correlation/'\n".
		"HiLiteDir2: '/workingdir/Analysis/02_sgRNA-Ranking_Results/Replicate_Correlation/Highlighted_Genes/'\n".
		"EffDir: '/workingdir/Analysis/03_GeneRanking_Results/sgRNA_Efficacy/'\n".
		"DepthDir: '/workingdir/Analysis/01_Alignment_Results/Read_Depth/'\n".
		"SeqQCDir: '/workingdir/Analysis/01_Alignment_Results/Sequence_Quality/'\n".
		"pvalDir_sgRNA: '/workingdir/Analysis/02_sgRNA-Ranking_Results/p-value_Distribution/' \n".
		"pvalDir_genes: '/workingdir/Analysis/03_GeneRanking_Results/p-value_Distribution/' \n".
		"LogFileDir: '/workingdir/Analysis/00_Log_File/'\n".
		"zScoreDir_sgRNA: '/workingdir/Analysis/02_sgRNA-Ranking_Results/sgRNA_z-Scores/' \n".
		"VolcanoDir_sgRNA: '/workingdir/Analysis/02_sgRNA-Ranking_Results/sgRNA_VolcanoPlots/' \n".
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
		"ClassifyScript: 'GetReadCounts'\n".
		"CutoffScript: 'ApplyCutoff'\n".
		"CleanUpScript: 'RemoveTempOutput'\n".
		"NormalizeScript: 'NormalizeReadCounts'\n".
		"AverageCountsScript: 'AverageCounts'\n".
		"StatsScript: 'AnalyzeReadCounts'\n".
		"ControlScript: 'AnalyzeControl'\n".
		"sgRNARankScript: 'RanksgRNAs'\n".
		"zFCScript: 'PlotFCz'\n".
		"vFCScript: 'PlotFCvolcano'\n".
		"GeneRankScript: 'RankGenes'\n".
		"GenePlotScript: 'PlotGeneScores'\n".
		"CombineScript: 'CombineGeneRanks'\n".
		"ScatterScript: 'PlotCounts'\n".
		"DensityScript: 'PlotDensity'\n".
		"ReplicateScript: 'PlotReplicates'\n".
		"ClusterScript: 'PlotHeatmap'\n".
		"ExtractTop10Script: 'ExtractTop10Genes'\n"
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
