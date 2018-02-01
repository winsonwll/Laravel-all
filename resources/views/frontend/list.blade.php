@extends('frontend.master.base')

@section('title','演出列表')
@section('css')
    <link href="{{asset('frontend/css/swiper.min.css')}}" rel="stylesheet">
@endsection

{{--@section('header')
    {!! \App\Http\Controllers\Frontend\LayoutController::header() !!}
@endsection--}}

@section('content')
    <div class="container">
        <div class="g-doc g-fix">
            <div class="g-hd">
                <div class="m-nav">
                    <div class="lbox">
                        <a href="javascript:void(0);" onclick="history.back();" class="u-btn u-btn-back"
                           ontouchstart="">返回</a>
                    </div>
                    <div class="cbox">
                        <h1 class="tt">
                            <span class="txt">演唱会</span>
                        </h1>
                    </div>
                    <div class="rbox">
                        <a href="javascript:;" class="u-btn u-btn-sch" ontouchstart="">搜索</a>
                    </div>
                </div>
            </div>
            <div class="g-bd">
                <div class="searchResult">
                    <div class="shaixBox">
                        <ul class="shaix">
                            <li class="allClassification">
                                <div> <span class="categoryIcon categoryIcon1"></span><span  class="t">全部</span> </div>
                            </li>
                            <li class="calendar">
                                <div> <span>日历</span><span class="categoryIcon categoryIcon2"></span> </div>
                            </li>
                            <li class="sort">
                                <div> <span class="t">排序</span><span class="categoryIcon categoryIcon2"></span> </div>
                            </li>
                        </ul>
                        <!--条件筛选弹出框-->
                        <ul class="list-group all-cates">
                            <li class="list-group-item" data-cat="">全部</li>
                            <li class="list-group-item" data-cat="yanchanghui">演唱会</li>
                            <li class="list-group-item" data-cat="huajugeju">话剧歌剧</li>
                            <li class="list-group-item" data-cat="yinyuehui">音乐会</li>
                            <li class="list-group-item" data-cat="ertongqinzi">儿童亲子</li>
                            <li class="list-group-item" data-cat="wudaobalei">舞蹈芭蕾</li>
                            <li class="list-group-item" data-cat="quyizaji">曲艺杂技</li>
                            <li class="list-group-item" data-cat="tiyusaishi">体育赛事</li>
                            <li class="list-group-item" data-cat="xiuxianyule">休闲娱乐</li>
                            <li class="list-group-item openBtnLi"><img src="images/zhankai.jpg" class="openBtn"/></li>
                        </ul>
                        <ul class="list-group">
                            <li>
                                <div id="datepicker"></div>
                            </li>
                            <li class="list-group-item openBtnLi"><img src="images/zhankai.jpg" class="openBtn"/></li>
                        </ul>
                        <ul class="list-group">
                            <li class="list-group-item" data-order="">默认排序</li>
                            <li class="list-group-item" data-order="1">按最热</li>
                            <li class="list-group-item" data-order="2">按价格</li>
                            <li class="list-group-item openBtnLi"><img src="images/zhankai.jpg" class="openBtn"/></li>
                        </ul>
                    </div>
                </div>

                <div class="m-class">
                    <div class="lst">
                        <div class="swiper-wrapper">
                            @foreach($cates as $k=>$v)
                                <a class="itm swiper-slide @if($k==0) itm_on swiper-slide-active @endif" href="{{ URL('/list?cate='.$v->cid) }}"

                                    >{{ $v->cname }}</a>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div id="m_newmain">
                    <div class="m-prolst">
                        <ul class="lst">
                            @foreach($list as $v)
                                <li class="itm">
                                    <a href="{{ URL('/show-'.$v->sid) }}">
                                        <span class="thumb" style="background-image: url({{ URL($v->spic) }})"></span>
                                        <span class="tt">{{ $v->sname }}</span>
                                        <span class="txt">时间：{{ $v->stime }}</span>
                                        <span class="txt">场馆：{{ $v->vname }}</span>
                                        <span class="txt">地点：{{ $v->vcity }}</span>
                                        <span class="tags">
                                        <em class="tag tag-c2">销售中</em>
                                        <strong class="price">{{ $v->price }}元</strong>
                                        </span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    {!! $list->appends($request)->render() !!}
                </div>
            </div>
        </div>

        <!--搜索-->
        <div class="m-layer m-sch z-hide">
            <div class="hd">
                <div class="sch">
                    <form>
                        <input type="text" class="u-ipt" id="searchKey" placeholder="请输入演出、艺人、场馆名称">
                        <a href="javascript:;" class="u-btn" id="btns">搜索</a>
                    </form>
                </div>
                <a class="u-btn u-btn-cancel" href="javascript:;">取消</a>
            </div>
            <div class="bd">
                <div class="m-schtag" id="showhis" style="display:none">
                    <div class="lst" id="hislist"></div>
                    <div class="ops">
                        <a class="u-btn u-btn-clear" href="javascript:;">
                            <i class="icon icon-clear"></i>
                            <span class="txt" id="clhis">清空搜索历史</span>
                        </a>
                    </div>
                </div>
                <div class="m-schrst" id="showser" style="display:none">
                    <ul class="lst" id="seResult"></ul>
                </div>
            </div>
        </div>
        <div class="g-ft">
            <div class="m-ft">
                <div class="logo">大麦 damai.cn</div>
                <div class="cprt">版权所有 大麦网 Copyright2003-2014 All Rights Reserved</div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
