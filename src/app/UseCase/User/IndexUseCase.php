<?php

namespace App\UseCase\User;

use App\Models\User;
use Collator;
use Illuminate\Support\Collection;

final class IndexUseCase
{
    /**
    * 全ユーザー情報の取得
    * 
    * @return object
    */
    public function getAllUsers(): Collection
    {
        $users = User::orderBy('created_at', 'desc')->get();

        return $users;
    }
}
