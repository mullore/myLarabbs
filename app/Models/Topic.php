<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = ['title','body','category_id','excerpt','slug'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function reply(){
        return $this->hasOne(Reply::class);
    }


    public function scopeWithOrder($query,$order){
        switch ($order){

            /*最新发布*/
            case 'recent':
                $query->recent();
                break;
            /*最后回复*/
            default:
                $query->recentReplied();
                break;

        }

    }
    /*最新发布*/
    public function scopeRecent($query)
    {
        return $query->orderBy('created_at','desc');
    }
    /*最后回复*/
    public function scopeRecentReplied($query){
        return $query->orderBy('updated_at','desc');
    }

    public function link($params =[]){
        return route('topics.show',array_merge([$this->id,$this->slug],$params));
    }

    /**/
    public function updateReplyCount(){
        $this->reply_count = $this->reply()->count();
        $this->save();
    }
}
