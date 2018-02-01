<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FloginRequest extends FormRequest
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
        return [
            'uname' => 'required',
            'upwd' => 'required',
            'vcode' => 'required'
        ];
    }

    /**
     * 获取已定义验证规则的错误消息。
     *
     * @return array
     */
    public function messages()
    {
        return [
            'uname.required' => '用户名不能为空',
            'upwd.required'  => '密码不能为空',
            'vcode.required' => '验证码不能为空'
        ];
    }
}
