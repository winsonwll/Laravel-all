$(function () {
    var doc = document, win = window;
    var pageTimer = {};
    var params = {
        ajax: 1,
        act: 'getActivity',
        city: $('#city').val(),
        frontCate: '',								//分类编号（eg：4000,5000）
        actTime: '',								//活动时间
        order: '',									//排序（1：销量，2：人气）
        page: 1,									//分页页码，默认是1
    };

    init();

    function init() {
        // 搜索
        mSch();

        // 轮播图
        mFocus();

        // 猜你喜欢
        mClass();

        // 侧栏菜单
        mSdmenu();


        //日历
        moment.locale('cn', {
            months : ["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
        });
        $( "#datepicker" ).clndr({
            daysOfTheWeek: ['日', '一', '二', '三', '四', '五', '六'],
            constraints: {
                startDate: moment().add('days', -1),
                endDate: moment().add('years',1)
            },
            clickEvents : {
                click: function(target){
                    var $this = $(target.element);
                    if ($this.hasClass('inactive'))
                        return false;
                    $this.toggleClass('selected');

                    $('.calendar').removeClass('cur').find('.packUp').removeClass('packUp');
                    $('.searchResult .list-group').removeClass('sel');


                    if ($this.hasClass('selected')) {
                        params.actTime = target.date._i;
                        $( "#datepicker .day").not($this).removeClass('selected');
                    } else {
                        params.actTime = '';
                    }
                    //loadEvents();
                }
            }
        });

        //点击关闭按钮
        $(".openBtnLi").click(function(){
            $(".searchResult .list-group").removeClass("sel");
            //$(".shaix li").removeClass("cur");
            $(".shaix .categoryIcon").removeClass("packUp")	;

        });


        $(".list-group-item").click(function(){
            $(".searchResult .list-group").removeClass("sel");
            $(".shaix li").removeClass("cur");
            $(".shaix .categoryIcon").removeClass("packUp")	;
        });

        //筛选置顶
        $(window).on('scroll', function(){
            var top = $(this).scrollTop();
            var headerHeight = $('.m-nav').height();

            if(top<headerHeight/2){
                $('.searchResult').fadeOut();
            }else{
                $('.shaixBox').css('top',headerHeight);
                $('.searchResult').fadeIn();
            }

        });

        imgSwitch(".shaix li",".shaix .categoryIcon","packUp",".searchResult .list-group","sel");
        dropDown(".searchResult .list-group .list-group-item:not(.openBtnLi)","cur");
        init2();
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

    // 猜你喜欢
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

    //筛选置顶
    function init2() {
        $('.all-cates .list-group-item').each(function(){
            if ($(this).data('cat') == $('#curEvent').val()) {
                $(this).trigger('click');
            }
        });
    }

    //按钮切换效果
    function imgSwitch(imgSwitch1,imgSwitch2,imgSwitch3,imgSwitch4,imgSwitch5){
        $(imgSwitch1).click(function(){
            var n = $(imgSwitch1).index(this);
            if($(imgSwitch2).eq(n).hasClass(imgSwitch3)){
                $(imgSwitch1).removeClass("cur");
                $(imgSwitch2).removeClass(imgSwitch3);
                $(imgSwitch4).removeClass(imgSwitch5);
            }else{
                $(imgSwitch1).removeClass("cur");
                $(this).addClass("cur");
                $(imgSwitch2).removeClass(imgSwitch3);
                $(imgSwitch2).eq(n).addClass(imgSwitch3);
                $(imgSwitch4).removeClass(imgSwitch5);
                $(imgSwitch4).eq(n).addClass(imgSwitch5);
            }

        });
    }

    function dropDown(dropDown1,dropDown2){
        $(dropDown1).click(function(){
            $(dropDown1).removeClass(dropDown2);
            $(this).addClass(dropDown2);
            if ($(this).hasClass('cur')) {
                if ($(this).data('cat') != undefined) {
                    params.frontCate = $(this).data('cat');
                    $('.allClassification .t').html($(this).html());
                }
                if ($(this).data('order') != undefined) {
                    params.order = $(this).data('order');
                    $('.sort .t').addClass('test').html($(this).html());
                }
                //loadEvents();
            }
        });
    }

});