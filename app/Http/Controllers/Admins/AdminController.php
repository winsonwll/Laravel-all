<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use Config;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
//use App\Org\Image;
use Intervention\Image\ImageManagerStatic as Image;

class AdminController extends Controller
{
    /**
     * 查看后台管理员
     */
    public function index(Request $request)
    {
        //读取数据 并且分页
        $list = \DB::table('piao_admins')
            ->where(function($query) use ($request){
                if($request->input('keyword')){
                    $query->where('aname','like','%'.$request->input('keyword').'%');
                }
            })
            ->paginate($request->input('num',10));
        return view('admins.admin.index',['list'=>$list, 'request'=>$request->all()]);
    }

    /**
     * 显示添加后台管理员的页面
     */
    public function create()
    {
        return view('admins.admin.create');
    }

    /**
     * 执行添加
     */
    public function store(Request $request)
    {
        //表单验证
        /*$this->validate($request, [
            'aname' => 'required|unique:piao_admins|max:20',
            'apwd' => 'required|min:6|confirmed',
            'repwd' => 'required|min:6|confirmed|same:apwd',
            'auth' => 'required',
            'face' => 'required'
        ],[
            'aname.required' => '用户名不能为空',
            'apwd.required' => '密码不能为空',
            'repwd.required' => '确认密码不能为空',
            'repwd.same' => '两次密码不一致',
            'auth.required' => '权限不能为空',
            'face.required' => '头像不能为空'
        ]);*/

        //实现图片上传 且随机文件名
        if($request->hasFile('face')){     //判断是否有上传
            $file=$request->file('face');      //获取上传信息
            if($file->isValid()){   //确认上传的文件是否成功
                $picname=$file->getClientOriginalName();    //获取上传原文件名
                $ext=$file->getClientOriginalExtension();   //获取上传文件名的后缀名
                $filename=time().rand(1000,9999).'.'.$ext;
                $file->move(Config::get('app.upload_dir'),$filename);    //执行移动上传文件

                //自定义图片等比例缩放
                /*$img = new Image();
                $img->open("./admins/uploads/".$filename)->thumb(100,100)->save("./admins/uploads/s_".$filename);*/

                //第三方插件执行等比缩放
                $img = Image::make(Config::get('app.upload_dir').$filename)->fit(100,100,function($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                $img->save(Config::get('app.upload_dir')."s_".$filename); //另存为
                //return $img->response("jpg"); //输出
            }
        }

        //提取部分参数
        $data = $request->only(['aname','apwd','auth','face']);
        $data['apwd'] = Hash::make($data['apwd']);      //hash加密
        $data['face'] = trim(Config::get('app.upload_dir').'s_'.$filename,'.');
        $data['created_at'] = date('Y-m-d H:i:s');

        //执行添加
        $res = \DB::table('piao_admins')->insert($data);
        if($res){
            return redirect('admin/admin')->with('success','添加成功');
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
     * 修改
     */
    public function edit($id)
    {
        $res=\DB::table('piao_admins')->where('aid',$id)->first();
        return view('admins.admin.edit',['res'=>$res]);
    }

    /**
     * 执行修改
     */
    public function update(Request $request, $id)
    {
        //表单验证
        /*$this->validate($request, [
            'aname' => 'required|unique:piao_admins|max:20',
            'auth' => 'required',
            'face' => 'required'
        ],[
            'aname.required' => '用户名不能为空',
            'auth.required' => '权限不能为空',
            'face.required' => '头像不能为空'
        ]);*/

        //实现图片上传 且随机文件名
        if($request->hasFile('face')){     //判断是否有上传
            $file=$request->file('face');      //获取上传信息
            if($file->isValid()){   //确认上传的文件是否成功
                $picname=$file->getClientOriginalName();    //获取上传原文件名
                $ext=$file->getClientOriginalExtension();   //获取上传文件名的后缀名
                $filename=time().rand(1000,9999).'.'.$ext;
                $file->move(Config::get('app.upload_dir'),$filename);    //执行移动上传文件

                //第三方插件执行等比缩放
                $img = Image::make(Config::get('app.upload_dir').$filename)->fit(100,100,function($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                $img->save(Config::get('app.upload_dir')."s_".$filename); //另存为

                //提取部分参数
                $data = $request->only(['aname','auth','face']);
                $data['face'] = trim(Config::get('app.upload_dir').'s_'.$filename,'.');
            }
        }else{
            //提取部分参数
            $data = $request->only(['aname','auth']);
        }

        $data['updated_at'] = date('Y-m-d H:i:s');

        //执行修改
        $res = \DB::table('piao_admins')->where('aid',$id)->update($data);
        if($res){
            return redirect('admin/admin')->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
        }
    }

    /**
     * 删除
     */
    public function destroy($id)
    {
        $res = \DB::table('piao_admins')->where('aid',$id)->delete();
        if($res){
            return redirect('admin/admin')->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }
}
