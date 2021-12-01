<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_descriptions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('product_id');
            
            $table->unsignedBigInteger('sale_id');

            $table->double('price');
            
            $table->double('subtotal');
            
            $table->bigInteger('quantity');

            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');

            $table->foreign('sale_id')->references('id')->on('sales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_descriptions');
    }
}
