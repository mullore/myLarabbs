<?php


namespace App\Handlers;

use GuzzleHttp\Client;
use Overtrue\Pinyin\Pinyin;

class SlugsTranslateHandler
{
    public function translate($text){
        //实例化HTTP客户端
        $http = new Client();

        //通用翻译API
        // $api = 'http://api.fanyi.baidu.com/api/trans/vip/translate?';
        $api = 'http://api.fanyi.baidu.com/api/trans/vip/translate?';
        //app_id
        $appid = config('services.baidu_translate.appid');
        //key
        $key =  config('services.baidu_translate.key');
        //time
        $salt = time();

        if(empty($appid) || empty($key)){
            $this->pinyin($text);
        }

        // 根据文档，生成 sign
        // http://api.fanyi.baidu.com/api/trans/product/apidoc
        // app_id+q+salt+密钥 的MD5值
        $sign = md5($appid.$text.$salt.$key);

        $query = http_build_query([
            'q' => $text,
            'from' => 'zh',
            'to'=>'en',
            'appid' => $appid,
            'salt'=> $salt,
            'sign' =>$sign,
        ]);

        $response = $http->get($api.$query);
        $result =  json_decode($response->getBody(),true);
        if(isset($result['trans_result'][0]['dst'])){
            return  \Str::slug($result['trans_result'][0]['dst']);
        }else{
            return $this->pinyin($text);
        }


    }

    public function pinyin($text){
        return \Str::slug(app(Pinyin::class)->permalink($text));
    }

}
