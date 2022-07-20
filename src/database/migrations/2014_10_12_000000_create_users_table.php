<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_name')->index()->comment('アカウント名');
            $table->string('user_name')->index()->comment('@ユーザーネーム');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('introduction')->nullable()->comment('自己紹介');
            $table->string('profile_image')->nullable()->comment('プロフィール画像');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
