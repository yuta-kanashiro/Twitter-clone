<?php

namespace App\Http\Controllers;

use App\UseCase\User\IndexUseCase;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
    * 全ユーザー情報の取得
    * 
    * @param  App\UseCase\User\IndexUseCase $useCase
    * @return object
    */
    public function index(IndexUseCase $useCase): object
    {
        return $useCase->getUserList();
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
