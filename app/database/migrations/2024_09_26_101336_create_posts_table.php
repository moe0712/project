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
            $table->bigIncrements('id'); // ID
            $table->unsignedBigInteger('user_id'); // ユーザーID
            $table->string('title', 30); // タイトル
            $table->date('date'); // 訪問日
            $table->string('image', 200)->nullable(); // 投稿画像
            $table->text('episode')->nullable(); // エピソード
            $table->boolean('del_flag')->default(false); // 投稿論理削除
            $table->timestamps(); // created_at, updated_at

            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
