@extends('layouts.app',[
    'footer_style'=>'bg-transparent',
    'header_style'=>'register-nav bg-transparent '
])

@section('bg','bg-register')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card opacity-card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        {{--用户名--}}
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right  d-none d-md-block">
                                {{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" placeholder="请输入用户名"
                                       value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{--邮箱--}}
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right  d-none d-md-block">
                                {{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" placeholder="请输入邮箱"
                                       value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{--密码--}}
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right  d-none d-md-block">
                                {{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                       name="password" placeholder="请输入密码"
                                       required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{--确认密码--}}
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right  d-none d-md-block">
                                {{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                       placeholder="请再次输入密码"
                                       required autocomplete="new-password">
                            </div>
                        </div>
                        {{--验证码--}}
                        <div class="form-group row">
                            <label for="captcha" class="col-md-4 col-form-label text-md-right  d-none d-md-block">验证码</label>
                            <div class="col-md-6">
                                <input id="captcha" class="form-control {{  $errors->has('captcha') ? 'is-invalid':'' }}"
                                       type="text" name="captcha" placeholder="请输入验证码" required>
                                {{--验证码图--}}
                                <img src="{{ captcha_src('flat') }}" class="captcha img-thumbnail mt-3 mb-2"
                                     onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
                                {{--验证报错信息--}}
                                @if ($errors->has('captcha'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('captcha') }}</strong>
                                    </span>
                                @endif
                            </div>


                        </div>
                        {{--注册按钮--}}
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
