@extends('layouts.app')

@section('title',$user->name.'个人中心' )

@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-3 d-none d-lg-block user-info">
            <div class="card">
                @if ($user->avatar)
                    <img class="card-img-top" src="{{$user->avatar}}"  >
                @else
                    <img class="card-img-top" src="/uploads/images/avatars/default.jpeg">
                @endif
                <div class="card-body">
                    <h5><strong>个人简介</strong></h5>
                    <p class="text-muted">{{$user->introduction ? $user->introduction : '简介为空'}}</p>
                    <hr>
                    <h5><strong>注册于</strong></h5>
                    <p class="text-muted">
                        {{ $user->updated_at ? $user->updated_at->diffForHumans():'暂无法获取' }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="mb-0 " style="font-size: 22px">
                        {{$user->name}}
                        <small class="text-muted" style="font-size: 12px" >{{$user->email}}</small>
                    </h1>


                </div>
            </div>
            <hr>
            {{--用户发布内容--}}
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link  bg-transparent {{active_class(if_query('tab',null))}}"
                               href="{{route('users.show',$user->id)}}">Ta 的话题</a> </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(if_query('tab','reply')) }}"
                               href="{{route('users.show',[$user->id,'tab'=>'reply'])}}">Ta 的回复</a></li>
                    </ul>
                    @if (if_query('tab','reply'))
                    @include('users._replies',['replies' => $user->reply()->recent()->paginate(5)])
                    @else
                    @include('users._topics',['topics' => $user->topic()->recent()->paginate(5)])
                    @endif



                </div>
            </div>

        </div>

    </div>
@stop
