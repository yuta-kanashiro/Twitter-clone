<?php

namespace App\UseCase\User;

use App\Models\User;

final class ShowUserListUseCase
{

    public function getUserList(): object
    {
        $users = User::orderBy('created_at', 'desc')->get();

        return $users;
    }
}
