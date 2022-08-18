<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRequest;
use App\Models\User;
use App\UseCase\User\UpdateAction;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
    * 
    * 
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
        $loginUserId = Auth::id();
        $user = $this->user->getUserInfo($id);

        return [
            'loginUserId' => $loginUserId,
            'user' => $user
        ];
    }

    /**
    * ユーザー情報の編集
    * 
    *
    */
    public function update(UpdateRequest $request, UpdateAction $useCase)
    {
        Log::info($request);
        return $useCase->update($request);
    }

    /**
    * ログインユーザー情報の取得
    * 
    *
    */
    public function getLoginUser(): object
    {
        return Auth::user();
    }
}
