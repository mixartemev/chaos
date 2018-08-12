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
            $table->enum('sla', ['small', 'middle', 'long'])->nullable(); // must be set on assign
            $table->enum('status', ['created', 'assigned', 'progress', 'review', 'test', 'done'])
                ->default('created');
            $table->date('deadline')->nullable(); // must be set on progress
            $table->unsignedInteger('task_id')->nullable()->comment('Parent');
            $table->unsignedSmallInteger('project_id');
            $table->unsignedTinyInteger('user_id')->comment('Creator');
            $table->unsignedTinyInteger('assigned_user_id')->nullable()->comment('Performer'); // set on assign
            $table->timestamps();

            $table->index(['user_id','project_id','task_id','assigned_user_id']);
            $table->foreign('project_id')->references('id')->on('projects')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('task_id')->references('id')->on('tasks')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('assigned_user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
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
