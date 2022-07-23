<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOrderDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order-detail', function (Blueprint $table) {
            $table->id("idOrderDetail");
            $table->integer("idProduct", 11);
            $table->integer("priceProduct", 11);
            $table->integer("quantity", 10);
            $table->decimal("priceDiscount", 15.4);
            $table->decimal("amountDiscount", 15.4);
            $table->integer("idOrder", 11);
            $table->timestamps();
            //Tao khoa ngoai
            $table->foreign('idProduct')->references('idProduct')->on('product');
            $table->foreign('idOrder')->references('idOrder')->on('order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order-detail');
    }
}
