<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\Image;
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

        // $user = $request->user();
        // $user->update($request->all());
        // return response(null,204);
        $user = $request->user();

        $attributes = $request->only(['name', 'email', 'introduction']);

        if ($request->avatar_image_id) {
            $image = Image::query()->find($request->avatar_image_id);

            $attributes['avatar'] = $image->path;
        }

        $user->update($attributes);

        return new UserResource($user);
    }
    /*创建用户*/
    public function store(){

    }

}
