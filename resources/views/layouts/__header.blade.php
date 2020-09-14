<nav id="nav-bar" class="navbar navbar-expand-lg navbar-light bg-light navbar-static-top " >
    <div class="container">
        {{--LOGO--}}
        <a class="navbar-brand" href="{{ url('/') }}">
            Re0
        </a>
        {{--隐藏按钮--}}
        <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navCollapse" aria-controls="navCollapse" aria-expanded="false"
                >
            <span class="navbar-toggler-icon"></span>
        </button>
        {{--折叠菜单--}}
        <div class="collapse navbar-collapse" id="navCollapse">
            {{--left--}}
            <ul class="navbar-nav mr-auto">

            </ul>
            {{--Right--}}
            <ul class="navbar-nav navbar-right">
                @auth
                    {{--PC--}}
                    <li class="d-none d-lg-block nav-item dropdown ">
                        <a  class="nav-link dropdown-toggle pad_bt0"  href="#" data-toggle="dropdown">
                            <img src="/uploads/images/avatars/default.jpeg"  class="img-fluid rounded-circle "
                                 width="40px" height="40px" alt="个人头像">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu" >
                            <a class="dropdown-item" href="{{ route('users.show',Auth::id()) }}">个人中心</a>
                            <a class="dropdown-item" href="{{ route('users.edit',Auth::id()) }}">编辑资料</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">
                                <form action="{{ route('logout') }}" method="post" >
                                    {{ csrf_field() }}
                                    <button class="btn btn-block btn-danger" type="submit">退出</button>
                                </form>
                            </a>

                        </div>
                    </li>
                    {{--移动--}}
                    <li class="d-lg-none nav-item lg text-center"><a class="nav-link">个人中心</a> </li>
                    <li class="d-lg-none nav-item text-center"><a class="nav-link">编辑资料</a> </li>
                    <li class="d-lg-none nav-item text-center">
                        <a class="dropdown-item" href="#">
                            <form action="{{ route('logout') }}" method="post" >
                                {{ csrf_field() }}
                                <button class="btn btn-sm btn-danger" type="submit">退出</button>
                            </form>
                        </a>
                    </li>


                @else
                    <li class="nav-item text-center"><a class="nav-link" href="{{ route('login') }}">登录</a> </li>
                    <li class="nav-item text-center"><a class="nav-link" href="{{ route('register') }}">注册</a> </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>
