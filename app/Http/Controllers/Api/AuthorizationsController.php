<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthorizationRequest;
use App\Http\Requests\Api\SocialAuthorizationRequest;
use App\Http\Requests\Api\WeappAuthorizationRequest;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;

use Overtrue\Socialite\AccessToken;
use Illuminate\Http\Request;

class AuthorizationsController extends Controller
{
    //用户登录
    public function  store(AuthorizationRequest $request){
        //获取登录邮箱或手机号
        $username = $request->username;
        //判断是否是邮箱 还是 手机号
        filter_var($username,FILTER_VALIDATE_EMAIL) ?
            $credentials['email'] = $username :
            $credentials['phone'] = $username;
        //获取密码
        $credentials['password'] = $request->password;
        //认证登录并获取 $token 并 判断 是否获取成功，如果不成功返回错误
        if (!$token = \Auth::guard('api')->attempt($credentials)){
            // throw  new AuthenticationException('用户名或密码错误');
            return  response()->json(['error'=>'用户名或密码错误'])->setStatusCode(401);
        }
        return $this->respondWithToken($token)->setStatusCode(201);


    }
    //第三方登录
    public function socialStore($type, SocialAuthorizationRequest $request){


        //社会化登录
        $driver = \Socialite::driver($type);

        try {
            //判断能否获得授权码,否则获取 access_token，如果是微信还要获取 openid
            if ($code = $request->code){

                //通过 code 获取 access_token 跟 openid
                $response = $driver->getAccessTokenResponse($code);

                $token = \Arr::get($response, 'access_token');

            }else
            {
                // $tokenData['access_token'] = $request->access_token;
                $token = $request->access_token;
                //微信需要 增加 openid
                if($type === 'weixin'){
                    $driver->setOpenId($request->openid);
                }
            }
            //通过 access_token  获取第三方授权的用户信息
            $oauthUser = $driver->userFromToken($token);
        }catch (\Exception $exception){
            // throw  new  AuthenticationException('\'参数错误，未获取用户信息');
            return  response()->json(['error'=>'参数错误，未获取用户信息'])->setStatusCode(401);

        }

        switch ($type){
            //使用 微信 登录时
            case 'weixin':
                /*
                 * 获取 unionid
                 * 解释：
                 * 如果开发者拥有多个移动应用、网站应用、和公众帐号（包括小程序），
                 * 可通过 unionid 来区分用户的唯一性，因为只要是同一个微信开放平台帐号下的移动应用、
                 * 网站应用和公众帐号（包括小程序），用户的 unionid 是唯一的。换句话说，同一用户，
                 * 对同一个微信开放平台下的不同应用，unionid 是相同的。
                 */
                $unionid = $oauthUser->offsetExists('unionid') ? $oauthUser->offsetGet('unionid') : null;

                //判断是否获取 unionid,如果没有通过 openid获取用户信息
                if ($unionid){
                    //通过 unionid 获取用户信息
                    $user = User::query()->where('weixin_unionid',$unionid)->first();
                }else
                {
                    //通过 openid 获取用户信息
                    $user = User::query()->where('weixin_openid',$oauthUser->getId())->first();
                }

                //如果获取不到,则说明用户不存在，并创建用户
                if(!$user){
                    $user = User::query()->create([
                        'name'=> $oauthUser->getNickname(),
                        'avatar' => $oauthUser->getAvatar(),
                        'weixin_openid' => $oauthUser->getId(),
                        'wexin_unionid' => $unionid,
                    ]);
                }
                break;
        }
        $token = auth('api')->login($user);

        return $this->respondWithToken($token)->setStatusCode(201);
    }

    //微信小程序登录
    public function weappStore(WeappAuthorizationRequest $request){

        //获取 code
        $code = $request->code;

        //小程序
        $miniProgram = \EasyWeChat::miniProgram();
        // 通过 code 获取微信 openid 和 session_key
        $data = $miniProgram->auth->session($code);

        // 如果返回 errcode ，说明 code 已过期或不正确，返回 401 错误
        if (isset($data['errcode'])) {
            // throw new AuthenticationException('code 不正确');
            return  response()->json(['error'=>'code 不正确'])->setStatusCode(401);

        }

        // 通过 openid 查找对应用户
        $user = User::where('weapp_openid', $data['openid'])->first();


        $attributes['weixin_session_key'] = $data['session_key'];

        // 未找到对应用户则需要提交用户名密码进行用户绑定
        if (!$user) {
            // 如果未提交用户名密码，403 错误提示
            if (!$request->username) {
                // throw new AuthenticationException('用户不存在');
                return  response()->json(['error'=>'用户不存在'])->setStatusCode(401);
            }

            //获取用户名
            $username = $request->username;

            // 用户名可以是邮箱或电话
            filter_var($username, FILTER_VALIDATE_EMAIL) ?
                $credentials['email'] = $username :
                $credentials['phone'] = $username;

            $credentials['password'] = $request->password;

            // 验证用户名和密码是否正确
            if (!auth('api')->once($credentials)) {
                // throw new AuthenticationException('用户名或密码错误');
                return  response()->json(['error'=>'用户名或密码错误'])->setStatusCode(401);
            }

            // 获取对应的用户
            $user = auth('api')->getUser();
            $attributes['weapp_openid'] = $data['openid'];
        }

        // 将 openid 跟 seesion_key 跟用户绑定
        $user->update($attributes);

        // 为对应用户创建 JWT
        $token = auth('api')->login($user);

        return $this->respondWithToken($token)->setStatusCode(201);

    }
    protected  function  respondWithToken($token){
        return response()->json([
            'access_token'=>$token,
            'token_token'=>'Bearer',
            'expires_in'=>\Auth::guard('api')->factory()->getTTL()*60
        ]);
    }
    //刷新Token
    public function update(){
        $token = auth('api')->refresh();
        return $this->respondWithToken($token);
    }
    //退出登录
    public function destroy(){
        auth('api')->logout();
        return response(null, 204);
    }
}
