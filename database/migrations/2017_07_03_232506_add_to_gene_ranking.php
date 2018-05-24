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
