<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeRuns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('runs', function (Blueprint $table) {
            $table->string('email', 100)->nullable()->change();
            $table->string('data_dir');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('runs', function (Blueprint $table) {
            $table->string('email', 100)->required()->change();
            $table->dropColumn('data_dir');
        });
    }
}
