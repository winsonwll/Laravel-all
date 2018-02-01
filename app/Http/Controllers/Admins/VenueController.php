<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class VenueController extends Controller
{
    /**
     * 获取所有的场馆 按照城市顺序
     */
    public static function getVenues()
    {
        $res = \DB::table('piao_venues')
            ->orderBy('vcity')
            ->get();

        return $res;
    }

    /**
     * 查看场馆列表页
     */
    public function index(Request $request)
    {
        //读取数据 且分页
        $list = \DB::table('piao_venues')
                ->where(function($query) use ($request){
                    if($request->input('keyword')){
                        $query->where('vname','like','%'.$request->input('keyword').'%');
                    }
                })
                ->paginate($request->input('num',10));
        return view('admins.venue.index',['list'=>$list, 'request'=>$request->all()]);
    }

    /**
     * 显示添加场馆的页面
     */
    public function create()
    {
        return view('admins.venue.create');
    }

    /**
 * 执行添加场馆
 */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $res = \DB::table('piao_venues')->insert($data);
        if($res){
            return redirect('/admin/venue')->with('success','添加场馆成功');
        }else{
            return back()->with('error','添加场馆失败');
        }
    }

    /**
     * 查看单条
     */
    public function show($id)
    {
        //
    }

    /**
     * 显示修改的页面
     */
    public function edit($id)
    {
        $res = \DB::table('piao_venues')->where('vid',$id)->first();
        return view('admins.venue.edit',['res'=>$res]);
    }

    /**
     * 执行修改
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token','vid','_method');
        //执行修改
        $res = \DB::table('piao_venues')->where('vid',$id)->update($data);
        if($res){
            return redirect('admin/venue')->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
        }
    }

    /**
     * 删除
     */
    public function destroy($id)
    {
        $res = \DB::table('piao_venues')->where('vid',$id)->delete();
        if($res){
            return redirect('admin/venue')->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }
}
