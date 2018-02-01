@extends('frontend.master.base')

@section('title',$show->sname)
@section('css')
    <link href="{{asset('frontend/css/detail.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/m.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="container" id="container">
        <div class="pf_header details-header">
            <header class="header in" data-role="header">
                <a href="javascript:history.back()" class="icon-back"></a>
                <div class="nav-wrap-right">
                    <a class="JC-icon-search" id="share" ><span class="iconFonts-share1"></span></a>
                </div>
            </header>
        </div>

        <div class="main">
            <div class="m_cinema">
                <div class="details_bg"></div>
                <div class="blur_bg"></div>
                <div class="blurBox">
                    <img class="deta_blur" src="{{ $show->spic }}">
                </div>
            </div>
            <div class="details-item">
                <div class="deal">
                    <div class="poster">
                        <img src="{{ $show->spic }}"></div>
                    <div class="deal_info">
                        <h2>{{ $show->sname }}</h2>
                        <div class="stars-score">
                        <span class="stars">
                            <img src="frontend/images/starYellow.f162e39a.png">
                            <img src="frontend/images/starYellow.f162e39a.png">
                            <img src="frontend/images/starYellow.f162e39a.png">
                            <img src="frontend/images/starYellow.f162e39a.png">
                            <img src="frontend/images/starYellow.f162e39a.png">
                        </span>
                            <span class="score">9.6</span>
                        </div>
                        <div class="tags">
                            <span class="tag tag-c1">座</span>
                            <span class="tag tag-c2">{{ $show->status =='1' ? '销售中' : '已下线' }}</span>
                            <span class="tag tag-c2"><a href="{{ URL('/list?cate='.$show->cid) }}">{{ $show->cname }}</a></span>
                        </div>

                        <div class="concern-comment">
                            <div class="concern" style="display: block;">
                                <img src="frontend/images/detailConcern.3dfff333.png">
                                <span>想看</span>
                            </div>
                            <div class="comment" style="display: block;">
                                <img src="frontend/images/review.5d6671dc.png">
                                <span>评论</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="review clearfix" id="discount_info">
                    <span class="icons-semicircle semicircle-left"></span>
                    <span class="icons-semicircle semicircle-right"></span>
                    <span class="review_ico"><b class="arrow arrow-left"></b>活动</span>
                    <div class="review_txt"><p>会员提前购买享9折优惠</p></div>
                </div>
            </div>
        </div>

        <div class="bottom-container">
            <div class="bottom-btn">立即购买</div>
        </div>

        <div class="header">
            <div class="price-postageTip">
                <div class="price-info">
                    <span class="unit">¥</span>
                    <span class="price">{{ $show->price }}</span>
                    <span class="qi">起</span>
                </div>
                <div class="postage-tip">
                    <span class="content">快递： 满199包邮</span>
                </div>
            </div>
            <div class="postage-promotion">
                <ul><a href="">
                        <li>
                            <span class="inner-icon">促</span>
                            <span class="desc">豪礼大放送，演唱会首单立减30元！</span>
                        </li>
                    </a></ul>
            </div>
            <div class="time">
                <img class="icon" src="frontend/images/icon-calendar.284f7a6a.png">
                {{ $show->stime }}</div>
            <div class="venue">
                <img class="icon" src="frontend/images/detailVenueIcon.b40f2d0d.png">
                <div class="name">{{ $show->vaddr }}</div>
                <div class="arr-right"></div>
            </div>

            <div class="credit">
                <img class="credit-icon" src="frontend/images/iconCredit.27223208.png">
                <span class="text">保证有票</span>
                <img class="credit-icon" src="frontend/images/iconCredit.27223208.png">
                <span class="text">100%真票</span>
                <img class="credit-icon" src="frontend/images/iconCredit.27223208.png">
                <span class="text">担保交易</span>
                <div class="arr-right"></div>
            </div>
        </div>
        <div class="sections" style="margin-bottom: 10px;">

            <div class="section">
                <div class="section-title">
                    <div class="text">购买须知</div>
                </div>
                <div class="content">儿童入场提示：1.2米以下儿童谢绝入场（儿童项目除外），1.2米以上儿童需持票入场。</div>
            </div>

            <div class="section">
                <div class="section-title">
                    <div class="text introduction">演出简介</div>
                    <div class="arr-right"></div>
                </div>
                <div class="content">{{ strip_tags($show->sdesc) }}</div>
            </div>

            <div class="section tour">
                <div class="section-title">
                    巡演信息
                </div>
                <div class="content">
                    <a href="/activity/detail.html?id=1343">
                        <div class="tour-item ">
                            <div class="city">上海</div>
                            <div class="time">2016.05.07</div>
                        </div>
                    </a>

                    <a href="/activity/detail.html?id=3549">
                        <div class="tour-item ">
                            <div class="city">杭州</div>
                            <div class="time">2016.05.14</div>
                        </div>
                    </a>

                    <a href="/activity/detail.html?id=3207">
                        <div class="tour-item ">
                            <div class="city">天津</div>
                            <div class="time">2016.05.28</div>
                        </div>
                    </a>

                    <a href="/activity/detail.html?id=4990">
                        <div class="tour-item ">
                            <div class="city">成都</div>
                            <div class="time">2016.06.24</div>
                        </div>
                    </a>

                    <a href="/activity/detail.html?id=4875">
                        <div class="tour-item ">
                            <div class="city">贵阳</div>
                            <div class="time">2016.07.02</div>
                        </div>
                    </a>

                    <a href="/activity/detail.html?id=5202">
                        <div class="tour-item ">
                            <div class="city">南昌</div>
                            <div class="time">2016.07.09</div>
                        </div>
                    </a>

                    <a href="javascript:;">
                        <div class="tour-item selected">
                            <div class="city">苏州</div>
                            <div class="time">2016.09.17</div>
                        </div>
                    </a>

                    <a href="/activity/detail.html?id=8345">
                        <div class="tour-item ">
                            <div class="city">合肥</div>
                            <div class="time">2016.09.24</div>
                        </div>
                    </a>

                    <a href="/activity/detail.html?id=2270">
                        <div class="tour-item ">
                            <div class="city">北京</div>
                            <div class="time">2016.10.21</div>
                        </div>
                    </a>
                </div>
            </div></div>

        <div class="detail-comment-container" style="display: block;">
            <div class="detail-commnet-header">
                <div class="text">所有评论(<span>{{ getTotalComment($show->sid) }}</span>)</div>
                <div class="arr-right"><a href="{{ URL('/comment-'.$show->sid) }}">我要评论</a></div>
            </div>
            <div class="list-container">
                <div class="scroll-container">
                    <ul>
                        @foreach($comments as $k=>$v)
                            <div class="list-item-container" style="display: block;">
                                <div class="user-portrait-container">
                                    <div class="user-head-portrait"> <img class="head-icon" src="{{ $v->uface }}" width="80">
                                        <div class="user-level">
                                            <div class="text"><span>V</span><small>{{ $v->level }}</small></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="comment-container">
                                    <div class="comment-header"> <span class="user-name">{{ $v->uname }}</span> <span class="stars">
                                <img src="frontend/images/starYellow.f162e39a.png">
                                <img src="frontend/images/starYellow.f162e39a.png">
                                <img src="frontend/images/starYellow.f162e39a.png">
                                <img src="frontend/images/starYellow.f162e39a.png">
                                <img src="frontend/images/starGrey.e1e260db.png"></span> </div>
                                    <div>{{ $v->content }}</div>
                                    <div class="comment-imgs"></div>
                                    <div class="comment-activity-container" style="display: none;"> <img class="activity-poster" src="http://img.piaoniu.com/20160412175124/99047_n.jpg">
                                        <div class="activity-name">2016陈奕迅Another Eason's Life演唱会-苏州站</div>
                                    </div>
                                    <div class="bottom">
                                        <div class="publish-time">{{ $v->created_at }}</div>
                                        <div class="interaction">
                                    <span class="interaction-comment">
                                    <img class="comment-icon" src="frontend/images/feedback.bbf3702d.png"> <span class="comment-num">评论</span> </span>
                                    <span class="support-container"> <img class="support-icon" src="frontend/images/support.b10b9247.png">
                                        <span class="support-num">1</span> </span>
                                    <span class="modify-container"> <img class="modify-icon" src="frontend/images/modifyIcon.ae523888.png">
                                        <span class="modify-content">编辑</span> </span> </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="show-all-comment">查看全部评论</div>
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
