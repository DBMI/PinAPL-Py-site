<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRunLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('run_logs', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('hash');
            $table->string('name', 100);
            $table->string('email',100)->nullable();
            $table->string('status',25);
            $table->unsignedBigInteger('input_size')->nullable();
            $table->unsignedBigInteger('output_size')->nullable();
            /* Store output via tree. -J outputs in json, which I don't think we need, but could make any coding easier
                --du sumarizes folder size by content
                -h shows size in human readable format
                
                tree -h --du -J storage/runs/example-run/
             */
            $table->text('input_files')->nullable();
            $table->text('output_files')->nullable();  

            $table->string('final_status')->nullable();
            $table->string('creation_method');
            
            $table->unsignedInteger('upload_view_count');
            $table->unsignedInteger('files_view_count');
            $table->unsignedInteger('parameters_view_count');
            $table->unsignedInteger('running_view_count');
            $table->unsignedInteger('results_view_count');

            $table->timestamps();
            $table->timestamp('uploaded_at')->nullable();
            $table->timestamp('configured_files_at')->nullable();
            $table->timestamp('started_run_at')->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
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
