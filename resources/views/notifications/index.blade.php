
@extends('layouts.app')

@section('title','评论通知')

@section('content')
    <div class="container">
        <div class="col-md-10 col-lg-10 offset-md-1">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-sm-center">
                        <i class="far fa-bell"></i>我的通知
                    </h3>
                    <hr>
                    @if (count($notifications)>0)
                        <div class="list-unstyled notification-list">
                            @foreach($notifications as $notification)
                                @include('notifications.types._'.Str::snake(class_basename($notification->type)))
                            @endforeach
                            {!! $notifications->render() !!}
                        </div>
                    @else
                        <div class="dd-empty">没有消息通知！</div>
                    @endif


                </div>
            </div>
        </div>
    </div>
@stop
