<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admins\CateController;

class LayoutController extends Controller
{
    /**
     * 创建和显示页面的头部信息
     */
    public static function header()
    {
        //获取数据
        $allcates = CateController::getCatesByPid(0);

        return view('frontend.master.header',['allcates'=>$allcates]);
    }
}
