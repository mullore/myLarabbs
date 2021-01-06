<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //某个用户的信息
    public function show(User $user,Request $request){
        return new UserResource($user);
    }
    //登录用户的信息
    public function me(Request $request){
        return new UserResource($request->user());
    }
    //更新
    public function  update(UserRequest $request){

        $user = $request->user();
        $user->update($request->all());
        return response(null,204);
    }

}
