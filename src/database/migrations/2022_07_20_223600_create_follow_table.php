<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follow', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('following_id')->comment('自分がフォローしている人');
            $table->unsignedInteger('follower_id')->comment('自分をフォローしている人');
            $table->timestamps();

            $table->foreign('following_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('follower_id')->references('id')->on('users')->onDelete('cascade');

            // 組み合わせのダブりを禁止
            // $table->unique(['following_id', 'follower_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follow');
    }
}
