<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;

// class User extends Authenticatable implements MustVerifyEmailContract
class User extends Authenticatable
{
    // use MustVerifyEmailTrait;

    use  Notifiable{
        notify as protected laravelNotify;
    }

    public function notify($instance)
    {
        //如果要通知的人是当前用户,就不用通知
        // if ( $this->id === \Auth::id()){
        //     return;
        // }

        // if (method_exists($instance,'database')){
            $this->increment('notification_count');
        // }

        $this->laravelNotify($instance);

    }

    public function marKAsRead(){
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','introduction','avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     * 解决 db:seed 时间戳格式不正确的问题
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime:Y-m-d H:i:s',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function topic(){
        return $this->hasMany(Topic::class);
    }

    public function reply(){

        return $this->hasMany(Reply::class);
    }
    public function isAuthorOf($model){
       return $this->id == $model->user_id;
    }
    //我的粉丝 我可以被多人关注
    public function followers(){
        return $this->belongsToMany(User::class,'followers','user_id','follower_id');
    }
    //我的关注 我可以关注多人
    public function followings(){
        return $this->belongsToMany(User::class,'followers','follower_id','user_id');
    }

    //收藏
    public function favoriteTopics(){
        //默认情况下，这个中间表不包含时间戳。并且 Laravel 不会尝试自动填充 created_at/updated_at
        //但是如果你想自动保存时间戳，您需要在迁移文件中添加 created_at/updated_at，
        //然后在模型的关联/中加上 ->withTimestamps();
        return $this->belongsToMany(Topic::class,'user_favorite_topics')
            ->withTimestamps()->orderBy('user_favorite_topics.created_at','desc');
    }

}
