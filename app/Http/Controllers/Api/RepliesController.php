<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReplyResource;
use App\Models\Reply;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    //
    public function store($topicId,Reply $reply){
        $replies  = $reply->where('topic_id',$topicId)->paginate();
        return new ReplyResource($replies);
    }
    public function destroy(Reply $reply){

    }
}
