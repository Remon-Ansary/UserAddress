<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('userName');
            $table->string('userEmail');
            $table->string('userPhone');
            $table->string('presentDivision');
            $table->string('presentDistrict');
            $table->string('presentThana');
            $table->string('permanentDivision');
            $table->string('permanentDistrict');
            $table->string('permanentThana');
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
        Schema::dropIfExists('posts');
    }
}