<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_service', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('job_id')->unsigned()->nullable();
            $table->foreign('job_id')->references('id')
                ->on('jobs')->onUpdate('cascade')->onDelete('set null');

            $table->unsignedBigInteger('service_id')->unsigned()->nullable();
            $table->foreign('service_id')->references('id')
                ->on('services')->onUpdate('cascade')->onDelete('set null');

            $table->integer('quantity')->unsigned();

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
        Schema::dropIfExists('order_service');
    }
}
