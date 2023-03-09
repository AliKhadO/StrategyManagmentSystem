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
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->smallInteger('status')->default(0);
            $table->smallInteger('type')->default(0); // favorite
            $table->smallInteger('notification_status')->default(0); //  1-> notify , 2-> read // no need 0
            $table->date('timeframe_start_date');
            $table->date('timeframe_end_date');
            $table->date('actual_end_date')->nullable();
            $table->unsignedBigInteger('created_by_id');
            $table->unsignedBigInteger('department_id')->nullable();


            //FKS
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('created_by_id')->references('id')->on('users')->onDelete('cascade');//created by team leader and assigned to user
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
        Schema::dropIfExists('goals');
    }
};
