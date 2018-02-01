<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * 显示评论页
     */
    public function index($id)
    {
        return view('frontend.comment',['sid'=>$id]);
    }

    /**
     * 执行添加
     */
    public function add(Request $request)
    {
        //提取部分参数
        $data = $request->except('_token');
        $data['uid'] = session('id');
        $data['created_at'] = date('Y-m-d H:i:s');

        //执行添加
        $res = \DB::table('piao_comments')->insert($data);
        if($res){
            return redirect('show-'.$request->input('sid'))->with('success','评论成功');
        }else{
            return back()->with('error','评论失败');
        }
    }
}
