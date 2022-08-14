<?php

use App\Http\Controllers\FollowController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth')->group(function () {
    # ユーザー関連のルーティング
    // ユーザー一覧取得
    Route::get('/usersList', [UserController::class, 'index']);
    // ユーザー詳細取得
    Route::get('/userProfile/{id}', [UserController::class, 'show']);

    # フォロー関連のルーティング
    // フォローチェック
    Route::get('/followCheck/{id}', [FollowController::class, 'followCheck']);
    // フォローする
    Route::get('/follow/{id}', [FollowController::class, 'follow']);
    // フォローを外す
    Route::get('/unfollow/{id}', [FollowController::class, 'unfollow']);

    # ツイート関連のルーティング
    // ツイート詳細取得
    Route::get('/tweet/{id}', [TweetController::class, 'show']);
});
