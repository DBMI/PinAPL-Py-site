<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneCombined extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gene_combined_rankings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dir',25);
            $table->string('file');
            $table->string('gene');
            // $table->float('repl_p_values');
            $table->float('fisher_statistic');
            $table->float('p_value_combined');
            $table->string('significant');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('gene_combined_rankings');
    }
}
