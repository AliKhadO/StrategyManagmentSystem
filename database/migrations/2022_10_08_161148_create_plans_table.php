<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->smallInteger('status')->default(0);
            $table->smallInteger('notification_status')->default(0); //  1-> notify , 2-> read // no need 0
            $table->smallInteger('type')->default(0);
            $table->date('timeframe_start_date');
            $table->date('timeframe_end_date');
            $table->date('actual_end_date')->nullable();
            $table->unsignedBigInteger('assigned_to_id')->nullable();
            $table->unsignedBigInteger('created_by_id');
            $table->unsignedBigInteger('goal_id');
            //FKs
            $table->foreign('goal_id')->references('id')->on('goals')->onDelete('cascade');//parent goal
            $table->foreign('assigned_to_id')->references('id')->on('users')->onDelete('cascade');//assign to supervisor(team leader)
            $table->foreign('created_by_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('plans');
    }
};
