<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use Config;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Requests\InsertGoodRequest;

class GoodsController extends Controller
{
    /**
     * 查看后台商品列表
     */
    public function index(Request $request)
    {
        //读取数据 并且分页
        $list = Goods::orderBy('id','desc')
            ->where(function($query) use ($request){
                if($request->input('keyword')){
                    $query->where('title','like','%'.$request->input('keyword').'%');
                }
            })
            ->paginate($request->input('num',10));
        return view('admins.good.index',['list'=>$list, 'request'=>$request->all()]);
    }

    /**
     * 显示添加商品的页面
     */
    public function create()
    {
        $cates = CateController::getCates();
        return view('admins.good.create',['cates'=>$cates]);
    }

    /**
     * 执行添加商品
     */
    public function store(Request $request)
    {
        $goods = new Goods();
        //调用方法
        $goods = $this->dealData($request, $goods);

        $goods->created_at = date('Y-m-d H:i:s');

        //执行添加
        if($goods->save()){
            return redirect('admin/good')->with('success','添加成功');
        }else{
            return back()->with('error','添加失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
        $res = Goods::findOrFail($id);

        return view('admins.good.edit',['res'=>$res, 'cates'=>$cates]);
    }

    /**
     * 执行修改
     */
    public function update(InsertGoodRequest $request,$id)
    {
        //更新数据
        $goods = Goods::findOrFail($id);

        //调用方法
        $goods = $this->dealData($request, $goods);

        $goods->updated_at = date('Y-m-d H:i:s');

        //执行修改
        if($goods->save()){
            return redirect('admin/good')->with('success','更新成功');
        }else{
            return back()->with('error','更新失败');
        }
    }

    /**
     * 删除
     */
    public function destroy($id)
    {
        $goods = Goods::findOrFail($id);

        $res = $goods->delete();
        if($res){
            return redirect('admin/good')->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }

    /**
     * 处理数据
     */
    private function dealData($request, $goods)
    {
        //填充参数
        $goods->title = $request->input('title');
        $goods->price = $request->input('price');
        $goods->cnt = $request->input('cnt');
        $goods->cid = $request->input('cid');
        $goods->size = implode(',',array_values($request->input('size')));
        $goods->color = implode(',',array_values($request->input('color')));
        $goods->content = $request->input('content');
        $goods->status = $request->input('status');

        //实现图片上传 且随机文件名
        if($request->hasFile('pic')){     //判断是否有上传
            $file=$request->file('pic');      //获取上传信息
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

                $goods->pic = trim(Config::get('app.upload_dir').'s_'.$filename,'.');
            }
        }

        return $goods;
    }
}
