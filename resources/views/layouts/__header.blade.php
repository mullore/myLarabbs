<nav id="nav-bar" class=" navbar navbar-expand-lg
    navbar-light bg-light navbar-static-top {{ $nav_style ?? '' }}  "   >
    <div class="container ">
        {{--LOGO--}}
        <a class="navbar-brand" href="{{ route('home.index') }}">
            Re0
        </a>
        {{--隐藏按钮--}}
        <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navCollapse" aria-controls="navCollapse" aria-expanded="false"
                >
            <span class="navbar-toggler-icon"></span>
        </button>
        {{--折叠菜单--}}
        <div class="  collapse navbar-collapse  " id="navCollapse" >
            {{--left--}}
            <ul class="navbar-nav mr-auto">
                {{--话题--}}
                <li class="nav-item  pull-left
                    {{ active_class(if_route('topics.index')) }}
                    {{ active_class(if_route('home')) }}">

                    <a class="nav-link" href="{{ route('topics.index') }}">
                        <i  class="fa fa-cogs"></i>
                        <span class="ml-1">话题</span>
                    </a>
                </li>
                {{--分享--}}
                <li class="nav-item pull-left {{ category_nav_active(1) }}  ">
                    <a class="nav-link" href="{{ route('categories.show',1) }}">
                        <i  class="fa fa-cogs"></i>
                        <span class="ml-1">分享</span></a>
                </li>
                {{--教程--}}
                <li class="nav-item pull-left {{ category_nav_active(2) }} ">
                    <a class="nav-link" href="{{ route('categories.show',2) }}">
                        <i  class="fa fa-cogs"></i>
                        <span class="ml-1">教程</span></a>
                </li>
                {{--问答--}}
                <li class="nav-item pull-left {{ category_nav_active(3) }} ">
                    <a class="nav-link" href="{{ route('categories.show',3) }}">
                        <i  class="fa fa-cogs"></i>
                        <span class="ml-1">问答</span></a>
                </li>
                {{--公告--}}
                <li class="nav-item pull-left {{ category_nav_active(4) }} ">
                    <a class="nav-link" href="{{ route('categories.show',4) }}">
                        <i  class="fa fa-cogs"></i>
                        <span class="ml-1">公告</span></a>
                </li>
            </ul>
            {{--Right--}}
            <ul class="navbar-nav navbar-right">
                {{--登录后--}}
                @auth
                    {{--新建发帖--}}
                    <li class="nav-item d-none d-md-block d-lg-block">
                        <a class="nav-link"><i class="fa fa-plus" ></i></a>
                    </li>
                    {{--消息通知--}}
                    <li class="nav-item d-none d-md-block d-lg-block">
                        <a class="nav-link" href="{{route('notifications.index')}}">
                            <span class="badge badge-pill badge-secondary">{{Auth::user()->notification_count}}</span>
                        </a>
                    </li>

                    {{--PC--}}
                    <li class="d-none d-lg-block nav-item dropdown ">
                        <a  class="nav-link dropdown-toggle pad_bt0"  href="#" data-toggle="dropdown">
                            <img class="img-thumbnail img-fluid rounded-circle  avatar "
                                src="" data-src="{{ Auth::user()->avatar   }}"
                                 width="35px" height="35px"  alt="个人头像">

                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu" >
                            <a class="dropdown-item" href="{{ route('users.show',Auth::id()) }}">个人中心</a>
                            <a class="dropdown-item" href="{{ route('users.edit',Auth::id()) }}">编辑资料</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">
                                <form action="{{ route('logout') }}" method="post"
                                      onsubmit="return confirm('确定要退出吗')" >
                                    {{ csrf_field() }}
                                    <button class="btn btn-block btn-sm btn-danger " type="submit">退出</button>
                                </form>
                            </a>

                        </div>
                    </li>
                    {{--移动--}}
                    <li class="d-lg-none nav-item lg pull-left">
                        <a class="nav-link">
                            <i class="fa fa-address-book" aria-hidden="true"></i>
                            个人中心</a> </li>
                    <li class="d-lg-none nav-item pull-left">
                        <a class="nav-link">
                            <i class="fa fa-address-book" aria-hidden="true"></i>
                            编辑资料</a> </li>
                    <li class="d-lg-none nav-item ">
                        <a class="dropdown-item p-0" href="#">
                            <form action="{{ route('logout') }}" method="post" >
                                {{ csrf_field() }}
                                <button class="btn btn-sm btn-danger w-100 " type="submit">退出</button>
                            </form>
                        </a>
                    </li>

                {{--登录前--}}
                @else
                    <li class="nav-item pull-left"><a class="nav-link" href="{{ route('login') }}">
                            <i class="fa fa-address-book" aria-hidden="true"></i>
                            <span class="ml-2">登录</span></a></a> </li>
                    <li class="nav-item pull-left"><a class="nav-link" href="{{ route('register') }}">
                            <i class="fa fa-address-book" aria-hidden="true"></i>
                            <span class="ml-2">注册</span></a></a> </li></a> </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>

