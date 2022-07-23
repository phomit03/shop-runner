<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOrderTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->id("idTransaction");
            $table->integer("statusTransaction",2)->default(0);
            $table->decimal("amountTransaction",15.4);
            $table->string("payment",150);
            $table->text("paymentInfo");
            $table->text("message");
            $table->integer("idUser",11);
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
        Schema::dropIfExists('transaction');
    }
}
