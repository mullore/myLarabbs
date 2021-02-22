<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ReplyRequest;
use App\Http\Resources\ReplyResource;
use App\Models\Reply;
use App\Models\Topic;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    //回复列表
    public function index($topicId,Reply $reply){
        $replies  = $reply->query()->where('topic_id',$topicId)->paginate();
        return new ReplyResource($replies);
    }
    //用户回复
    public function userIndex($userId,Reply $reply){
        $replies  = $reply->query()->where('topic_id',$userId)->paginate();
        return new ReplyResource($replies);
    }
    //创建回复
    public function store(ReplyRequest $request,Topic $topic,Reply $reply){
        $reply->content =$request->input('content');
        // $reply->topic()->associate($topic);
        $reply->topic_id = $topic->id;
        //等于：$reply->topic_id = $topic
        // $reply->user()->associate($reply->user());
        $reply->user_id = $request->user()->id;
        $reply->save();

        return new ReplyResource($reply);

    }
    //删除回复
    public function destroy(Reply $reply,Topic $topic){
        if($reply->topic_id != $topic->id){
            abort(404);
        }
        $this->authorize('destroy',$reply);
        $reply->delete();
        return response(null,204);

    }


}
