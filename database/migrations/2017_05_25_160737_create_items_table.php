<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_item_id');
            $table->integer('brand_id')->nullable();
            $table->integer('series_id')->nullable();
            $table->integer('spring_id')->nullable();
            $table->integer('height_id')->nullable();
            $table->integer('weight_id')->nullable();
            $table->string('name');
            $table->text('text')->nullable();
            $table->string('image')->nullable();
            $table->integer('published')->default('1');
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
        Schema::dropIfExists('items');
    }
}
