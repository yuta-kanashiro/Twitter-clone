<?php

namespace App\Http\Controllers;

use App\UseCase\User\Index;
use Illuminate\Support\Collection;

class UserController extends Controller
{
    /**
    * 全ユーザー情報の取得
    * 
    * @param  Index $useCase
    * @return object
    */
    public function index(Index $useCase): Collection
    {
        return $useCase->getAllUsers();
    }
}
