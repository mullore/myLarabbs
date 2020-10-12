<li class="media">
    <div class="media-left">
        <a href="{{ route('topics.show', $notification->data['user_id']) }}">
            <img class="img-thumbnail img-fluid avatar" src="{{ $notification->data['user_avatar'] }}"
             style="width: 48px;height: 48px;" >
        </a>
    </div>
    <div class="media-body ml-2">
        <div class="media-heading">
            <a href="{{route('users.show',$notification->data['user_id'])}}" class="text-muted font-weight-bold" >
                {{ $notification->data['user_name'] }}
            </a>
            <span class="text-secondary">
                评论了
            </span>
            <a href="{{route('topics.show',$notification->data['topic_id'])}}">
                {{$notification->data['topic_title']}}
            </a>

            <span class="float-right text-secondary">
                <i class="fa fa-clock"></i>
                {{ $notification->created_at->diffForHumans() }}
            </span>
        </div>

        <div>
            {!! $notification->data['reply_content'] !!}
        </div>
    </div>

</li>
