
@if (count($replies))
    <ul class="list-group list-unstyled">

        @foreach( $replies as $index=>$reply )
            <li class="list-group-item border-left-0 border-top-0 border-right-0 style-dashed pl-0 pr-0  "
                id="reply{{$reply->id}}">
                <div class="media">
                    {{--头像--}}
                    <div class="media-left mt-1">
                        <img class="media-object mr-3 img-thumbnail object-fit_cover "
                             src="{{$reply->user->avatar}}"
                             width="48px"  style="height: 48px; "
                             alt="{{ $reply->user->name }}">
                    </div>
                    {{--主体--}}
                    <div class="media-body">
                        {{--回复标题--}}
                        <div class="media-heading ">
                            {{--用户名--}}
                            <a class="text-muted "
                               href="{{ route('users.show',[$reply->user_id]) }}">{{$reply->user->name}}</a>
                            {{--删除回复--}}
                            @can('destroy',[$reply])
                                <form action="{{ route('replies.destroy',$reply->id) }}"
                                      method="post"  class="meta float-right text-muted "
                                      ONSUBMIT=" return confirm('确定删除该评论？')">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <button class="btn btn-default btn-xs pull-left text-secondary"> <i class="fa fa-trash-alt"></i></button>
                                </form>
                            @endcan
                        </div>
                        {{--内容--}}
                        <div class=" mt-2 mb-2 " >{!! $reply->content !!}</div>
                        {{--标签--}}
                        <div class="media-bottom text-muted mt-1 reply-list_label d-none d-md-block d-lg-block ">
                            {{--时间--}}
                            <span >
                                <i class="fa fa-clock"></i>
                                {{$reply->created_at->diffForHumans()}}
                            </span>
                            <div class="float-right">
                                {{--查看回复--}}
                                <a class="text-secondary ml-2">查看回复</a>
                                {{--点赞--}}
                                <span class="ml-2">
                                    <i class="fa fa-thumbs-up mr-1" ></i>0
                                </span>
                                {{--踩--}}
                                <span class="ml-2">
                                    <i class="fa fa-thumbs-down mr-1" ></i>0
                                </span>
                                {{--举报--}}
                                <a class="text-secondary ml-2 ">举报</a>
                                {{--分享--}}
                                <a class="text-secondary ml-2">分享</a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach

    </ul>

    <div class="mt-4 ">
        {!! $replies->appends(Request::except('page'))->render()  !!}
    </div>


@endif
