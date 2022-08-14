<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
    * 全ユーザー情報の取得
    * 
    * @param  User $user
    * @return Collection
    */
    public function index(User $user): Collection
    {
        return $user->getAllUsers();
    }

    /**
     * あるユーザーの情報の取得
     *
     * @param User $user
     * @param  int  $id
    //  * @return object
     */
    public function show(User $user, int $id): array
    {
        $loginUserId = Auth::id();
        $user = $user->getUserInfo($id);

        return [
            'loginUserId' => $loginUserId,
            'user' => $user
        ];
    }
}
