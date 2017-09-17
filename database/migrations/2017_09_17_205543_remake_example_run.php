<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemakeExampleRun extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$mapping = json_decode(\File::get(storage_path("runs/example-run/fileMap.json")),true);
		$files = $mapping['treatment'];

		\App\GeneRanking::where('dir','example-run')->delete();
		\App\SgrnaRanking::where('dir','example-run')->delete();

		$geneColumns = ['gene','arra','arra_p_value','arra_fdr','significant','num_sgrna','num_sig_sgrna', 'avg_log_fc'];
        $geneTable = 'gene_rankings';
        $sgrnaColumns = ['sgrna', 'gene', 'counts', 'control_mean', 'control_stdev', 'fold_change', 'p_value', 'fdr', 'significant'];
        $sgrnaTable= 'sgrna_rankings';

		foreach ($files as $fileName => $fileProperties){
			$prefix = $fileProperties['condition'].'_'.$fileProperties['index'];
			$extra = ['dir'=>'example-run', 'file'=>$prefix];
			// Import gene_rankings
			$geneFile = \File::glob(storage_path("runs/example-run/workingDir/Analysis/Gene_Rankings/$prefix*.tsv"));
			$geneFile = array_shift($geneFile);
			csvToMysql($geneFile, $geneTable, $geneColumns, "\t", 1, $extra);
			// Import sgrna_rankings
			$sgrnaFile = \File::glob(storage_path("runs/example-run/workingDir/Analysis/sgRNA_Rankings/$prefix*.tsv"));
			$sgrnaFile = array_shift($sgrnaFile);
			csvToMysql($sgrnaFile, $sgrnaTable, $sgrnaColumns, "\t", 1, $extra);
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}
}
