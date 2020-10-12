
@if (count($replies))
    <ul class="list-group border-0  " >
        @foreach( $replies as $reply)
            <li class="list-group-item pl-2 pr-2  border-right-0 border-left-0 @if ($loop->first)
                border-top-0
@endif style-dashed">
                {{--话题标题--}}
                <a href="{{route('topics.show',$reply->topic_id)}}" class="list-group-item-heading">{{$reply->topic->title}}</a>
                {{--内容--}}
                <div class="list-group-item-text  mt-2 mb-2">{!! $reply->content !!}</div>
                {{--标签--}}
                <div class="text-muted mt-1 small "  >
                    <i class="far fa-clock"></i> 回复于 {{$reply->created_at->diffForHumans()}}
                </div>
            </li>
        @endforeach
        <div class="mt-4">
            {!! $replies->appends(Request::except('page'))->render() !!}
        </div>
    </ul>

@endif
