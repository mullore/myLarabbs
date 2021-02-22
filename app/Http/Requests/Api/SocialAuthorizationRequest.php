<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class SocialAuthorizationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules =[
            //required_without 给定的参数字段不存在为空，则为必填项
            // code 和 access_token 必填一个
            'code'=>'required_without:access_token|string',
            'access_token'=>'required_without:code|string',
        ];
        if ($this->social_type ==='weixin' && !$this->code){

            $rules['openid'] = 'required|string';

        }
        return $rules;
    }
}
