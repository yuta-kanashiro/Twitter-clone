<?php

namespace App\Http\Controllers;

use App\UseCase\User\IndexAction;
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
}
