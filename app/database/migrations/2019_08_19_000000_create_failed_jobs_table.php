<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFailedJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->text('connection'); // キュー接続
            $table->text('queue'); // キュー名
            $table->longText('payload'); // ジョブデータ（ペイロード）
            $table->longText('exception'); // 失敗時の例外メッセージ
            $table->timestamp('failed_at')->useCurrent(); // 失敗した日時
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('failed_jobs');
    }
}
