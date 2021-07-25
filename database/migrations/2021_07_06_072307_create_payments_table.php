<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use saeid\Payment\Model\Payment;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buyer_id');//user
            $table->bigInteger('seller_id')->nullable();
            $table->foreignId('paymentable_id');//payment
            $table->string('paymentable_type');//course
            $table->string('amount',10);
            $table->string('invoice_id');
            $table->string('gateway');
            $table->enum('status',Payment::$statuses);
            $table->tinyInteger('seller_p')->unsigned();
            $table->string('seller_share',10);
            $table->string('site_share',10);
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
        Schema::dropIfExists('payments');
    }
}
