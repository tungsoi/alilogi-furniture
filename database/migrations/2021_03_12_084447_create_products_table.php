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
            $table->integer('category_id')->nullable()->comment('id danh muc');
            $table->string('code')->nullable()->comment('ma san pham');
            $table->text('name')->nullable()->comment('ten san pham');
            $table->text('weight')->nullable()->comment('can nang');
            $table->text('height')->nullable()->comment('chieu cao');
            $table->text('length')->nullable()->comment('chieu dai');
            $table->text('width')->nullable()->comment('chieu rong');
            $table->text('description')->nullable()->comment('mo ta san pham');
            $table->text('color')->nullable()->comment('mau sac');
            $table->text('material')->nullable()->comment('vat lieu san pham');
            $table->text('avatar')->nullable()->comment('anh dai dien');
            $table->longText('images')->nullable()->comment('anh chi tiet');
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
