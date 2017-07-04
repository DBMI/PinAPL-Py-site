<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToGeneRanking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gene_rankings', function($table) {
            $table->dropColumn('arra_p_value');
            $table->dropColumn('arra_fdr');
        });
        Schema::table('gene_rankings', function($table) {
            $table->integer('num_sgrna')->after('significant');
            $table->double('avg_log_fc')->after('num_sig_sgrna');
            $table->double('arra_p_value')->after('arra');
            $table->double('arra_fdr')->after('arra_p_value');
        });
        $geneColumns = ['gene','arra','arra_p_value','arra_fdr','significant','num_sgrna','num_sig_sgrna', 'avg_log_fc'];
        $geneTable = 'gene_rankings';
        \DB::delete("delete from $geneTable");
        
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gene_rankings', function($table) {
            $table->dropColumn('avg_log_fc');
        });
    }
}
