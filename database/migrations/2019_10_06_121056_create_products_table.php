<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->string('product_name');
            $table->string('product_code');
            $table->string('product_color');
            $table->text('description')->nullable();
            $table->text('care')->nullable();
            $table->float('price');
            $table->tinyInteger('status')->default('1');
            $table->tinyInteger('feature_item')->default('0');;
            $table->string('image')->nullable();
            table->string('video')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
