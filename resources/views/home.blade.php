<!DOCTYPE HTML>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Re0起始页</title>
        <link href="{{ mix('css/app.css') }}" rel="stylesheet" >

    </head>

    <body style="margin-bottom: 0!important;">

        {{--背景图片--}}
        <div id="home-bg" >
            <div class="home-bg w-100 h-100vh" ></div>
        </div>
        {{--导航--}}
        <nav class="hone-nav  fixed-top  pt-3 container">
            <ul class="nav text-white ">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{route('topics.index')}}">论坛</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">博客</a>
                </li>
            </ul>
        </nav>

        {{--内容--}}
        <div class="d-flex justify-content-center align-items-center   w-100 h-100vh  " >

            {{--搜索--}}
            <div class="col-md-5 pb-5 home-body">

                {{--时间--}}
                <h1 id="myTime" class="form-group text-white text-center ">{{date('H:i:s')}}</h1>

                {{--选项卡内容--}}
                <div class="tab-content">
                    {{--谷歌--}}
                    <div class="tab-pane  fade " id="goggle">
                        <form action="http://www.google.com/search" target="_blank" method="get">
                            <div class="form-group input-group">
                                <input  name="q" type="text"
                                       class="form-control rounded-pill text-center"
                                       placeholder="Search"  autocomplete="off" >
                                <button class="btn btn-outline  position-absolute search-button rounded-pill ">
                                    <i class="fa fa-search pr-2 "></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    {{--百度--}}
                    <div class="tab-pane active" id="baidu">
                        <form action="http://www.baidu.com/baidu" target="_blank">
                            <input name=tn type=hidden value=baidu>
                            <div class="form-group input-group">
                                <input  type="text" name="word" size="30" class="form-control rounded-pill text-center"
                                       placeholder="Search"  autocomplete="off"  >
                                <button  class="btn btn-outline  position-absolute search-button  rounded-pill ">
                                    <i class="fa fa-search pr-2 "></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    {{--360--}}
                    <div class="tab-pane fade" id="yahu">
                        <form action="https://www.so.com/s" target="_blank">
                            <input type="hidden" name="ie" value="utf-8">
                            <input type="hidden" name="fr" value="none">
                            <Div class="form-group input-group">
                                <input name="q" type="text" class="form-control rounded-pill text-center"
                                       placeholder="Search"  autocomplete="off" >
                                <button   class="btn btn-outline  position-absolute search-button  rounded-pill ">
                                    <i class="fa fa-search pr-2 "></i>
                                </button>
                            </Div>
                        </form>
                    </div>
                </div>
                {{--选项卡导航--}}
                <ul class="nav nav-pills text-center justify-content-center  " role="tablist">
                    <li class="nav-item  ">
                        <a class=" rounded-pill btn btn-success  pt-0 pb-0 pl-4 pr-4"
                           data-toggle="pill" href="#goggle">谷歌</a>
                    </li>
                    <li class="nav-item mr-3 ml-3 ">
                        <a class="rounded-pill btn btn-success pt-0 pb-0 pl-4 pr-4 active"
                           data-toggle="pill" href="#baidu">百度</a>
                    </li>
                    <li class="nav-item">
                        <a class="rounded-pill btn btn-success pt-0 pb-0 pl-4 pr-4"
                           data-toggle="pill" href="#yahu">360</a>
                    </li>
                </ul>
            </div>
        </div>
        {{--页脚--}}
        <div class="fixed-bottom text-white  text-center home-footer">
            <p class="mb-1">本站素材均从网上下载,若有冒犯请联系站长</p>
            <P class="mb-0"> ©2020 mullore.com <small>粤ICP备19127785号-1</small></P>
        </div>
    </body>
    {{----}}
    <script src="{{mix('js/app.js')}}"></script>
    <script src="{{ asset('js/home.js') }}" type="text/javascript"></script>

</html>
