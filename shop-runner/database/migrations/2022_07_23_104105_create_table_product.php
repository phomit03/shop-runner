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
        Schema::create('product', function (Blueprint $table) {
            $table->id("idProduct");
            $table->integer("idCatalog",11);
            $table->string("nameProduct",150);
            $table->decimal("priceProduct",15.4);
            $table->text("contentProduct");
            $table->integer("discountProduct",11);
            $table->string("imageProduct",150);
            $table->string("imageList",150);
            $table->timestamps();

            //Tao khoa ngoai
            $table->foreign('idCatalog')->references('idCatalog')->on('catalog');
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
