<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        {{--csrf token--}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{--title--}}
        <title>@yield('title','Re0')</title>
        {{-- style--}}
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app" class="">

            @include('layouts.__header')

            <div class="container">

                @include('shared.__message')

                @yield('content')

            </div>
            @include('layouts.__footer')

        </div>
    </body>
    <script src="{{mix('js/app.js')}}"></script>

</html>
