<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReplyRequest;

class RepliesController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }


    public function store(ReplyRequest $request,Reply $reply)
    {
        $reply->content = $request->input('content');
        $reply->user_id = \Auth::id();
        $reply->topic_id = $request->input('topic_id');
        $reply->save();
        return redirect()->route('topics.show',$reply->topic_id )->with('success', '帖子创建成功');
    }


    public function destroy(Reply $reply)
    {
        $this->authorize('destroy', $reply);
        $reply->delete();

        return redirect()->route('topics.show',$reply->topic_id)->with('success', '帖子删除成功');
    }
	// public function index()
	// {
	// 	$replies = Reply::paginate();
	// 	return view('replies.index', compact('replies'));
	// }
    //
    // public function show(Reply $reply)
    // {
    //     return view('replies.show', compact('reply'));
    // }
    //
	// public function create(Reply $reply)
	// {
	// 	return view('replies.create_and_edit', compact('reply'));
	// }
    // public function update(ReplyRequest $request, Reply $reply)
    // {
    //     $this->authorize('update', $reply);
    //     $reply->update($request->all());
    //
    //     return redirect()->route('replies.show', $reply->id)->with('message', 'Updated successfully.');
    // }
    // public function edit(Reply $reply)
    // {
    //     $this->authorize('update', $reply);
    //     return view('replies.create_and_edit', compact('reply'));
    // }


}
