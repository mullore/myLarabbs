
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
                    <form action="{{ route('users.update',$user->id) }}" method="post"
                          accept-charset="utf-8" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        {{--错误提示--}}
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
                        {{--头像--}}
                        <div class="form-group">
                            <label>头像</label>
                            <input id="avatar" class="form-control-file mb-4" type="file" name="avatar" onchange="preview()">
                            <div class="d-inline-flex">
                                <div class="col-md-4">
                                    <div class="card-title">更新后预览：</div>
                                    <img id="preview_img"  class="img-thumbnail" src="{{ $user->avatar }}"
                                         class="img-thumbnail" width="200" height="200">
                                </div>
                                @if ($user->avatar)
                                    <div class="col-md-4">
                                        <div class="card-title">更新前预览：</div>
                                        <img src="{{ $user->avatar }}" class="img-thumbnail" width="200">
                                    </div>
                                @endif
                            </div>
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

@section('scripts')
    <script>
        function preview () {
            const reader = new FileReader();
            let upload_image = document.getElementById('avatar').files[0];
            reader.readAsDataURL(upload_image);
            reader.onload = function (e) {
                document.getElementById('preview_img').src = this.result;
            }
        }
    </script>
@stop
