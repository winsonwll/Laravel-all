<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Admins extends Model
{
    //定义当前模型关联的表
    protected $table='piao_admins';

    //自定义一个验证方法
    public function checkAdmin(Request $request)
    {
        //根据用户名获取用户信息
        $obj=$this->where('aname',$request->input('aname'))->first();
        if($obj){
            if (Hash::check($request->input('apwd'), $obj->apwd)) {
                return $obj;
            }
        }
        return null;
    }
}
