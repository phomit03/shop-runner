<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments("idOrder");
            $table->integer("idProduct")->unsigned();
            $table->unsignedInteger("quantity")->default(0);
            $table->decimal("amount",15,3)->default(0.000);
            $table->integer("idTransaction")->unsigned();
            $table->boolean("statusOrder")->default(1);
            $table->timestamps();
            //Tao khoa ngoai
            $table->foreign('idProduct')->references('idProduct')->on('product');
            $table->foreign('idTransaction')->references('idTransaction')->on('transaction');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
