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
            $table->decimal("totalAmount",15,3)->default(0.000);
            $table->string("payment",150);
            $table->text("note")->nullable();
            $table->boolean("invoice")->default(0);
            $table->boolean("statusTransaction")->default(1);

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
