@extends('layouts.app')

@section('title',$topic->title)
@section('description',$topic->description)

@section('content')

<div class="row ">
    {{--左侧信息栏--}}
    <div class="col-lg-3 col-md-3 d-none d-lg-block d-md-block ">

        <div class="card">
            <div class="card-body">
                {{----}}
                <div class=" text-center">
                   <strong> 作者：{{ $topic->user->name }}</strong>
                </div>
                <hr>
                {{--头像--}}
                <div class="media">
                    <a href="{{route('users.show',$topic->user->id)}}">
                        <img class="img-thumbnail img-fluid object-fit_cover" src="{{$topic->user->avatar}}"
                         width="300px">
                    </a>
                </div>
                {{----}}
                <div>

                </div>
                <hr>
                <div class="btn-group btn-group-sm btn-block">
                    <a class="btn btn-outline-secondary "><i class="fa fa-envelope mr-1 "></i>关注 </a>
                </div>
                <div class="btn-group btn-group-sm btn-block">
                    <a class="btn btn-outline-secondary "><i class="fa fa-paper-plane mr-1"></i>收藏 </a>
                </div>
            </div>
        </div>
    </div>
    {{--主题内容--}}
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 topic-content ">
        <div class="card ">
            <div class="card-body  mt-3 mb-3 ">
                <div class="card-header bg-transparent">
                    {{--标题--}}
                    <h3  class="text-center text-nowrap topic-title ">
                        {{$topic->title}}
                    </h3>
                    {{--标签--}}
                    <div class="text-center text-secondary">
                        {{$topic->created_at->diffForHumans()}}
                        <span>·</span>
                        <i class="far fa-comment"></i>
                        {{$topic->reply_count}}
                    </div>
                </div>
                {{--内容--}}
                <div class=" topic-body mt-4 mb-4  ">
                    {!! $topic->body !!}
                </div>

            </div>
        </div>

        {{--评论--}}
        <div class="card  mt-4 ">
            <div class="card-body pb-0 ">
                {{--发布评论--}}
                @includeWhen(Auth::id(),'topics._reply_box',['topic' =>$topic])
                {{--评论列表--}}
                @include('topics._reply_list',['replies' => $topic->reply()->with('user','topic')->recent()->paginate(5)])
            </div>
        </div>

        @can('destroy',$topic)
        {{--功能按钮--}}
        <div class="mt-4">
            <a class="btn btn-outline-secondary btn-sm" href="{{route('topics.edit',$topic->id)}}">
                <i class="fa fa-edit"></i>
                编辑
            </a>
            <form action="{{ route('topics.destroy',$topic->id) }}" method="post"
                  onsubmit="return confirm('确定删除吗?')" class="d-inline-block">
                @method('delete')
                @csrf
                <button class="btn btn-outline-secondary btn-sm" >
                    <i class="fa fa-trash-alt"></i>
                    删除
                </button>
            </form>
        </div>
    </div>
    @endcan
</div>

@endsection
