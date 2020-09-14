@extends('layouts.app')

@section('title',$user->name.'个人中心' )

@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-3 d-none d-lg-block user-info">
            <div class="card">
                <img class="card-img-top" src="/uploads/images/avatars/default.jpeg">
                <div class="card-body">
                    <h5><strong>个人简介</strong></h5>
                    <p class="text-muted">{{$user->introduction ? $user->introduction : '简介为空'}}</p>
                    <hr>
                    <h5><strong>注册于</strong></h5>
                    <p class="text-muted">{{ $user->updated_at ? $user->updated_at:'暂无法获取' }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-9">
            <div class="card">
                <div class="card-body">
                    <h1 class="mb-0" style="font-size: 22px">
                        {{$user->name}}
                        <small class="text-muted">{{$user->email}}</small></h1>
                </div>
            </div>
            <hr>
            {{--用户发布内容--}}
            <div class="card">
                <div class="card-body">
                    暂无数据 ~_~
                </div>
            </div>

        </div>

    </div>
@stop
