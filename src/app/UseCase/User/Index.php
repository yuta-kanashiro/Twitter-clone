<?php

namespace App\UseCase\User;

use App\Models\User;
use Collator;
use Illuminate\Support\Collection;

final class Index
{
    /**
    * 全ユーザー情報の取得
    * 
    * @return Collection
    */
    public function getAllUsers(): Collection
    {
        $users = User::orderBy('created_at', 'desc')->get();

        return $users;
    }
}
