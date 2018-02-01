
    (function ($) {
        var doc = document, win = window;
        var pageTimer = {};
        init();

        function init() {
            // 搜索
            mSch();
            // 轮播图
            mFocus();
            // 分类
            //mClass();
            // 侧栏菜单
            mSdmenu();
            // 城市选择
            //mCitylst();
            // 浮动广告
            //mFixad();
            $('a.u-btn-more').on('tap', function () {
                $.post('/citylist.aspx', { id: 0 }, function () {
                    window.location.href = "/";
                }, 'text');
            });

            //添加客服界面触发
            $('#kefu').on('tap', function () {
                openCustomService();
            });
            $('#nologinp').on('tap', function () {
                location.href = loginUrl;
            });
            document.addEventListener('visibilitychange', function () {
                if (document.visibilityState == "visible") {
                    loadJP();
                } else {
                    //清理定时器
                    for (var each in pageTimer) {
                        clearInterval(pageTimer[each]);
                    }
                }
            }, false);
            loadJP();
            //预订登记
            $('#bookReg').on('tap', function () {
                $('#br_layer,.m-mask').removeClass('z-hide').addClass('z-show');
            });
            $('#hidelayer').on('touchend', function (e) { $('#br_layer,.m-mask').removeClass('z-show').addClass('z-hide');$('#br_tel').blur(); e.preventDefault(); });
            $('#btnSendbr').on('touchend', function () {
                var $this = $(this);
                var id = $this.data('rel');
                var mobile = $.trim($('#br_tel').val());
                if (/^(13|14|15|17|18)\d{9}$/.test(mobile)) {
                    $.ajax({
                        cache: false,
                        type: "get",
                        url: "/ajax.aspx?_action=RegistrationOrder",
                        data: { pid: id, mobile: mobile, t: 1 },
                        dataType: "json",
                        timeout: 30 * 1000,
                        success: function (json) {
                            showTips(json.error);
                            $('#br_layer,.m-mask').removeClass('z-show').addClass('z-hide');
                        }, error: function () { }, complete: function () { }
                    });
                }
                else {
                    alert('请输入正确的手机号');
                }
            });
        }

        // 搜索
        function mSch() {
            var $mnav = $('.m-nav');
            var $msch = $('.m-sch');
            var $btn_sch = $mnav.find('.u-btn-sch');
            var $btn_cancel = $msch.find('.u-btn-cancel');
            var $ipt_sch = $msch.find('.u-ipt');
            var clientHeight = doc.documentElement.clientHeight;
            var st = 0;

            var $hislist = $('#hislist');
            var $showhis = $('#showhis');

            $btn_sch.on('touchend', function (e) {
                st = $(win).scrollTop();
                $msch.removeClass('z-hide').addClass('z-show');
                //$('.g-doc').css({ 'visibility': 'hidden' });
                $('html, body').css({ 'height': clientHeight, 'overflow': 'hidden' });
                $ipt_sch.val('');
                $('#showser').hide();
                var his = localStorage.getItem("m_history");
                if (his) {
                    try {
                        var h = JSON.parse(his);
                        var hi = h.length;
                        $hislist.empty();
                        for (var i = 0; i < hi; i++) {
                            if (i > 4) { break; }
                            $('<span class="itm">' + h[i] + '</span>').appendTo($hislist);
                        }
                        if (hi > 0) { $showhis.show(); }
                    }
                    catch (e) { }
                }
                document.getElementById('searchKey').focus();
                e.preventDefault();
            });

            $btn_cancel.on('touchend', function (e) {
                e.preventDefault();
                $msch.removeClass('z-show').addClass('z-hide');
                $('html, body').css({ 'height': 'auto', 'overflow': 'auto' });
                $('.g-doc').css({ 'visibility': 'visible' });
                $(win).scrollTop(st);
                $ipt_sch.blur();
            });

            $ipt_sch.on('focus', function () {
                var $this = $(this);
                $this.parents('.sch').addClass('z-crt');
            }).on('input', function (e) {
                var $this = $(this);
                var k = $this.val();
                if (k != null && k.length > 0) {
                    $('#showhis').hide();
                    suggest(k);
                }
            }).on('keydown', function (e) {
                if (e.keyCode == 13) {
                    gotoSerach(); e.preventDefault();
                }
            });

            $ipt_sch.on('blur', function (e) {
                var $this = $(this);
                if (!$(this).val()) $(this).parents('.sch').removeClass('z-crt');
                //e.preventDefault();
            });
            $('#clhis').on('tap', function (e) {
                $showhis.hide();
                localStorage.removeItem("m_history");
            });


            $('#hislist').on('tap', 'span', function (e) {
                $('#showhis').hide();
                $ipt_sch.val($(this).text());
                gotoSerach();
            })
            $('#btns').on('tap', function (e) {
                gotoSerach();
            });
            $('#seResult').on('tap', 'li.itm', function () {
                var id = $(this).children('a.name').attr('ref');
                win.location.href = "/ticket/" + id + ".html";
            });
        }

        // 轮播图
        function mFocus() {
            if ($('.m-focus').size()) {
                var mySwiper = new Swiper('.m-focus', {
                    autoplay: 5000,
                    visibilityFullFit: true,
                    loop: true,
                    pagination: '.m-focus .nav',
                    onTransitionStart: function (swiper) {
                        swiper.stopAutoplay();
                    },
                    onTransitionEnd: function (swiper) {
                        swiper.startAutoplay();
                    }
                });
            }
        }

        // 分类
        function mClass() {
            if ($('.m-class').size()) {
                var mySwiper = new Swiper('.m-class .lst', {
                    freeMode: true,
                    slidesPerView: 'auto'
                });
            }
        }

        // 侧栏菜单
        function mSdmenu() {
            var $mask = $('.m-mask');
            var $sdmenu = $('.m-sdmenu');
            var $btnmenu = $('.u-btn-menu');

            $btnmenu.on('tap', function () {
                if ($btnmenu.hasClass('z-show')) {
                    hide();
                } else {
                    show();
                }
            });
            if ($mask.attr("ref") != "no") { $mask.on('touchend', hide); }

            function show() {
                $btnmenu.addClass('z-show');
                $mask.removeClass('z-hide').addClass('z-show');
                $sdmenu.removeClass('z-hide').addClass('z-show');
            }

            function hide(ev) {
                var ev = ev || window.event;
                $btnmenu.removeClass('z-show');
                $mask.removeClass('z-show').addClass('z-hide');
                $sdmenu.removeClass('z-show').addClass('z-hide');
                ev.preventDefault();
            }
        }

        // 城市选择
        function mCitylst() {
            $('span.city').on('tap', function () { window.location.href = "/citylist.html?from=" + encodeURI('/') });
        }

        // 浮动广告
        function mFixad() {
            if ($('.m-fixad').size()) {
                var $layer = $('.m-fixad');
                var $close = $layer.find('.u-btn-close');

                $close.on('touchend', function (ev) {
                    var ev = ev || window.event;
                    $layer.removeClass('z-show').addClass('z-hide');
                    ev.preventDefault();
                });
            }
        }
        //联想搜索
        function suggest(k) {
            $('#showser').show();
            $.ajax({
                cache: false,
                type: "get",
                url: "http://search.damai.cn/suggest.html?keyword=" + encodeURI(k),
                dataType: "jsonp",
                jsonp: "callback",
                jsonpCallback: "suggestJsonp",
                success: function (json) {
                    var $seResult = $('#seResult');
                    $seResult.empty();
                    for (var i = 0, j = json.suggests.length; i < j; i++) {
                        var id = json.suggests[i].id.split('_')[2];
                        $('<li class="itm"><a class="name" ref="' + id + '" href="javascript:void(0);">' + json.suggests[i].name + '</a><a class="city" href="javascript:void(0);">' + json.suggests[i].cityname + '</a></li>').appendTo($seResult);
                    }
                }
            });
        }
        //跳转搜索
        function gotoSerach() {
            var k = $.trim($('#searchKey').val());
            if (k != null && k.length > 0) {
                try{
                    var s = [];
                    var his = localStorage.getItem("m_history");
                    if (his) {
                        var h = JSON.parse(his);
                        s.push(k);
                        var max = 3;
                        for (var i = 0, hi = h.length; i < hi; i++) {
                            if (h[i] == k) { max++; continue; }
                            s.push(h[i]);
                            if (i > max) { break; }
                        }
                    }
                    else {
                        s.push(k);
                    }
                    localStorage.setItem("m_history", JSON.stringify(s));
                }catch(e){
                } setTimeout(function () {
                    win.location.href = "/so.aspx?word=" + encodeURIComponent(k);
                }, 0);
            }
            return false;
        }

        //function openChat(CurrUserInfo)
        //{

        //    NTKF.im_openInPageChat('dm_1000_9999');
        //}

        function openCustomService()
        {
            var ret = /userloginkey=[^;]*/gi.test(document.cookie);
            if (ret) {
                NTKF.im_openInPageChat('dm_1000_9999');
            } else {
                location.href = loginUrl;
            }
        }
        var isloading = false;
        //获取先付先抢信息
        function loadJP() {
            if (isloading) { return; }
            isloading = true;
            var $jp = $('#jpResult');
            $jp.empty();
            if ($jp.size() > 0) {
                var u = $jp.data('url');
                if (u.length == 0) { return; }
                var changetime = null, starttime = null, endtime = null;
                var groups = null, orders = null;
                $.ajax({
                    cache: false,
                    type: "get",
                    url: "/ajax.aspx?_action=QueryJP&" + u,
                    dataType: "json",
                    timeout: 30 * 1000,
                    success: function (json) {
                        if (json.status == 200) {
                            var db = json.data;
                            orders = db.orders;
                            if (orders != null && orders.length > 0) {
                                len = orders.length;
                                var orderHtml = new Array(), firstRanking = 0;
                                for (var i = 0; i < orders.length; i++) {
                                    var itm = orders[i];
                                    var prices = [];
                                    for (var p in itm.prices) {
                                        prices[p] = parseFloat(itm.prices[p].price).toFixed(2) + "(" + itm.prices[p].count + "张)";
                                    }
                                    if (itm.status == 1 && firstRanking == 0) {
                                        firstRanking = itm.ranking;
                                    }
                                    orderHtml.push('<p style="padding:1rem 1.25rem;">订单号：' + itm.orderSn + '<span class="m_fr">' + prices.join('<br />') + '</span></p>');
                                    var groupinfo='<p class="m_fr pb10 m_f14 pr10 m_c999">您的分组：' + itm.groupName + '</p>';
                                    if (itm.status == 0) {
                                        orderHtml.push('<p class="m_new_timer" id="cd_' + itm.orderSn + '"><span class="m_new_tanhao"></span>抢座已完成</p>')
                                        orderHtml.push(groupinfo);
                                        orderHtml.push('<div class="clear" style="padding:0 1.25rem"><a class="m_new_u-btn u-btn-c2" href="/pay/order.aspx?id=' + itm.orderSn + '" style="padding:0; min-height:0; display:-webkit-box;">查看订单</a></div>');
                                    } else {
                                        if (itm.seatStatus > 0) {
                                            orderHtml.push('<p class="m_new_timer" id="cd_' + itm.orderSn + '"><span class="m_new_tanhao"></span>抢座结束时间：' + itm.endTime + '</p>');
                                            orderHtml.push(groupinfo);
                                            orderHtml.push('<div class="clear" style="padding:0 1.25rem"><a class="m_new_u-btn u-btn-c2" href="' + itm.seatAddress + '" style="padding:0; min-height:0; display:-webkit-box;">进场选座</a></div>');
                                        } else {
                                            orderHtml.push('<p class="m_new_timer" id="cd_' + itm.orderSn + '"><span class="m_new_tanhao"></span>进场时间：' + itm.startTime + '</p>');
                                            orderHtml.push(groupinfo);
                                            if (itm.st > 0) {
                                                //加载倒计时
                                                jpCountDown(itm.orderSn, itm.st, itm.endTime,i);
                                            }
                                            orderHtml.push('<div class="clear" style="padding:0 1.25rem"><a class="m_new_u-btn u-btn-c2-on" href="javascript:;" style="padding:0; min-height:0; display:-webkit-box;">等待进场</a></div>');
                                        }
                                    }
                                }
                                $(orderHtml.join('')).appendTo($jp);
                            }
                        }
                    }, error: function () { }, complete: function () { isloading = false; }
                })
            }
        }
        function jpCountDown(sn, intDiff, time, index) {
            pageTimer['qztime_' + index] = setInterval(function () {
                if (intDiff > 0) {
                    var day = 0, hour = 0, minute = 0, second = 0;
                    day = Math.floor(intDiff / (60 * 60 * 24));
                    hour = Math.floor(intDiff / (60 * 60)) - (day * 24);
                    minute = Math.floor(intDiff / 60) - (day * 24 * 60) - (hour * 60);
                    second = Math.floor(intDiff) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
                    if (minute <= 9) { minute = '0' + minute; }
                    if (second <= 9) { second = '0' + second; }
                    $('#cd_' + sn).html('<span class="m_new_qztime"></span>距抢座开始：' + (hour + day * 24) + '小时' + minute + '分' + second + '秒');
                    intDiff--;
                } else {
                    clearInterval(pageTimer['qztime_' + index]);
                    loadJP();
                    $('#cd_' + sn).html('<span class="m_new_tanhao"></span>抢座结束时间：' + time + '');
                }
            }, 1000);
        }
        function showTips(msg) {
            var $tips = $('#tips');
            $tips.html(msg);
            $tips.show(800);
            setTimeout(function () {
                $tips.empty().hide(500);
            }, 2000);
        }
    })(Zepto);
