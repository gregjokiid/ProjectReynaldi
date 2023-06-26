<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->foreignId('categories_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug');
            $table->string('thumbnails');
            $table->string('thumbnails2')->nullable();
            $table->string('thumbnails3')->nullable();
            $table->string('thumbnails4')->nullable();
            $table->string('thumbnails5')->nullable();
            $table->string('price');
            $table->string('weight');
            $table->string('stock');
            $table->text('description');
            $table->softDeletes();
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
