@extends('frontend.master.base')

@section('title','写评论')
@section('css')
    <link href="{{asset('frontend/css/write.4e4ace8b.css')}}" rel="stylesheet">
@endsection

@section('content')
    <form action="{{ URL('/comment/add') }}" method="post">
    <div class="g-hd">
        <div class="m-nav">
            <div class="lbox">
                <a href="javascript:void(0);" onclick="history.back();" class="u-btn u-btn-back" ontouchstart="">返回</a>
            </div>
            <div class="cbox">
                <h1 class="tt">
                    <span class="txt">写评论</span>
                </h1>
            </div>
            <div class="rbox">
                {{ csrf_field() }}
                <input type="hidden" name="sid" value="{{ $sid }}">
                <input type="submit" value="提交" class="btn-right">
            </div>
        </div>
    </div>


    <div class="list-container" style="background-color: #fff;">
        <div class="stars">
            <img src="//dn-piaoniu-static.qbox.me/m/user/img/starYellow.f162e39a.png">
            <img src="//dn-piaoniu-static.qbox.me/m/user/img/starYellow.f162e39a.png">
            <img src="//dn-piaoniu-static.qbox.me/m/user/img/starYellow.f162e39a.png">
            <img src="//dn-piaoniu-static.qbox.me/m/user/img/starYellow.f162e39a.png">
            <img src="//dn-piaoniu-static.qbox.me/m/user/img/starYellow.f162e39a.png">
        </div>
        <div class="comment-text"><textarea placeholder="写几句评价吧..." name="content"></textarea></div>
        <div class="uploadImgs">
            <div class="add-btn">
                <div class="title">上传图片</div>
                <div class="hint">(最多九张)</div>
                <input type="file" multiple="multiple">
            </div>
        </div>
    </div>
    </form>
    <div class="g-ft">
        <div class="m-ft">
            <div class="logo">大麦 damai.cn</div>
            <div class="cprt">版权所有 大麦网 Copyright2003-2014 All Rights Reserved</div>
        </div>
    </div>
@endsection
