<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use Config;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\InsertShowRequest;
use Intervention\Image\ImageManagerStatic as Image;

class ShowController extends Controller
{
    /**
     * 查看演出列表页
     */
    public function index(Request $request)
    {
        //读取数据 并且分页
        $list = \DB::table('piao_shows')
            ->where(function($query) use ($request){
                if($request->input('keyword')){
                    $query->where('sname','like','%'.$request->input('keyword').'%');
                }
            })
            ->paginate($request->input('num',10));

        $cates = CateController::getCates();
        $venues = VenueController::getVenues();

        return view('admins.show.index',['list'=>$list, 'cates'=>$cates, 'venues'=>$venues, 'request'=>$request->all()]);
    }

    /**
     * 显示添加演出的页面
     */
    public function create()
    {
        $cates = CateController::getCates();
        $venues = VenueController::getVenues();
        return view('admins.show.create',['cates'=>$cates, 'venues'=>$venues]);
    }

    /**
     * 执行添加演出
     */
    public function store(InsertShowRequest $request)
    {
        //实现图片上传 且随机文件名
        if($request->hasFile('spic')){     //判断是否有上传
            $file=$request->file('spic');      //获取上传信息
            if($file->isValid()){   //确认上传的文件是否成功
                $picname=$file->getClientOriginalName();    //获取上传原文件名
                $ext=$file->getClientOriginalExtension();   //获取上传文件名的后缀名
                $filename=time().rand(1000,9999).'.'.$ext;
                $file->move(Config::get('app.upload_dir'),$filename);    //执行移动上传文件

                //第三方插件执行等比缩放
                $img = Image::make(Config::get('app.upload_dir').$filename)->fit(140,190,function($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                $img->save(Config::get('app.upload_dir')."s_".$filename); //另存为
            }
        }
        //提取部分参数
        $data = $request->except('_token');
        //$data['uid'] = session('uid');  //发布演出信息的作者
        $data['spic'] = trim(Config::get('app.upload_dir').'s_'.$filename,'.');
        $data['created_at'] = date('Y-m-d H:i:s');

        //执行添加
        $res = \DB::table('piao_shows')->insert($data);
        if($res){
            return redirect('admin/show')->with('success','添加成功');
        }else{
            return back()->with('error','添加失败');
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
        $cates = CateController::getCates();
        $venues = VenueController::getVenues();

        $res=\DB::table('piao_shows')->where('sid',$id)->first();
        return view('admins.show.edit',['res'=>$res, 'cates'=>$cates, 'venues'=>$venues]);
    }

    /**
     * 执行修改
     */
    public function update(InsertShowRequest $request, $id)
    {
        //实现图片上传 且随机文件名
        if($request->hasFile('spic')){     //判断是否有上传
            $file=$request->file('spic');      //获取上传信息
            if($file->isValid()){   //确认上传的文件是否成功
                $picname=$file->getClientOriginalName();    //获取上传原文件名
                $ext=$file->getClientOriginalExtension();   //获取上传文件名的后缀名
                $filename=time().rand(1000,9999).'.'.$ext;
                $file->move(Config::get('app.upload_dir'),$filename);    //执行移动上传文件

                //第三方插件执行等比缩放
                $img = Image::make(Config::get('app.upload_dir').$filename)->fit(140,190,function($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                $img->save(Config::get('app.upload_dir')."s_".$filename); //另存为

                //提取部分参数
                $data = $request->except('_token','_method');
                $data['spic'] = trim(Config::get('app.upload_dir').'s_'.$filename,'.');
            }
        }else{
            //提取部分参数
            $data = $request->except('spic','_token','_method');
        }

        $data['updated_at'] = date('Y-m-d H:i:s');

        //执行修改
        $res = \DB::table('piao_shows')->where('sid',$id)->update($data);
        if($res){
            return redirect('admin/show')->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
        }
    }

    /**
     * 删除
     */
    public function destroy($id)
    {
        $db = \DB::table('piao_shows')->where('sid',$id);
        //检测图片
        $info = $db->first();
        //检测图片是否存在
        $path = '.'.$info->spic;
        if(file_exists($path)){
            unlink($path);
        }

        $res = $db->delete();
        if($res){
            return redirect('admin/show')->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }

    /**
     * 处理数据
     */
    private function dealRequest(Request $request)
    {

    }
}
