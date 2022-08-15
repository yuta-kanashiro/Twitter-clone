<?php

namespace App\Http\Controllers;

use App\Models\User;

class FollowController extends Controller
{
    /**
    * フォロー済みかチェック
    *
    * @param  int $id
    * @return bool
    */
    public function followCheck(int $id): bool
    {
        $loginUser = User::find(auth()->id());
        return $loginUser->followCheck($id);
    }

    /**
    * フォローする
    * 
    * @param  int $id
    */
    public function follow(int $id)
    {
        // ログイン中のユーザー
        $loginUser = User::find(auth()->id());
        // フォロー対象のユーザーID
        $followUserId = $id;

        // すでにフォロー済みではないか？
        $existing = $loginUser->followCheck($followUserId);
        // フォローする相手がユーザ自身ではないか？
        $myself = $loginUser->id === $followUserId;

        // フォロー済みではない、かつフォロー相手がユーザ自身ではない場合、フォロー
        if (!$existing && !$myself){
            $loginUser->follow($followUserId);
        }
    }

    /**
    * フォローを外す
    * 
    * @param  int $id
    */
    public function unfollow(int $id)
    {
        // ログイン中のユーザー
        $loginUser = User::find(auth()->id());
        // フォロー対象のユーザーID
        $followUserId = $id;

        // すでにフォロー済みではないか？
        $existing = $loginUser->followCheck($followUserId);
        // フォローする相手がユーザ自身ではないか？
        $myself = $loginUser->id === $followUserId;

        // すでにフォロー済み、かつフォロー相手がユーザ自身ではない場合、フォローを外す
        if ($existing && !$myself){
            $loginUser->unfollow($followUserId);
        }
    }
}
