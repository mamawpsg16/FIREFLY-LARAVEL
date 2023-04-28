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
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->boolean('is_published')->default(0);
            $table->timestamps();
            /** equal to $table->foreignId('user_id')->constrained(); */
            // $table->foreign('user_id')->references('id')->on('users');
            // $table->unsignedBigInteger('user_id');

            // $table->foreignId('user_id')->constrained(
            //     table: 'users', indexName: 'posts_user_id'
            // );
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
