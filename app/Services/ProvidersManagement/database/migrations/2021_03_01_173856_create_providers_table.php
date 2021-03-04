<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('cif', 9)->unique();
            $table->timestamps();
        });

        Schema::create('product_providers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prod_id')->constrained('products');
            $table->foreignId('prov_id')->constrained('providers');
            $table->timestamps();
            $table->unique([
                'prod_id',
                'prov_id'
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
        Schema::dropIfExists('providers');
    }
}
