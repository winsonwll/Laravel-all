<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>找回密码</title>
    <link href="{{asset('frontend/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/review.css')}}" rel="stylesheet">
</head>
<body ontouchstart>
<div class="container" id="container">
    <div class="g-doc">
        <div class="g-bd">
            <div class="m-confirm">
                <div class="box">
                    <div class="m-deliver">
                        <div class="hd">
                            <h2 class="m_sign">温馨提示</h2>
                        </div>
                        <p class="m_f14 tc">请点击下面的链接完成密码重置<a href="http://www.piao.com/reset?id={{ $id }}&token={{ $token }}">立即激活</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
