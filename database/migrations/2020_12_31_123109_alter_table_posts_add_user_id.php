<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTablePostsAddUserId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // php artisan make:migration alter_table_posts_add_user_id --table=posts
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->integer('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
