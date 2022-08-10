<?php

namespace App\UseCase\User;

use App\Models\User;

final class IndexUseCase
{
    /**
    * 全ユーザー情報の取得
    * 
    * @return object
    */
    public function getAllUsers(): object
    {
        $users = User::orderBy('created_at', 'desc')->get();

        return $users;
    }
}
