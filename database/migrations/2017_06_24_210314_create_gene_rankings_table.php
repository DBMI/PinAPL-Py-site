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
