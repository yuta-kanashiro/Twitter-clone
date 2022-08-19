<?php

use App\Http\Controllers\FollowController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikeController;
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
    // ログインユーザー取得
    Route::get('/loginUser', [UserController::class, 'getLoginUser']);

    # ツイート関連のルーティング
    // タイムラインの取得
    Route::get('/timeLine', [TweetController::class, 'getTimeline']);
    // ツイート詳細取得
    Route::get('/tweet/{id}', [TweetController::class, 'show']);
    // ツイート投稿
    Route::post('/createTweet', [TweetController::class, 'store']);

    # フォロー関連のルーティング
    // フォロー判定
    Route::get('/isFollowing/{id}', [FollowController::class, 'isFollowing']);
    // フォローする
    Route::post('/follow/{id}', [FollowController::class, 'follow']);
    // フォローを外す
    Route::post('/unfollow/{id}', [FollowController::class, 'unfollow']);

    # いいね関連のルーティング
    // いいね判定
    Route::get('/isLike/{id}', [LikeController::class, 'isLike']);
    // いいねする
    Route::post('/like/{id}', [LikeController::class, 'like']);
    // いいねを外す
    Route::post('/unlike/{id}', [LikeController::class, 'unlike']);
});
