<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneRankingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gene_rankings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dir',25);
            $table->string('file');
            $table->string('gene');
            $table->double('arra');
            $table->float('arra_p_value');
            $table->float('arra_fdr');
            $table->string('significant');
            $table->integer('num_sig_sgrna');
        });

        $geneColumns = ['gene','arra','arra_p_value','arra_fdr','significant','num_sig_sgrna'];
        $geneTable = 'gene_rankings';
        
        // Import example-run
        $mapping = json_decode(\File::get(storage_path("runs/example-run/fileMap.json")),true);
        $files = $mapping['treatment'];
        foreach ($files as $fileName => $fileProperties){
            $prefix = $fileProperties['condition'].'_'.$fileProperties['index'];
            $extra = ['dir'=>'example-run', 'file'=>$prefix];
            $geneFile = \File::glob(storage_path("runs/example-run/workingDir/Analysis/Gene_Rankings/$prefix*.tsv"));
            $geneFile = array_shift($geneFile);
            csvToMysql($geneFile, $geneTable, $geneColumns, "\t", 1, $extra);
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
                $geneFile = \File::glob(storage_path("runs/$runHash/workingDir/Analysis/Gene_Rankings/$prefix*.tsv"));
                $geneFile = array_shift($geneFile);
                csvToMysql($geneFile, $geneTable, $geneColumns, "\t", 1, $extra);
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
        Schema::drop('gene_rankings');
    }
}
