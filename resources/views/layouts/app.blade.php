<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="description" content="@yield('description', '社区')">
        {{--csrf token--}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{--title--}}
        <title>@yield('title','Re0')</title>
        <link rel="shortcut icon" href="{{asset('uploads/images/favicon.ico')}}">
        {{-- style--}}
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        @yield('styles')
    </head>
    <body class="@yield('bg' )" >

        <div id="app"  >
            @include('layouts.__header')
            <div class="container  ">
                @include('shared.__message')
                @yield('content')
            </div>
            @include('layouts.__footer')
        </div>
    </body>
    <script src="{{mix('js/app.js')}}"></script>

    {{--script--}}
    @yield('scripts')

</html>
