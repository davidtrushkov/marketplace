<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_file', function (Blueprint $table) {
            $table->increments('id');
	        $table->integer('category_id')->unsigned();
	        $table->integer('file_id')->unsigned();
	        $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
	        $table->foreign('file_id')->references('id')->on('files')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('category_file');
    }
}
