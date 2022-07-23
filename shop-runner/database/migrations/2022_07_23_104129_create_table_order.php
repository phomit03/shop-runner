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
            $table->id("idOrder");
            $table->integer("idUser",11);
            $table->decimal("totalAmount",15.4);
            $table->integer("invoice",2);
            $table->integer("statusOrder",2)->default(0);
            $table->timestamps();
            //Tao khoa ngoai
            $table->foreign('idUser')->references('idUser')->on('user');
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
