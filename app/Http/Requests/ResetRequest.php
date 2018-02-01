<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetRequest extends FormRequest
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
            'upwd' => 'required|regex:'.config('app.rules.pwd'),
            'repwd' => 'required|same:upwd',
            'token' => 'required'
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
            'upwd.required'  => '密码不能为空',
            'upwd.regex' => '密码格式不正确',
            'repwd.required' => '确认密码不能为空',
            'repwd.same' => '两次密码不一致',
            'token.required' => '非法请求'
        ];
    }
}
