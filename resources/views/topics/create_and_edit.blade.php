@extends('layouts.app')

@section('content')

<div class="container">
  <div class="col-md-10 offset-md-1">
    <div class="card ">

      <div class="card-body">
        {{--标题--}}
        <h2  class="card-header bg-transparent" >
            <i class="fa fa-edit"></i>
          @if($topic->id)
             编辑话题
          @else
             新建话题
          @endif
        </h2>
        <br>
        {{--表单--}}
        @if($topic->id)
          <form action="{{ route('topics.update', $topic->id) }}" method="POST" accept-charset="UTF-8">
          <input type="hidden" name="_method" value="PUT">
        @else
          <form action="{{ route('topics.store') }}" method="POST" accept-charset="UTF-8">
        @endif
        {{--错误提示--}}
        @include('shared.__error')
        @csrf
        {{--标题--}}
        <div class="form-group">
            <input class="form-control" name="title" type="text"
                   value="{{ $topic->title }}" placeholder="请填入标题" required />
        </div>
        {{--分类--}}
        <div class="form-group">
            <select class="form-control custom-select " name="category_id" required>
                <option hidden disabled
                        {{$topic->id? '': 'selected'}}
                >请选择分类</option>
                @foreach( $categories as $value)
                    <option value="{{$value->id}}"
                    {{ $topic->category_id == $value->id? 'selected':'' }}>
                    {{$value->name}}</option>
                @endforeach
            </select>
        </div>
        {{--内容--}}
        <div class="form-group">
            <textarea id="editor" class="form-control"
                      name="body" placeholder="请填入至少三个字符的内容"
                      rows="6"
            >{{old('body',$topic->body)}}</textarea>
        </div>
        {{--保存--}}
        <div class="form-group">
            <button class="btn btn-primary" type="submit">
                <i class="fa fa-save mr-2"></i>
                保存
            </button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

@section('styles')
    <link href="{{ asset('css/simditor.css') }}" rel="stylesheet" type="text/css">
@stop

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/module.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/hotkeys.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/uploader.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/simditor.js') }}"></script>
    <script>
        $(document).ready(function() {
            var editor = new Simditor({
                textarea: $('#editor'),
                upload: {
                    /*处理上传图片的url*/
                    url: '{{ route('topics.upload_image') }}',
                    /*表单提交的参数*/
                    params: {
                        _token: '{{ csrf_token() }}'
                    },
                    /*服务器获取图片的键值*/
                    fileKey: 'upload_file',
                    /*最多同时上传三张图片*/
                    connectionCount: 3,
                    /*上传过程中,关闭页面时的提醒*/
                    leaveConfirm: '文件上传中，关闭此页面将取消上传。'
                },
                /*是否支持图片黏贴上传*/
                pasteImage: true,
            });
        });
    </script>
@stop
