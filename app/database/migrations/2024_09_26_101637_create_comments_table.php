<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('comments', function (Blueprint $table) {
        $table->bigIncrements('id');
 // ID
        $table->unsignedBigInteger('user_id'); // ユーザーID
        $table->unsignedBigInteger('post_id'); // 投稿ID
        $table->string('text', 500); // コメント内容
        $table->unsignedBigInteger('comment_id')->nullable(); // コメントID（コメントへのコメント用）
        $table->timestamps(); // created_at, updated_at
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
