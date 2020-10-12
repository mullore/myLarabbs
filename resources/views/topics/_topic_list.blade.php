
@if(count($topics) > 0)
    <ul class="list-unstyled">
        @foreach( $topics as $topic)
            <li class="media mb-2 ">
                {{--头像--}}
                <div class="media-left">
                    <a href="{{ route('users.show',[$topic->user_id]) }}">
                        <img class="media-object img-thumbnail img-fluid mr-2 object-fit_cover"
                              width="52px"
                             style=" height: 52px"
                            src="{{ $topic->user->avatar }}" alt="{{$topic->user->name}}">
                    </a>
                </div>
                {{--内容--}}
                <div class="media-body text-secondary ">
                    <div class="media-heading">
                        {{--标题--}}
                        <a href="{{ $topic->link()  }}" title="{{ $topic->title }}" >
                            {{ $topic->title }}
                        </a>

                    </div>
                    {{--标签--}}
                    <div class="media-body meta mt-2 d-none d-md-block d-lg-block small">

                            {{--分类--}}
                            <a  class="text-secondary  mr-2" href="{{ route('categories.show',$topic->category_id) }}">
                                <i class="fa fa-folder"></i>
                                <span>{{ $topic->category->name }}</span>

                            </a>
                            {{--用户--}}
                            <a class="text-secondary mr-2" href="{{ route('users.show', $topic->user->id) }}">
                                <i class="fa fa-user"></i>
                                <span>{{ $topic->user->name }}</span>
                            </a>
                            {{--更新时间--}}
                            <span class="time">
                            <i class="fa fa-clock"></i>
                            <span>{{$topic->updated_at->diffForHumans()}}</span>
                        </span>

                    </div>
                </div>
                {{--徽章--}}
                <a class=" badge badge-danger badge-pill small align-self-center">
                    {{ $topic->reply_count }}
                </a>
            </li>
            @if (!$loop->last)
                <hr>
            @endif
        @endforeach
    </ul>
@else
    <div class="card">暂无数据</div>
@endif
