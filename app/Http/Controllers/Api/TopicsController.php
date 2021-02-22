<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TopicRequest;
use App\Http\Resources\TopicCollection;
use App\Http\Resources\TopicResource;
use App\Models\Topic;
use App\Policies\TopicPolicy;
use App\Observers\TopicObserver;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;

class TopicsController extends Controller
{
    //话题列表
    public function index(Request $request,Topic $topic){
        $query= $topic->newQuery();
        if($categoryId = $request->category_id)
        {
            $query->where('category_id',$categoryId);
        }
        $topics = $query->paginate();

        return new TopicResource($topics);

    }

    //执行创建
    public function store(TopicRequest $request,Topic $topic){
        $topic->fill($request->all());
        $topic->user_id = $request->user()->id;
        $topic->save();
        return new TopicResource($topic);

    }
    //话题详情
    public function show(Topic $topic){
        return new TopicResource($topic);
    }
    //更新
    public function update(TopicRequest $request,Topic $topic){
        $this->authorize('update',$topic);
        $topic->update($request->all());
        return new TopicResource($topic);
    }
    //删除
    public function destroy(Topic $topic){
        $this->authorize('destroy',$topic);
        $topic->delete();
        return response(null,204);
    }
}
