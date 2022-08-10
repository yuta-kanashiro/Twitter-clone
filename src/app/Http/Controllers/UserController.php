<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\UseCase\Tweet\GetUserTweetUseCase;
use App\UseCase\User\IndexUseCase;
use App\UseCase\User\ShowUseCase;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
    * 全ユーザー情報の取得
    * 
    * @param  IndexUseCase $useCase
    * @return object
    */
    public function index(IndexUseCase $indexUseCase): object
    {
        return $indexUseCase->getUserList();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
