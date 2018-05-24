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
