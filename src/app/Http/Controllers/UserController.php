<?php

namespace App\Http\Controllers;

use App\UseCase\User\IndexUseCase;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
    * 全ユーザー情報の取得
    * 
    * @param  IndexUseCase $useCase
    * @return object
    */
    public function index(IndexUseCase $useCase): object
    {
        return $useCase->getUserList();
    }
}
