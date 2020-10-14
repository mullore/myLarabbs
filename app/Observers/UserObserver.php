<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    //
    public function saving(User $user){
        if(empty($user->avatar)){
            $user->avatar = "https://mullore.oss-cn-beijing.aliyuncs.com/2018-05-08.jpg";
        }
    }
}
