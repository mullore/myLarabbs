
@extends('layouts.app')
@section('title',$user->name.'编辑资料')
@section('content')
    <div class="container">
        <div class="col-md-8  offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>
                        <i class="fa fa-edit"></i>
                        <small class="font-weight-bold">编辑个人资料</small>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.update',$user->id) }}" method="post" accept-charset="utf-8">
                        @method('PUT')
                        @csrf
                        @include('shared.__error')
                        {{--用户名--}}
                        <div class="form-group">
                            <label >用户名</label>
                            <input class="form-control" type="text" name="name" id="name-field"
                                   value="{{ old('name',$user->name) }}" >
                        </div>
                        {{--邮箱--}}
                        <div class="form-group">
                            <label >邮箱</label>
                            <input class="form-control" type="text" name="email" id="name-email"
                                   value="{{ old('emial',$user->email) }}" >
                        </div>
                        {{--个人简介--}}
                        <div class="form-group">
                            <label >简介</label>
                            <textarea class="form-control" name="introduction" id="introduction"
                                      rows="3">{{old('introduction',$user->introduction)}}</textarea>
                        </div>
                        {{--按钮--}}
                        <div >
                            <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
