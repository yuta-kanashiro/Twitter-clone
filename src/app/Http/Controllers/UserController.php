<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
    * @param  User $user
    */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
    * 全ユーザー情報の取得
    * 
    * @return Collection
    */
    public function index(): Collection
    {
        return $this->user->getAllUsers();
    }

    /**
     * あるユーザーの情報の取得
     *
     * @param  int  $id
     * @return array
     */
    public function show(int $id): array
    {
        $user = $this->user->getUserInfo($id);

        return [
            'user' => $user,
            'loginUserId' => Auth::id(),
            'countFollowing' => $user->countFollowings(),
            'countFollower' => $user->countFollowers()
        ];
    }
}
