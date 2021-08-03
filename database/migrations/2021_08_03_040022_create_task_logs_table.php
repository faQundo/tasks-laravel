<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('task_id');
            $table->foreignId('log_id');

            $table->foreign('task_id', 'resource_favorites_task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->foreign('log_id', 'resource_favorites_log_id')->references('id')->on('logs')->onDelete('cascade');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_logs');
    }
}
