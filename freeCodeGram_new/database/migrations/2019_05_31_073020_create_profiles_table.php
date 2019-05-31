<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            #リレーション（unsignedBigInterger）
            $table->unsignedBigInteger('user_id'); //user_id: userはUserテーブル idはidを自動的に読み込む
            
            $table->string('title')->nullable();    //->nullable()は入力してもしなくても良い設定
            $table->text('description')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();
            
            $table->index('user_id'); // DBリレーションを早く読み込むメソッド
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
