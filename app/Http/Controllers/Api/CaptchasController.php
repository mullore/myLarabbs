<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CaptchaRequest;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Http\Request;

class CaptchasController extends Controller
{
    //
    public function store(CaptchaRequest $request,CaptchaBuilder $builder){
        //生成key
        $key = 'captcha-'.Str::random(15);
        //获取手机号
        $phone = $request->phone;
        //通过 build 获取 验证码图片
        $captcha = $builder->build();
        //设置过期时间
        $expiredAt = now()->addMinutes(2);
        // 使用 getPhrase 方法获取验证码文本，跟手机号一同存入缓存。
        \Cache::put($key, ['phone'=>$phone,'code'=>$captcha->getPhrase()], $expiredAt);
        //// 返回 captcha_key，过期时间以及 inline 方法获取的 base64 图片验证码
        $result=[
            'captcha_key'=>$key,
            'expired_at' => $expiredAt,
            //base64 图片验证码
            'captcha_image_content'=>$captcha->inline(),
        ];
        return response()->json($result)->setStatusCode(201);
    }
}
