<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CateController extends Controller
{
    //优化 只发一条SQL语句查询 速度快
    /**
     * 缓存所有的分类信息
     */
    /*public static function catchCates()
    {
        Cache::set('cates', $this->getCatess());
    }*/

    /**
     * 方法一：获取表中所有的分类
     */
    public static function getAllCate()
    {
        return \DB::table('piao_cates')->get();
    }
    /**
     * 递归方式获取数据
     */
    public static function getCatesByPidArr($cates, $pid)
    {
        $data = [];
        foreach($cates as $k=>$v){
            if($v->pid == $pid){
                $v->sub = self::getCatesByPidArr($cates, $v->cid);
                $data[] = $v;
            }
        }
        return $data;
    }
    /**
     * 获取所有分类
     */
    public function getCatess()
    {
        $arr = self::getAllCate();
        $res = self::getCatesByPidArr($arr, 0); //通过父级id来获取子级元素
        return $res;
    }

    /**
     * 方法二：递归方式获取分类
     */
    public static function getCatesByPid($pid)
    {
        $res = \DB::table('piao_cates')->where('pid','=',$pid)->get();
        //遍历
        $data = [];
        foreach($res as $k=>$v){
            $v->sub = self::getCatesByPid($v->cid);
            $data[]=$v;
        }

        return $data;
    }

    /**
     * 获取分类下所有的类别 按照顺序
     */
    public static function getCates()
    {
        $res = \DB::table('piao_cates')
                ->select(\DB::raw('*,concat(path,",",cid) as paths'))
                ->orderBy('paths')
                ->get();

        //调整分类名称
        foreach($res as $k=>$v){
            $cnt=substr_count($v->path,',');
            $pad=str_repeat('|----',$cnt);
            $res[$k]->cname = $pad.$v->cname;
        }
        return $res;
    }

    /**
     * 查看类别列表页
     */
    public function index(Request $request)
    {
        self::getCatesByPid(0);
        //读取所有分类信息
        $cates = self::getCates();
        return view('admins.cate.index',['cates'=>$cates]);
    }

    /**
     * 显示添加类别的页面
     */
    public function create($cid='')
    {
        //读取所有分类信息
        $cates = self::getCates();

        //$cates = \DB::table('piao_cates')->get();
        return view('admins.cate.create',['cates'=>$cates,'cid'=>$cid]);
    }

    /**
     * 执行添加类别
     */
    public function store(Request $request)
    {
        $data = [];
        //获取父类id
        $pid = $request->input('pid');
        //判断是否是根分类
        $data = $request->except('_token');
        if($pid ==0 ){
            $data['path'] = '0';
        }else{
            //获取pid且读取父级的类别信息
            $info = \DB::table('piao_cates')->where('cid','=',$pid)->first();
            //拼接path
            $data['path'] = $info->path.','.$info->cid;
        }

        $res = \DB::table('piao_cates')->insert($data);
        if($res){
            return redirect('/admin/cate')->with('success', '添加类别成功');
        }else{
            return back()->with('error', '添加类别失败');
        }
    }

    /**
     * 查看单条
     */
    public function show($id)
    {

    }

    /**
     * 修改
     */
    public function edit($id)
    {
        $cates=self::getCates();
        $res=\DB::table('piao_cates')->where('cid',$id)->first();
        return view('admins.cate.edit',['cates'=>$cates, 'res'=>$res]);
    }

    /**
     * 执行修改
     */
    public function update(Request $request, $id)
    {
        $data = [];
        //获取父类id
        $pid = $request->input('pid');
        //判断是否是根分类
        $data = $request->except('_token','cid','_method');
        if($pid ==0 ){
            $data['path'] = '0';
        }else{
            //获取pid且读取父级的类别信息
            $info = \DB::table('piao_cates')->where('cid','=',$pid)->first();
            //拼接path
            $data['path'] = $info->path.','.$info->cid;
        }

        $res = \DB::table('piao_cates')->where('cid','=',$request->input('cid'))->update($data);
        if($res){
            return redirect('/admin/cate')->with('success', '类别修改成功');
        }else{
            return back()->with('error', '类别修改失败');
        }
    }

    /**
     * 删除
     */
    public function destroy($id)
    {
        //检测当前分类下是否有子分类
        $data = \DB::table('piao_cates')->where('pid','=',$id)->count();
        if($data>0){
            return back()->with('error','对不起，该类别下面有子分类，不允许删除');
        }

        $res = \DB::table('piao_cates')->where('cid','=',$id)->delete();
        if($res){
            return redirect('/admin/cate')->with('success', '类别删除成功');
        }else{
            return back()->with('error', '类别删除失败');
        }
    }

    /**
     * 获取顶级分类
     */
    public static function getTopCate()
    {
        return \DB::table('piao_cates')->where('pid',0)->get();
    }
}
