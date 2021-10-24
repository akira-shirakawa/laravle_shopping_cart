<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('item_id');
            $table->integer('amount');
            $table->bigInteger('cart_id')->nullable()->unsigned();
            $table->integer('user_id');
            $table->integer('price')->nullable();
            $table->timestamps();

            $table->foreign('cart_id')
            ->references('id')
            ->on('carts')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
