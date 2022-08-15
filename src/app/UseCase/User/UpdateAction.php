<?php

namespace App\UseCase\User;

use App\Models\User;
// use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

final class UpdateAction
{
    /**
    * ユーザー編集
    * 
    * @return 
    */
    public function update($request)
    {
        // ログイン中のユーザの情報を取得し、$loginUserに代入
        $loginUser = User::find(Auth::id());
        // 全てのリクエストデータを受け取り、データベースへ保存
        return $loginUser->fill($request->all())->save();
    }
}
