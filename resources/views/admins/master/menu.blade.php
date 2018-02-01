<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="nav-close"><i class="fa fa-times-circle"></i></div>
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span>
                        <img class="img-circle" src="{{ URL(Session::get('admin')['face']) }}" width="64">
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                               <span class="block m-t-xs">
                                   <strong class="font-bold">{{ Session::get('admin')['aname'] }}</strong>
                               </span>
                                <span class="text-muted text-xs block">
                                    {{ Session::get('admin')['auth'] == '1' ? '普通管理员' : '超级管理员' }}<b class="caret"></b>
                                </span>
                                </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="J_menuItem" href="">修改头像</a>
                        </li>
                        <li><a class="J_menuItem" href="">个人资料</a>
                        </li>
                        <li><a class="J_menuItem" href="">联系我们</a>
                        </li>
                        <li><a class="J_menuItem" href="">信箱</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{ URL('/admin/login/logout') }}">安全退出</a>
                        </li>
                    </ul>
                </div>
                <div class="logo-element">H+
                </div>
            </li>
            <li>
                <a class="J_menuItem" href="{{ URL('admin/show') }}">
                    <i class="fa fa-cutlery"></i>
                    <span class="nav-label">演出管理</span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ URL('admin/show') }}" data-index="0">演出列表</a>
                    </li>
                    <li>
                        <a href="{{ URL('admin/show/create') }}">演出添加</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="J_menuItem" href="{{ URL('admin/cate') }}">
                    <i class="fa fa-cutlery"></i>
                    <span class="nav-label">类别管理</span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ URL('admin/cate') }}" data-index="0">类别列表</a>
                    </li>
                    <li>
                        <a href="{{ URL('admin/cate/create') }}">类别添加</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="J_menuItem" href="{{ URL('admin/venues') }}">
                    <i class="fa fa-cutlery"></i>
                    <span class="nav-label">场馆管理</span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ URL('admin/venue') }}" data-index="0">场馆列表</a>
                    </li>
                    <li>
                        <a href="{{ URL('admin/venue/create') }}">场馆添加</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="J_menuItem" href="{{ URL('admin/good') }}">
                    <i class="fa fa-cutlery"></i>
                    <span class="nav-label">商品管理</span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ URL('admin/good') }}" data-index="0">商品列表</a>
                    </li>
                    <li>
                        <a href="{{ URL('admin/good/create') }}">商品添加</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="J_menuItem" href="{{ URL('admin/admin') }}">
                    <i class="fa fa-cutlery"></i>
                    <span class="nav-label">管理员</span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ URL('admin/admin') }}" data-index="0">管理员列表</a>
                    </li>
                    <li>
                        <a href="{{ URL('admin/admin/create') }}">管理员添加</a>
                    </li>
                </ul>
            </li>


            <li>
                <a class="J_menuItem" href="layouts.html">
                    <i class="fa fa-columns"></i>
                    <span class="nav-label">用户管理</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa fa-bar-chart-o"></i>
                    <span class="nav-label">订单管理</span>
                    <span class="label label-warning pull-right">16</span>
                </a>
            </li>
            <li>
                <a href="mailbox.html">
                    <i class="fa fa-envelope"></i>
                    <span class="nav-label">购物车管理</span>
                </a>
                <ul class="nav nav-second-level">
                    <li><a class="J_menuItem" href="mailbox.html">收件箱</a>
                    </li>
                    <li><a class="J_menuItem" href="mail_detail.html">查看邮件</a>
                    </li>
                    <li><a class="J_menuItem" href="mail_compose.html">写信</a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</nav>