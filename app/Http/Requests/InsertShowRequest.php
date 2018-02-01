<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertShowRequest extends FormRequest
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
            'sname' => 'required',
            'cid' => 'required|numeric',
            'stime' => 'required',
            'vid' => 'required|numeric',
            'price' => 'required',
            'sdesc' => 'required'
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
            'sname.required' => '演出名称不能为空',
            'cid.required'  => '演出类别不能为空',
            'cid.numeric'  => '演出类别的参数有误',
            'stime.required' => '演出时间不能为空',
            'vid.required' => '演出场馆不能为空',
            'vid.numeric'  => '演出场馆的参数有误',
            'price.required' => '演出价格不能为空',
            'sdesc.required' => '演出简介不能为空'
        ];
    }
}
