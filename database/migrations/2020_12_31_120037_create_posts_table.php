<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // php artisan make:migration create_posts_table


    // posts
    //     id
    //     title
    //     description
    //     content
    //     status
    //     category_id
    //     created_at
    //     updated_at

    // categories
    //     id
    //     name
    //     description

    // tags
    //     id
    //     name

    // post_tag
    //     id
    //     post_id
    //     tag_id

    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('category_id')->nullable();
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
