<?php

namespace App\Http\Controllers;

use App\UseCase\Tweet\GetUserTweetUseCase;
use App\UseCase\User\IndexAction;
use App\UseCase\User\ShowUseCase;
use Illuminate\Support\Collection;

class UserController extends Controller
{
    /**
    * 全ユーザー情報の取得
    * 
    * @param  IndexAction $useCase
    * @return Collection
    */
    public function index(IndexAction $useCase): Collection
    {
        return $useCase->getAllUsers();
    }

    /**
     * あるユーザーの情報の取得
     *
     * 
     * @param ShowUseCase $useCase
     * @param  int  $id
     * @return array
     */
    public function show(ShowUseCase $showUseCase, GetUserTweetUseCase $getUserTweetUseCase, int $id)
    {
        $user = $showUseCase->show($id);
        $tweets = $getUserTweetUseCase->show($id);

        return [
            'user' => $user,
            'tweets' => $tweets
        ];
    }
}
