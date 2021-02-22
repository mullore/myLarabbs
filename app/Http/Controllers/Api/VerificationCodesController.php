<?php

namespace App\Http\Controllers\Api;

use  Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\VerificationCodeRequest;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Overtrue\EasySms\EasySms;
use Overtrue\EasySms\Exceptions\NoGatewayAvailableException;

class VerificationCodesController extends Controller
{
    //
    public function store(VerificationCodeRequest $request,EasySms $easySms){

            //获取验证码数据
            $captchaData = \Cache::get($request->captcha_key);
            //判断验证码是否过期
            if (!$captchaData){
                abort(403,'图片验证码已失效');
            }
            //判断验证是否一致
            if (!hash_equals(strtolower($captchaData['code']),strtolower($request->captcha_code))){
                \Cache::forget($request->captcha_key);
                throw  new AuthenticationException('验证码错误');
            }
            //获取 手机号
            $phone = $captchaData['phone'];

            //生成短信验证码文本
            $code = str_pad(random_int(1, 9999),4,0,STR_PAD_LEFT);

            //向 短信运营商 发送 短信验证码文本
            try {
                $result = $easySms->send( $phone,[
                    'template'=> config('easysms.gateways.aliyun.templates.register'),
                    'data'=>[
                        'code'=> $code
                    ]
                ]);
            }
            catch (NoGatewayAvailableException $exception)
            {
                $message = $exception->getException('aliyun')->getMessage();
                abort(500,$message ?:'短信消息异常');

            }
            //生成 手机短信 key
            $key='verificationCode_'.Str::random(15);
            //设置过期时间
            $expiredAt = now()->addMinutes(5);
            //存入缓存
            \Cache::put($key,['phone'=>$phone,'code'=>$code],$expiredAt);
            //清除验证码缓存
            // \Cache::forget($request->captcha_key);
            return response()->json([
                'key'=>$key,
                'expired_at'=>$expiredAt->toDateTimeString(),
            ])->setStatusCode(201);

    }
}
