@extends('frontend.master.base')

@section('title','演出列表')
@section('css')
    <link href="{{asset('frontend/css/swiper.min.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="g-doc g-fix" style="visibility: visible;">
            <!--头部导航-->
            <div class="g-hd">
                <div class="m-nav">
                    <div class="lbox">
                        <a href="javascript:;" class="u-btn u-btn-menu" ontouchstart="">收起</a>
                    </div>
                    <div class="cbox">
                        <h1 class="tt">
                            <span class="txt">大麦</span>
                            <span class="city">上海</span></h1>
                    </div>
                    <div class="rbox">
                        <a href="javascript:;" class="u-btn u-btn-sch" ontouchstart="">搜索</a>
                    </div>
                </div>
            </div>

            <div class="g-bd">
                <!--轮播图-->
                <div class="m-focus">
                    <div class="swiper-wrapper">
                        <a class="swiper-slide" href="">
                        <span class="thumb">
                            <img src="http://static.damai.cn/mapi/2016-09-05/cdab8171-35e1-43c6-b146-9147f63ae6c5.jpg"
                                 alt="麦麦贴士">
                        </span>
                        </a>
                        <a class="swiper-slide" href="">
                        <span class="thumb">
                            <img src="http://static.damai.cn/mapi/2016-08-17/6a2298a7-2e06-4c98-bb94-914a54840cbc.jpg"
                                 alt="">
                        </span>
                        </a>
                    </div>
                    <div class="nav"></div>
                </div>

                <!--分类-->
                <div class="category">
                    <ul class="ui-category">
                            <li>
                                <a href="">
                                    <div class="img"><img src="frontend/images/home-entry-live.png">
                                    </div>
                                    <div class="text">演唱会</div>
                                </a>
                            </li>
                        <li><a href="">
                                <div class="img"><img src="frontend/images/home-entry-drama.png">
                                </div>
                                <div class="text">话剧歌剧</div>
                            </a></li>
                        <li><a href="">
                                <div class="img"><img src="frontend/images/home-entry-leisure.png">
                                </div>
                                <div class="text">休闲展览</div>
                            </a></li>
                        <li><a href="">
                                <div class="img"><img src="frontend/images/home-entry-sports.png">
                                </div>
                                <div class="text">体育赛事</div>
                            </a></li>
                        <li><a href="">
                                <div class="img"><img src="frontend/images/home-entry-concert.png">
                                </div>
                                <div class="text">音乐会</div>
                            </a></li>
                        <li><a href="">
                                <div class="img"><img src="frontend/images/home-entry-child.png">
                                </div>
                                <div class="text">儿童亲子</div>
                            </a></li>
                        <li><a href="">
                                <div class="img"><img src="frontend/images/home-entry-dance.png">
                                </div>
                                <div class="text">舞蹈芭蕾</div>
                            </a></li>
                        <li><a href="">
                                <div class="img"><img src="frontend/images/home-entry-opera.png">
                                </div>
                                <div class="text">戏曲综艺</div>
                            </a></li>
                    </ul>
                </div>

                <!--活动bar-->
                <div class="operations"><a href="">
                        <div class="item">
                            <div class="logo" style="background-image: url(http://img.piaoniu.com/banner/fb75ed4d0824ff6046eb3a54c7126df58832df85.jpg)"></div>
                        </div>
                    </a><a href="">
                        <div class="item">
                            <div class="logo" style="background-image: url(https://dn-ipiaoniu.qbox.me/banner/8dc0a95683ffc73f9db2f0ad8dfda09d800ed31f.jpg)"></div>
                        </div>
                    </a><a href="">
                        <div class="item">
                            <div class="logo" style="background-image: url(https://dn-ipiaoniu.qbox.me/banner/155ef2900bc6a54e0fab513580aa4ab22e206f42.jpg)"></div>
                        </div>
                    </a></div>

                <!--猜你喜欢-->
                <h2 class="u-tt"><span class="txt">猜你喜欢</span></h2>
                <div class="m-class" style="height:215px;">
                    <div class="lst swiper-container-horizontal swiper-container-free-mode" style="height:16rem">
                        <div class="swiper-wrapper">
                            @foreach($recs as $k=>$v)
                                <div class="itm1 swiper-slide @if($k==0) swiper-slide-active @endif">
                                    <dl style="width:110px;">
                                        <dt><a href="{{ URL('/list?cate='.$v->cid) }}"><img
                                                        src="{{ $v->spic }}" width="182"
                                                        height="249"></a></dt>
                                        <dd><a href="{{ URL('/list?cate='.$v->cid) }}" class="m_c333"
                                               style="height: 3.2rem;overflow: hidden;text-overflow: -o-ellipsis-lastline;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical; width:9.5rem; line-height:1.6rem;">{{ $v->sname }}</a>
                                        </dd>
                                    </dl>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <h2 class="u-tt"><span class="txt">演唱会</span><a class="more" href="/sh/concert.html">更多</a></h2>

                <div class="m-homeitms">
                    <ul class="lst">
                        <li class="itm">
                            <div class="box">
                                <a class="thumb" href="/ticket/107633.html" style="background-image: url(http://pimg.dmcdn.cn/perform/project/1076/107633_n.jpg);"></a>
                                <a class="txt">2016上海简单生活节</a>
                                <span class="date">2016.10.04-2016.10.06</span>
                            </div>
                        </li>
                        <li class="itm">
                            <div class="box">
                                <a class="thumb" href="/ticket/105699.html" style="background-image: url(http://pimg.dmcdn.cn/perform/project/1056/105699_n.jpg);"></a>
                                <a class="txt">2016 五月天上海演唱会</a>
                                <span class="date">2016.10.04-2016.10.07</span>
                            </div>
                        </li>
                        <li class="itm">
                            <div class="box">
                                <a class="thumb" href="/ticket/107978.html" style="background-image: url(http://pimg.dmcdn.cn/perform/project/1079/107978_n.jpg);"></a>
                                <a class="txt">2016赵雷【无法长大】巡回演唱会—上海站</a>
                                <span class="date">2016.11.19</span>
                            </div>
                        </li>
                        <li class="itm">
                            <div class="box">
                                <a class="thumb" href="/ticket/107412.html" style="background-image: url(http://pimg.dmcdn.cn/perform/project/1074/107412_n.jpg);"></a>
                                <a class="txt">瑞可德林·陈伟霆 Inside Me 2016巡回演唱会-上海站</a>
                                <span class="date">2016.09.10</span>
                            </div>
                        </li>
                    </ul>
                </div>

                <h2 class="u-tt"><span class="txt">音乐会</span><a class="more" href="/sh/music.html">更多</a></h2>
                <div class="m-homeitms">
                    <ul class="lst">
                        <li class="itm">
                            <div class="box">
                                <a class="thumb" href="/ticket/108089.html" style="background-image: url(http://pimg.dmcdn.cn/perform/project/1080/108089_n.jpg);"></a>
                                <a class="txt">爱乐汇·“天空之城”久石让&amp;宫崎骏动漫作品视听交响音乐会</a>
                                <span class="date">2016.10.05</span>
                            </div>
                        </li>
                        <li class="itm">
                            <div class="box">
                                <a class="thumb" href="/ticket/108012.html" style="background-image: url(http://pimg.dmcdn.cn/perform/project/1080/108012_n.jpg);"></a>
                                <a class="txt">爱乐汇•“天空之城”久石让&amp;宫崎骏动漫作品视听音乐会</a>
                                <span class="date">2016.12.16</span>
                            </div>
                        </li>
                        <li class="itm">
                            <div class="box">
                                <a class="thumb" href="/ticket/107754.html" style="background-image: url(http://pimg.dmcdn.cn/perform/project/1077/107754_n.jpg);"></a>
                                <a class="txt">爱乐汇•乌克兰国家交响乐团上海新年音乐会</a>
                                <span class="date">2016.12.26-2016.12.27</span>
                            </div>
                        </li>
                        <li class="itm">
                            <div class="box">
                                <a class="thumb" href="/ticket/107258.html" style="background-image: url(http://pimg.dmcdn.cn/perform/project/1072/107258_n.jpg);"></a>
                                <a class="txt">阿姆斯特丹的郁金香——荷兰马兰多轻音乐团上海新年音乐会</a>
                                <span class="date">2017.01.02-2017.01.03</span>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="m-homeitms">
                    <blockquote><a class="u-btn u-btn-more" href="javascript:;">看看全国有啥好玩的</a></blockquote>
                </div>
            </div>
        </div>

        <div class="g-ft">
            <div class="m-ft">
                <div class="logo">大麦 damai.cn</div>
                <div class="cprt">版权所有 大麦网 Copyright2003-2014 All Rights Reserved</div>
            </div>
        </div>

        <!--侧边菜单-->
        <div class="m-mask z-hide"></div>
        <div class="m-sdmenu z-hide">
            <div class="lst">
                <a class="itm" href="/" ontouchstart=""><i class="icon icon-home"></i><span class="txt">首页</span></a>
                <a class="itm" href="/sh/concert.html" ontouchstart=""><i class="icon icon-class"></i><span
                            class="txt">演出分类</span></a>
                <a class="itm" href="/near.aspx" ontouchstart=""><i class="icon icon-near"></i><span class="txt">附近演出</span></a>
                <a class="itm" href="/showcalendar.aspx" ontouchstart=""><i class="icon icon-cal"></i><span
                            class="txt">演出日历</span></a>
                <a class="itm" href="/userinfo.aspx" ontouchstart=""><i class="icon icon-mine"></i><span class="txt">我的大麦</span></a>
            </div>
            <div class="ops">
                <a class="u-btn u-btn-c1" href="/login.aspx" ontouchstart="">登录</a>
                <a class="u-btn u-btn-c1" href="/reg.aspx" ontouchstart="">注册</a>
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
    </div>
@endsection

@section('js')
@endsection
