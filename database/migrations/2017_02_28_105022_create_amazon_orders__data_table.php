<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmazonOrdersDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amazon_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('amazonOrderId')->unique();;
            $table->string('buyerName');
            $table->string('email');
            $table->string('purchaseDate');
            $table->string('orderStatus');
            $table->string('totalAmount');
            $table->string('paymentMethod');
            $table->string('shippingAddress');
            $table->string('marketID');
            $table->string('orderType');
            $table->string('itemSku');
            $table->string('productTitle');
            $table->string('ASIN');
            $table->integer('QuantityOrdered');
            $table->integer('QuantityShipped');
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
        //
    }
}
