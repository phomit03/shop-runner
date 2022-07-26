<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->increments("idTransaction");
            $table->integer("idCustomer")->unsigned();
            $table->unsignedTinyInteger("statusTransaction")->default(0);
            $table->decimal("totalAmount",15,4)->default(0.0000);
            $table->string("payment",150);
            $table->text("paymentInfo");
            $table->text("note")->nullable();
            $table->unsignedTinyInteger("invoice")->default(0);

            $table->timestamps();
            //Tao khoa ngoai
            $table->foreign('idCustomer')->references('idCustomer')->on('customer');
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
