@extends('layouts.app')
@section('title','话题列表')

@section('content')
    <div class="row mb-5">
        {{--主体内容--}}
        <div class="col-md-9 col-lg-9 topic-list">
            {{--分类--}}
            @if (isset($category))
                <div class="alert alert-info">
                    {{$category->name}} : {{$category->description}}
                </div>
            @endif
            <div class="card ">
                {{--头部--}}
                <div class="card-header bg-transparent">
                    {{--排序--}}
                    <nav class="nav nav-pills">
                        <li class="nav-item ">
                            <a href="{{Request::url()}}?order=recent"
                               class="nav-link @if (Request::getQueryString() != 'order=default')
                                   active
                               @endif">最新发布</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{Request::url()}}?order=default"
                               class="nav-link @if (Request::getQueryString() == 'order=default')
                                   active
                               @endif">最后回复</a>
                        </li>
                    </nav>
                </div>

                {{--主体--}}
                <div class="card-body">
                    {{--话题列表--}}
                    @include('topics._topic_list',['topics'=>$topics])
                    {{--分页--}}
                    <div class=" mt-5">
                        {!! $topics->appends(Request::except('page'))->render() !!}
                    </div>
                </div>
            </div>
        </div>
        {{--侧边栏--}}
        <div class="col-md-3 col-lg-3 d-none d-md-block d-lg-block  sidebar ">
            @include('topics._sidebar')
        </div>
    </div>

@endsection
