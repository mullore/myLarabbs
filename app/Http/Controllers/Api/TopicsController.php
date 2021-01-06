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
    //
    public function index(){

        return TopicResource::collection(Topic::all());

    }

    //执行创建
    public function store(Topic $topic,TopicRequest $request){
        $topic->fill($request->all());
        $topic->user_id = $request->user()->id;
        $topic->save();
        return response(null,204);

    }
    public function show(Topic $topic){
        return new TopicResource($topic);
    }
    public function update(Topic $topic,TopicRequest $request){
        $this->authorize('update',$topic);
        $topic->update($request->all());
        return new TopicResource($topic);
    }

    public function destroy(Topic $topic){
        $this->authorize('destroy',$topic);
        $topic->delete();
        return response(null,204);
    }
}
