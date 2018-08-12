<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->enum('type', ['bug','feature']);
            $table->enum('status', ['created', 'assigned', 'progress', 'review', 'test', 'done']);
            $table->date('deadline');
            $table->integer('task_id')->comment('Parent');
            $table->integer('project_id');
            $table->integer('user_id')->comment('Creator');
            $table->integer('assigned_user_id')->comment('Performer');
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
        Schema::dropIfExists('tasks');
    }
}
