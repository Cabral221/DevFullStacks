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
            $table->string('title');
            $table->text('introduce');
            $table->string('image');
            $table->longtext('body');
            $table->string('slug')->unique();
            $table->integer('category_id')->unsigned()->index();
            $table->bigInteger('admin_id')->unsigned()->index();
            $table->timestamps();
        });

        Schema::table('posts', function($table){
            $table->foreign('admin_id')->references('id')->on('admins');
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
