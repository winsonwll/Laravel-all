<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admins\CateController;

class ShowController extends Controller
{
    /*
     * 显示前台的详情页
     */
    public function show($id)
    {
        //浏览量
        \DB::table('piao_shows')->where('sid',$id)->increment('vcnt');

        //读取指定id的演出信息
        $show = \DB::table('piao_shows')
                ->where('piao_shows.sid',$id)
                ->select('piao_venues.vaddr','piao_shows.*','piao_cates.cname')
                ->join('piao_venues','piao_venues.vid','=','piao_shows.vid')
                ->join('piao_cates','piao_cates.cid','=','piao_shows.cid')
                ->first();

        //$venue = self::getVenue($id);

        //读取对应的评论信息
        $comments = \DB::table('piao_comments')
            ->where('piao_comments.sid',$id)
            ->select('piao_users.uname','piao_users.level','piao_users.uface','piao_comments.*')
            ->join('piao_users','piao_users.uid','=','piao_comments.uid')
            ->orderBy('created_at','desc')
            ->get();

        //显示内容
        return view('frontend.show',['show'=>$show,'comments'=>$comments]);
    }

    /*
     * 获取指定id的场馆  方法同 Common/function.php
     */
    /*public static function getVenue($id)
    {
        $res = \DB::table('piao_venues')
            ->where('vid',$id)
            ->first();

        return $res;
    }*/

    /**
     * 显示前台列表页
     */
    public function showlist(Request $request)
    {
        $cates = CateController::getTopCate();

        $list = \DB::table('piao_shows')
            ->where(function($query) use($request){
                //检测请求中是否有cate参数
                if($request->has('cate')){
                    $query->where('cid',$request->input('cate'));
                }
            })
            ->select('piao_venues.vname','piao_venues.vcity','piao_shows.*')
            ->join('piao_venues','piao_venues.vid','=','piao_shows.vid')
            //->orderBy('sid','desc')
            ->paginate(10);

        return view('frontend.list',['list'=>$list, 'cates'=>$cates, 'request'=>$request->all()]);
    }

    /**
     * 显示首页
     */
    public function index()
    {
        //获取推荐
        $recs = \DB::table('piao_shows')->where('rec',1)->orderBy('created_at','desc')->limit(5)->get();

        //获取所有的分类信息
        $allcates = CateController::getCatesByPid(0);

        return view('frontend.index',['recs'=>$recs,'allcates'=>$allcates]);
    }
}
