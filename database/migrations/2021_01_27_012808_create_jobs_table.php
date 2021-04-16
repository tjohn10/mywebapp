<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('job_category');
            $table->longText('description');
            $table->unsignedBigInteger('user_id')->unsigned()->nullable();


            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->string('billing_mail');
            $table->string('billing_name');
            $table->string('billing_address');
            $table->string('billing_city');
            $table->string('billing_country');
            $table->string('billing_postalcode');
            $table->string('billing_phone');
            $table->string('billing_name_on_card');
            $table->string('billing_subtotal');
            $table->string('billing_discount');
            $table->string('billing_total');
            $table->string('payment_gateway')->default('paypal');
            $table->boolean('confirmed')->default(false);
            $table->string('error')->nullable();

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
        Schema::dropIfExists('jobs');
    }
}
