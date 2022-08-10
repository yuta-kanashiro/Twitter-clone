<?php

namespace App\UseCase\User;

use App\Models\User;

final class ShowUseCase
{
    /**
    * あるユーザー情報の取得
    *
    * @param int $id
    * @return object
    */
    public function show(int $id)
    {
        // 引数の$idと一致するユーザーIDを持つユーザーを取得
        $user = User::find($id);

        return $user;
    }
}
