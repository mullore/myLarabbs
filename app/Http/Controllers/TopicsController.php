<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Models\Category;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index(Request $request)
	{

		$topics = Topic::with('user','category')
            ->withOrder($request->order)
            ->paginate(30);
		return view('topics.index', compact('topics'));
	}

    public function show(Topic $topic,Request $request)
    {
        $favored =false;
        $followed=false;
        $user = $request->user();
        if ($user){
            $favored =boolval($user->favoriteTopics->contains($topic->id));
            $followed  = boolval($user->followings->contains($topic->user_id));
        }

        return view('topics.show', compact('topic','favored','followed'));
    }
    /*创建页面*/
	public function create(Topic $topic)
	{
	    $categories = Category::all();
		return view('topics.create_and_edit', compact('topic','categories'));
	}
    /*执行创建*/
	public function store(TopicRequest $request,Topic $topic)
	{
		// $topic = Topic::create($request->all());
        $topic->fill($request->all());
        $topic->user_id = \Auth::id();
        $topic->save();
		return redirect()->to($topic->link())->with('success', '帖子创建成功！');
	}
    //编辑
	public function edit(Topic $topic)
	{
        $this->authorize('update', $topic);
        $categories = Category::all();
		return view('topics.create_and_edit', compact('topic','categories'));
	}
    /*更新*/
	public function update(TopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);
		$topic->update($request->all());

		return redirect()->to($topic->link())->with('success', '帖子更新成功！');
	}
    /*删除文章*/
	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect()->route('topics.index')->with('success', '帖子删除成功！');
	}
	/*simditor处理图片*/
	public function uploadImage(Request $request,ImageUploadHandler $handler){
        /*初始化返回数据，默认失败*/
        $data = [
            'success'=>false,
            'msg'=>'上传失败',
            'file_path' => ''
        ];
        if($file = $request->upload_file){
            $result = $handler->save($file,'topics',\Auth::id(),1024);
            if($result){
                $data['success'] = true;
                $data['msg']= '上传成功';
                $data['file_path']=$result['path'];
            }
        }
        return $data;
    }

    /*关注*/
    public function follow(Topic $topic,Request $request){
        // contains 方法是 Collection 类的一个方法，
        //$this->followings 返回的是一个 Collection 类的实例，也就是一个集合，
        //但是 $this->followings() 返回的是一个 Relations(查询语句)，没有 contains 方法，所以不能加括号。
        if ($request->user()->followings->contains($topic))
        {
            return [];
        }
        \Auth::user()->followings()->attach($topic);
    }
    /*取消关注*/
    public function unFollow(Topic $topic){
        \Auth::user()->followings()->detach($topic);
    }
    /*关注列表*/
    public function followers(Topic $topic){
        $followers =  \Auth::user()->followings()->paginate(15);
        return view('topics.show',['followers'=> $followers]);
    }
    /*收藏*/
    public function favorite(Topic $topic,Request $request){

        $user = $request->user();
        if($user-> favoriteTopics()->find($topic)){ return [];}

        $user->favoriteTopics()->attach($topic);

    }
    /*取消收藏*/
    public function unFavorite(Topic $topic,Request $request){
        $user = $request->user();
        $user->favoriteTopics()->detach($topic);
    }

    /*收藏列表*/
    public function favorites(Request $request){
        $favorites =  $request->user()->favoriteTopics()->pageinate(15);

        return view('topics.show',['favorites' => $favorites]);
    }

}
