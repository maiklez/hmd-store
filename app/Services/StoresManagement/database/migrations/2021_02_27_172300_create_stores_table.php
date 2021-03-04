<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->text('address');
            $table->string('url')->unique();
            $table->timestamps();
        });

        Schema::create('product_stores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prod_id')->constrained('products');
            $table->foreignId('store_id')->constrained('stores');
            $table->timestamps();
            $table->unique([
                'prod_id',
                'store_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_stores');
        Schema::dropIfExists('stores');
    }
}
