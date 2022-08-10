<?php

namespace App\Http\Controllers;

use App\UseCase\User\IndexUseCase;
use Illuminate\Support\Collection;

class UserController extends Controller
{
    /**
    * 全ユーザー情報の取得
    * 
    * @param  IndexUseCase $useCase
    * @return object
    */
    public function index(IndexUseCase $useCase): Collection
    {
        return $useCase->getAllUsers();
    }
}
