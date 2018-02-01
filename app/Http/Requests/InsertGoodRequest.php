<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertGoodRequest extends FormRequest
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
            'title' => 'required',
            'price' => 'required',
            'cnt' => 'required',
            'cid' => 'required|numeric',
            'content' => 'required',
            'color' => 'required',
            'size' => 'required'
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
            'title.required' => '商品名称不能为空',
            'price.required' => '价格不能为空',
            'cnt.required' => '库存不能为空',
            'cid.required'  => '商品类别不能为空',
            'cid.numeric'  => '商品类别的参数有误',
            'content.required' => '商品详情不能为空',
            'color.required' => '颜色不能为空',
            'size.required' => '尺寸不能为空'
        ];
    }
}
