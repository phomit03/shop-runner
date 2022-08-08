<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('product');
        Schema::create('product', function (Blueprint $table) {
            $table->increments("idProduct");
            $table->string("nameProduct",255);
            $table->decimal("priceProduct", 15,3)->default(0.000);
            $table->longText("contentProduct")->nullable();
            $table->unsignedInteger("discountProduct")->nullable();
            $table->decimal("price_total",15,3)->default(0.000);
            $table->string("imageProduct",150);
            $table->string("imageList",150)->nullable();
            $table->integer("idCatalog")->unsigned();
            $table->timestamps();

            //Tao khoa ngoai
            $table->foreign("idCatalog")->references("idCatalog")->on('catalog');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
