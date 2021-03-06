<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProducts extends Migration
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
            $table->string('sku');
            $table->string('asin')->nullable();
            $table->string('walmartSKU')->nullable();
            $table->string('walmartID')->nullable();
            $table->string('spec_sheet_path')->nullable();
            $table->string('image_path')->nullable();
            $table->string('name');
            $table->integer('optional_attributes')->nullable();
            $table->enum('factory', ['feishida','jilu']);
            $table->integer('inventory');
            $table->timestamps();
        });
        Schema::table('products', function (Blueprint $table) {
            $table->integer('category_id')->nullable()->unsigned()->after('id');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories');
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
        Schema::table('products', function (Blueprint $table) 
        {
            $table->dropForeign('products_category_id_foreign');
        });

        Schema::table('products', function (Blueprint $table) 
        {
            $table->dropColumn('category_id');
        });
    }
}
