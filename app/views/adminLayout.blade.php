<!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>family tree chart</title>
  <meta name="description" content="后台管理页面">
  <meta name="keywords" content="user">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link rel="icon" type="image/png" href="{{asset('i')}}/favicon.png">
  <link rel="apple-touch-icon-precomposed" href="{{asset('i')}}/app-icon72x72@2x.png">
  <meta name="apple-mobile-web-app-title" content="Amaze UI" />
  <link rel="stylesheet" href="{{asset('css')}}/amazeui.css"/>
  <link rel="stylesheet" href="{{asset('css')}}/admin.css">
  <link rel="stylesheet" href="{{asset('jquery.mCustomScrollbar')}}/jquery.mCustomScrollbar.css">
  @yield('css')
</head>
<body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
<![endif]-->

<header class="am-topbar am-topbar-inverse admin-header">
  <div class="am-topbar-brand">
    <strong>Family tree chart</strong>
  </div>

  <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

  <div class="am-collapse am-topbar-collapse" id="topbar-collapse">
    <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">
      <li class="am-dropdown" id="family_switch" data-am-dropdown>
        <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
          <span class="am-icon-users"></span> <span id="family_current">父系家族</span> <span class="am-icon-caret-down"></span>
        </a>
        <ul class="am-dropdown-content">
          <li><a href="#"><span class="am-icon-check"></span> 父系家族</a></li>
          <li><a href="#"><span class="am-icon-check" style="opacity: 0;"></span> 母系家族</a></li>
        </ul>
      </li>
      <li><a href="javascript:;"><span class="am-icon-envelope-o"></span> 收件箱 <span class="am-badge am-badge-warning">5</span></a></li>
      <li class="am-dropdown" data-am-dropdown>
        <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
          <span class="am-icon-user"></span> {{ Auth::user()->name }} <span class="am-icon-caret-down"></span>
        </a>
        <ul class="am-dropdown-content">
          <li><a href="{{ url('member/edit') }}"><span class="am-icon-user"></span> 个人信息</a></li>
          <li><a href="{{ url('member/edit') }}"><span class="am-icon-cog"></span> 系统设置</a></li>
          <li><a href="{{ url('logout') }}"><span class="am-icon-power-off"></span> 退出</a></li>
        </ul>
      </li>
      <li class="am-hide-sm-only"><a href="javascript:;" id="admin-fullscreen"><span class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a></li>
    </ul>
  </div>
</header>

<div class="am-cf admin-main">
  <!-- sidebar start -->
  <div class="admin-sidebar am-offcanvas" id="admin-offcanvas">
    <div class="am-offcanvas-bar admin-offcanvas-bar">
      <ul class="am-list admin-sidebar-list">
        <li @if(URL::current() == url('family')) class="active" @endif><a href="{{ url('family') }}"><span class="am-icon-home"></span> 首页</a></li>
        <li @if(URL::current() == url('familyPicture')) class="active" @endif><a href="{{ url('familyPicture') }}"><span class="am-icon-th"></span> 家族相册</a></li>
        <li @if(URL::current() == url('familyBiography')) class="active" @endif><a href="{{ url('familyBiography') }}"><span class="am-icon-pencil-square-o"></span> 家族传记</a></li>
        <li @if(URL::current() == url('familyNews')) class="active" @endif><a href="{{ url('familyNews') }}"><span class="am-icon-newspaper-o"></span> 家族新闻</a></li>
        <li @if(URL::current() == url('familyNotice')) class="active" @endif><a href="{{ url('familyNotice') }}"><span class="am-icon-bullhorn"></span> 家族公告<span class="am-badge am-badge-secondary am-margin-right am-fr">24</span></a></li>
        <li @if(URL::current() == url('sysNotice')) class="active" @endif><a href="{{ url('sysNotice') }}"><span class="am-icon-puzzle-piece"></span> 帮助</a></li>
        <li><a href="{{ url('logout') }}"><span class="am-icon-sign-out"></span> 注销</a></li>
      </ul>

      <div class="am-panel am-panel-default admin-sidebar-panel">
        <div class="am-panel-bd">
          <p><span class="am-icon-tag"></span> 家族动态</p>
          <p>2017年6月4日 17:11:03<br/> 齐元举更新了家族相册！</p>
          <p>2017年6月4日 17:11:03<br/> 齐元举更新了家族传记！</p>
          <p>2017年6月4日 17:11:03<br/> 齐元举添加了家庭成员！</p>
          <div class="am-list-news-ft">
              <a class="am-list-news-more am-btn am-btn-default " href="###">查看更多 &raquo;</a>
          </div>
        </div>
        
      </div>
      
      <div class="am-panel am-panel-default admin-sidebar-panel">
        <div class="am-panel-bd">
          <p><span class="am-icon-bookmark"></span> 公告</p>
          <p>
            系统升级2.0.1：<br/>
            新增家普导出功能！<br/>
            修复了添加成员时的bug！<br/>
          </p>
          <div class="am-list-news-ft">
            <a class="am-list-news-more am-btn am-btn-default " href="###">查看更多 &raquo;</a>
          </div>
        </div>
      </div>

    </div>
  </div>
  <!-- sidebar end -->

  <!-- content start -->
  @yield('content')
  <!-- content end -->

</div>

<a href="#" class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>

<footer>
  <hr>
  <p class="am-padding-left">© 2014 AllMobilize, Inc. Licensed under MIT license.</p>
</footer>

<!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="{{asset('js')}}/amazeui.ie8polyfill.min.js"></script>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="{{asset('js')}}/jquery.min.js"></script>
<!--<![endif]-->
<script src="{{asset('js')}}/amazeui.min.js"></script>
<script src="{{asset('jquery.mCustomScrollbar')}}/jquery.mCustomScrollbar.concat.min.js"></script>

<script src="{{asset('js')}}/app.js"></script>
<!-- 其他js start -->
@yield('js')
<!-- 其他js end -->
</body>
</html>
