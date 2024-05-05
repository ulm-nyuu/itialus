<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaskAssign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_assignments', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('assigned_by')->unsigned()->index()->nullable();
            $table->foreign('assigned_by')->references('id')->on('users');

            $table->bigInteger('assigned_to')->unsigned()->index()->nullable();
            $table->foreign('assigned_to')->references('id')->on('users');

            $table->bigInteger('task_id')->unsigned()->index()->nullable();
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
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
        Schema::dropIfExists('task_assignments');
    }
}
