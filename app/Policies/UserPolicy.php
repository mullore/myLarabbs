<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    /*
     * 第一个参数默认获取当前登录用户实例*/
    public function update(User $currentUser,User $user){
        return $currentUser->id === $user->id;
    }
}
