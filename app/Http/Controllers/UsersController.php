<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\UserRequest;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except' => ['show']]);
    }

    //
    public function show(User $user){

        return view('users.show',compact('user'));

    }
    public function update(UserRequest $request,User $user,ImageUploadHandler $handler){
        $this->authorize('update',$user);
        $data = $request->except('avatar');

        if($request->file('avatar')){
            $result = $handler->save($request->file('avatar'),'avatars',$user->id,416);
            if($result){
                $data['avatar'] = $result['path'];
            }else
            {
                return redirect()->withErrors(['图片上传失败']);
            }

        }
        $user->update($data);
        return redirect()->route('users.show',$user->id)->with('success','个人资料更新成功！');



    }
    public function edit(User $user){
        $this->authorize('update',$user);
        return view('users.edit',compact('user'));

    }
}
