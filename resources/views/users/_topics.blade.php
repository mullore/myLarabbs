@if (count($topics))
    <ul class="list-group tab-pane " >
        @foreach($topics as $topic)
            <li class="list-group-item pl-2 pr-2 border-left-0 border-right-0 @if ($loop->first)
                border-top-0
            @endif style-dashed">
                {{--链接--}}
                <a  class="d-md-inline-block w-75" href="{{ route('topics.show',$topic->id) }}">{{ $topic->title }}</a>
                {{--标签--}}
                <div class="float-md-right text-secondary ">
                    {{--回复--}}
                    <i class="fa fa-folder"></i>
                    <span>{{$topic->reply_count}}</span>
                    <span>·</span>
                    {{--时间--}}
                    <i class="fa fa-clock"></i>
                    <span>{{ $topic->updated_at->diffForHumans() }}</span>
                </div>
            </li>
        @endforeach
        {{--分页--}}
        <div class="mt-4">
            {!! $topics->render() !!}
        </div>
    </ul>
@else
    <div class="empty-block">暂无数据</div>
@endif

