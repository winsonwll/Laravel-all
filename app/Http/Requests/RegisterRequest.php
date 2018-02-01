<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'upwd' => 'required|regex:/\S{6,18}/',
            'repwd' => 'required|same:upwd',
            'email' => 'email',
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
            'upwd.regex' => '密码格式不正确',
            'repwd.required' => '确认密码不能为空',
            'repwd.same' => '两次密码不一致',
            'email.email' => '邮箱格式不正确',
            'vcode.required' => '验证码不能为空'
        ];
    }
}
