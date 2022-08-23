<?php

namespace App\UseCase\User;

use App\Models\User;
use Illuminate\Http\Request;
// use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

final class UpdateAction
{
    /**
    * ユーザー編集
    * 
    * @param Request $request
    */
    public function update(Request $request)
    {
        $loginUser = User::find(Auth::id());
        $updateData = $request->all();

        if($request->profile_image != null){
            $profileImagePath = $request->profile_image->store('public/profiles');
            $updateData['profile_image'] = Storage::url($profileImagePath);
        }

        $loginUser->fill($updateData)->save();
    }
}
