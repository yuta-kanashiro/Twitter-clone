<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRequest;
use App\Models\User;
use App\UseCase\User\UpdateAction;
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
            'tweetLikes' => $user->likes()->with('user')->get(),
            'loginUserId' => Auth::id(),
            'countFollowings' => $user->countFollowings(),
            'countFollowers' => $user->countFollowers(),
            'countTweets' => $user->countTweets(),
            'countLikes' => $user->countLikes()
        ];
    }

    /**
    * ユーザー情報の編集
    * 
    * @param UpdateRequest $request
    * @param UpdateAction $useCase
    */
    public function update(UpdateRequest $request, UpdateAction $useCase)
    {
        $useCase->update($request);
    }

    /**
    * ログインユーザー情報の取得
    * 
    * @return User
    */
    public function getLoginUser(): User
    {
        return Auth::user();
    }
}
