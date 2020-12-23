<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->integer('column_id');
            $table->foreign('column_id')->references('id')->on('columns')->onDelete('cascade'); //waits for projects
            $table->string('task_name', 30);
            $table->boolean('urgency')->nullable()->default(false);
            $table->string('description', 2046)->nullable();
            $table->date('start_date')->nullable();
            $table->date('finish_date')->nullable();
            $table->dateTime('finish_time')->nullable();
            $table->integer('responsible');//need to add users
            $table->integer('number_of_executors')->nullable();//need to add users, max value 6
            $table->string('attachment_1')->nullable();//need to add attachments
            $table->string('attachment_2')->nullable();//need to add attachments
            $table->string('attachment_3')->nullable();//need to add attachments
            $table->string('link')->nullable();//need to add links
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
