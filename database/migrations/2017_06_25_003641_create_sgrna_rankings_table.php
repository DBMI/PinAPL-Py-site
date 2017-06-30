<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSgrnaRankingsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sgrna_rankings', function (Blueprint $table) {
			$table->increments('id');
			$table->string('dir',25);
			$table->string('file');
			$table->string('sgrna');
			$table->string('gene');
			$table->integer('counts');
			$table->float('control_mean');
			$table->double('control_stdev');
			$table->float('fold_change');
			$table->double('p_value');
			$table->double('fdr');
			$table->string('significant');
		});

		$sgrnaColumns = ['sgrna', 'gene', 'counts', 'control_mean', 'control_stdev', 'fold_change', 'p_value', 'fdr', 'significant'];
		$sgrnaTable= 'sgrna_rankings';

		// Import example-run
    $mapping = json_decode(\File::get(storage_path("runs/example-run/fileMap.json")),true);
		$files = $mapping['treatment'];
		foreach ($files as $fileName => $fileProperties){
			$prefix = $fileProperties['condition'].'_'.$fileProperties['index'];
			$extra = ['dir'=>'example-run', 'file'=>$prefix];
			$sgrnaFile = \File::glob(storage_path("runs/example-run/workingDir/Analysis/sgRNA_Rankings/$prefix*.tsv"));
			$sgrnaFile = array_shift($sgrnaFile);
			csvToMysql($sgrnaFile, $sgrnaTable, $sgrnaColumns, "\t", 1, $extra);
		}
		// Imporrt all existing finished runs
		$runs = \App\Run::where('status','finished')->get();
		foreach ($runs as $run) {
			$runHash = $run->dir;
			$mapping = json_decode(\File::get($run->directory().'/fileMap.json'),true);
			$files = $mapping['treatment'];
			foreach ($files as $fileName => $fileProperties){
				$prefix = $fileProperties['condition'].'_'.$fileProperties['index'];
				$extra = ['dir'=>$runHash, 'file'=>$prefix];
				$sgrnaFile = \File::glob(storage_path("runs/$runHash/workingDir/Analysis/sgRNA_Rankings/$prefix*.tsv"));
				$sgrnaFile = array_shift($sgrnaFile);
				csvToMysql($sgrnaFile, $sgrnaTable, $sgrnaColumns, "\t", 1, $extra);
			}
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sgrna_rankings');
	}
}
