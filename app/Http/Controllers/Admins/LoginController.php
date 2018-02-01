<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Admins;
use Illuminate\Support\Facades\Hash;
use Mail;
use Session;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\FloginRequest;
use App\Http\Requests\ResetRequest;
use Crypt;
use Intervention\Image\ImageManagerStatic as Image;
use Config;

class LoginController extends Controller
{
    /**
     * 显示登录页
     */
    public function index()
    {
        \Log::info('进入后台登录页');      //日志打印  storage/logs
        return view('admins.login');
    }

    /**
     * 执行登录
     */
    public function doLogin(LoginRequest $request)
    {
        //验证码
        $userInput = $request->input('vcode');
        $vcode = Session::get('vcode');
        if($userInput != $vcode) {
            return back()->with('error','登录失败：验证码错误');
        }

        //验证用户名和密码
        $admin = new Admins();
        $res = $admin->checkAdmin($request);

        if($res){
            session(['admin'=>$res]);   //登录成功 则记录登录信息
            //自动登录的操作
            if($request->input('remember')){
                $str = $request->aname.'|'.$request->apwd;
                //加密
                $auth_admin = Crypt::encrypt($str);
                //写入cookie
                \Cookie::queue('auth_admin', $auth_admin, 60*24*30);
            }

            return redirect('/admin/show')->with('success','登录成功');
        }else{
            return back()->with('error','登录失败：账号或密码错误');
        }
    }

    /**
     * 退出
     */
    public function logout()
    {
        session()->forget('admin'); //删除session对应的值
        return view('admins.login');
    }

    /**
     * 显示用户注册页面
     */
    public function register()
    {
        return view('frontend.login.register');
    }

    /**
     * 执行注册
     */
    public function doRegister(RegisterRequest $request)
    {
        //检验验证码
        $vcode = $request->input('vcode');
        if($vcode != session('vcode')){
            return back()->with('error','注册失败：验证码错误');
        }

        //提取部分参数
        $data = $request->only(['uname','upwd','email','tel','uface']);
        $data['upwd'] = Hash::make($data['upwd']);
        $data['token'] = str_random(50);    //生成长度50的字符串秘钥
        $data['created_at'] = date('Y-m-d H:i:s');

        //实现图片上传 且随机文件名
        if($request->hasFile('uface')){     //判断是否有上传
            $file=$request->file('uface');      //获取上传信息
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

                $data['uface'] = trim(Config::get('app.upload_dir').'s_'.$filename,'.');
            }
        }

        //执行添加
        $id = \DB::table('piao_users')->insertGetId($data);
        if($id){
            //return redirect('admin/admin')->with('success','添加成功');
            //给用户发激活邮件
            $this->sendActiveMail($data['email'], $id, $data['token']);
            return view('frontend.login.success');
        }else{
            return back()->with('error','注册失败，请重新注册');
        }
    }

    /**
     * 向用户发送激活邮件
     */
    private function sendActiveMail($email, $id, $token)
    {
        /*Mail::raw('恭喜您注册成功，请点击下面的链接完成激活<a href="http://www.piao.com/active?id='.$id.'&token='.$token.'">立即激活</a>', function($message) use($email){
            //$message->from('dajiaonet1@163.com', 'Piao.com');
            $message->to($email)->subject('注册成功提醒邮件');
        });*/

        //将模板解析，并且发送邮件
        Mail::send('frontend.login.active', ['email'=>$email,'id'=>$id, 'token'=>$token], function($message) use($email){
            $message->to($email)->subject('注册成功提醒邮件');
        });
    }

    /**
     * 用户的激活操作
     */
    public function active(Request $request)
    {
        $id = $request->input('id');
        $data = \DB::table('piao_users')->where('uid',$id)->first();

        //比对
        if($request->input('token') == $data->token){
            $tmp['status']=2;
            $res = \DB::table('piao_users')->where('uid', $id)->update($tmp);
            if($res){
                //重置秘钥
                $this->resetToken($id);
                return redirect('/login')->with('success','激活成功');
            }else{
                return redirect('/register')->with('error','激活失败');
            }

            //return redirect('/register')->with('error','激活失败');
        }
    }

    /**
     * 重置用户秘钥token
     */
    private function resetToken($id)
    {
        \DB::table('piao_users')->where('uid',$id)->update([
            'token' => str_random(50)
        ]);
    }

    /**
     * 发送邮件
     */
    public function send()
    {
        Mail::raw('恭喜您注册成功', function($message){
            //$message->from('dajiaonet1@163.com', 'Piao.com');
            $message->to('907476019@qq.com')->subject('提醒邮件');
        });
    }

    /**
     * 前台登录页面
     */
    public function flogin(Request $request)
    {
        $redirect = $request->input('redirect') ? $request->input('redirect') : '';

        return view('frontend.login.login',['redirect'=>$redirect]);
    }

    /**
     * 执行前台登录
     */
    public function doFlogin(FloginRequest $request)
    {
        $res = \DB::table('piao_users')->where('uname',$request->input('uname'))->first();

        //检测密码是否一致
        $info = Hash::check($request->input('upwd'),$res->upwd);
        if($info){
            session(['id'=>$res->uid]); //登录成功 则记录登录信息

            //自动登录的操作
            if($request->input('remember')){
                $str = $request->uname.'|'.$request->upwd;
                //加密
                $auth_id = Crypt::encrypt($str);
                //写入cookie
                \Cookie::queue('auth_id', $auth_id, 60*24*30);
            }

            //获取参数redirect
            $url = $request->input('redirect','/login');
            return redirect($url)->with('success','登录成功');
        }else{
            return back()->with('error','登录失败');
        }
    }

    /**
     * 找回密码
     */
    public function findpwd()
    {
        return view('frontend.login.findpwd');
    }

    /**
     * 处理邮箱是否存在 并且发送找回密码的邮件
     */
    public function doFindpwd(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email'
        ]);

        $res = \DB::table('piao_users')->where('email',$request->input('email'))->first();
        if($res){
            //发送邮件找回
            $this->sendFindMail($res->email, $res->uid, $res->token);
            return redirect('/findpwd')->with('success','发送成功，请立即前往邮箱查看');
        }else{
            return redirect('/findpwd')->with('error','邮箱错误');
        }
    }

    /**
     * 发送找回密码邮件
     */
    private function sendFindMail($email, $id, $token)
    {
        //将模板解析，并且发送邮件
        Mail::send('frontend.login.find', ['email'=>$email,'id'=>$id, 'token'=>$token], function($message) use($email){
            $message->to($email)->subject('找回密码邮件');
        });
    }

    /**
     * 重置密码页面
     */
    public function reset(Request $request)
    {
        //获取id和token
        $res = \DB::table('piao_users')->where('uid',$request->input('id'))->first();
        //判断
        if(empty($res)){
            return redirect('/');
        }
        if($res->token === $request->input('token')){
            return view('frontend.login.reset', ['user'=>$res]);
        }
    }

    /**
     * 执行密码重置
     */
    public function doReset(ResetRequest $request)
    {
        //加密密码
        $data['upwd'] = Hash::make($request->input('upwd'));
        $data['token'] = str_random(50);

        $res = \DB::table('piao_users')->where('uid',$request->input('uid'))->update($data);
        if($res){
            return redirect('/login')->with('success','密码重置成功，请重新登录');
        }else{
            return back()->with('error','重置失败');
        }
    }
}
