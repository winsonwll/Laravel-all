<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
//引用对应的命名空间
use Gregwar\Captcha\CaptchaBuilder;
use Session;

class CommonController extends Controller
{
    /**
     * 验证码
     */
    public function captcha($tmp)
    {
        ob_clean();     //清除
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 100, $height = 34, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();

        //把内容存入session
        Session::flash('vcode', $phrase);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }

    /**
     * 发送短信验证码
     * $to 接收短信的手机号
     * $message 设置发送内容 必须为数字
     */
    public static function sendMessage($to, $message)
    {
        //创建curl对象
        $curl = new \Curl\Curl();
        //发送get请求
        $url = 'http://www.xiaohigh.com/sendMessage/index.php?to='.$to.'&code='.$message.'&web='.config('app.webname').'&class=117';
        //发送
        $curl->get($url);
        //获取结果
        $res = $curl->response;
        //解析 加上true是将结果集变成一个数组 而不是对象
        $result = json_decode($res, true);
        //dd($result);
        //检测
        if($result['resp']['respCode'] ){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 验证
     */
    public function verify(Request $request)
    {
        //发送短信进行验证
        $code = rand(100000,999999);
        $res = self::sendMessage($request->input('to'), $code);
        //将手机验证码存入session
        session(['code'=>$code]);
    }
}
