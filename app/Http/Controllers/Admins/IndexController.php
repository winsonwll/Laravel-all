<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    //显示首页
    public function index()
    {
        $res= \DB::table('piao_admins')->get();
        return view('admins.index');
    }
}
