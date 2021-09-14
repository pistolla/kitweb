<!DOCTYPE html>
<html lang="en">

<head>
<title>{{$gnl->title}} - Admin</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/logo/icon.png')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/css/main.css') }}"> @yield('page_styles')
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-EQRHM67XW4"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-EQRHM67XW4');
</script>
</head>

<body class="app sidebar-mini rtl">
<header class="app-header">
<a class="app-header__logo" href="{{route('admin.dashboard')}}">
<img src="{{asset('/images/logo/logo.png')}}" alt="logo" class="logo-default" style="width: 230px; height: 50px;"> </a>
<a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
<ul class="app-nav">
<li class="dropdown">
<a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">
<span>{{Auth::guard('admin')->user()->name}}</span> <i class="fa fa-user fa-lg"></i>
</a>
<ul class="dropdown-menu settings-menu dropdown-menu-right">
<li><a class="dropdown-item" href="{{route('admin.new-admin')}}"><i class="fa fa-user fa-lg"></i>Create New Admin </a></li>
<li><a class="dropdown-item" href="{{route('admin.list-admin')}}"><i class="fa fa-users fa-lg"></i>List of Admin </a></li>
<li><a class="dropdown-item" href="{{route('admin.change-password')}}"><i class="fa fa-cog fa-lg"></i> Change Password </a></li>

<li>
<a class="dropdown-item" href="#" onclick="event.preventDefault();
document.getElementById('logout-form').submit();">
<i class="fa fa-sign-out fa-lg"></i> Logout
</a>

<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
@csrf
</form>
</li>
</ul>
</li>
</ul>
</header>
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
<ul class="app-menu">
<li>
<a class="app-menu__item @if(request()->path() == 'admin/dashboard') active @endif" href="{{route('admin.dashboard')}}">
<i class="app-menu__icon fa fa-dashboard"></i>
<span class="app-menu__label">Dashboard</span></a>
</li>
<li class="treeview @if(request()->path() == 'admin/users') is-expanded
@elseif(request()->path() == 'admin/user-search') is-expanded
@elseif(request()->path() == 'admin/user-banned') is-expanded
@endif">
<a class="app-menu__item" href="#" data-toggle="treeview">
<i class="app-menu__icon fa fa-users"></i>
<span class="app-menu__label">Manage Advertisers</span>
<i class="treeview-indicator fa fa-angle-right"></i>
</a>
<ul class="treeview-menu">
<li>
<a class="treeview-item  @if(request()->path() == 'admin/users') active @endif" href="{{route('admin.users')}}">
<i class="icon fa fa-users"></i> All Advertisers</a>
</li>

<li>
<a class="treeview-item @if(request()->path() == 'admin/user-banned') active @endif" href="{{route('admin.user-ban')}}">
<i class="icon fa fa-users" style="color:brown;"></i> Banned Advertisers</a>
</li>

</ul>
</li>
<li class="treeview @if(request()->path() == 'admin/publishers') is-expanded
@elseif(request()->path() == 'admin/publisher-search') is-expanded
@elseif(request()->path() == 'admin/publisher-banned') is-expanded
@endif">
<a class="app-menu__item" href="#" data-toggle="treeview">
<i class="app-menu__icon fa fa-bullhorn"></i>
<span class="app-menu__label">Manage Publishers</span>
<i class="treeview-indicator fa fa-angle-right"></i>
</a>
<ul class="treeview-menu">
<li>
<a class="treeview-item  @if(request()->path() == 'admin/publishers') active @endif" href="{{route('admin.publishers')}}">
<i class="icon fa fa-users"></i> All Publishers</a>
</li>
<li>
<a class="treeview-item @if(request()->path() == 'admin/publisher-banned') active @endif" href="{{route('admin.publisher-ban')}}">
<i class="icon fa fa-users" style="color:brown;"></i> Banned Publishers</a>
</li>
</ul>
</li>
<li>
<a class="app-menu__item @if(request()->path() == 'admin/broadcast') active @endif" href="{{route('admin.broadcast')}}">
<i class="app-menu__icon fa fa-envelope"></i> <span class="app-menu__label">Broadcast Email</span></a>
</li>
<li>
<a class="app-menu__item @if(request()->path() == 'admin/subscribers') active @endif" href="{{route('admin.subscribers')}}">
<i class="app-menu__icon fa fa-file"></i> <span class="app-menu__label">Subscribers</span></a>
</li>
<li class="treeview
@if(request()->path() == 'admin/ad-types')  is-expanded
@elseif(request()->path() == 'admin/plans')  is-expanded
@endif">
<a class="app-menu__item" href="#" data-toggle="treeview">
<i class="app-menu__icon fa fa-picture-o"></i>
<span class="app-menu__label">Advertisements</span>
<i class="treeview-indicator fa fa-angle-right"></i>
</a>
<ul class="treeview-menu">
<li>
<a class="treeview-item  @if(request()->path() == 'admin/plans') active @endif" href="{{route('admin.plans')}}">
<i class="icon fa fa-cube"></i>Plans</a>
</li>
<li>
<a class="treeview-item  @if(request()->path() == 'admin/ad-types') active @endif" href="{{route('admin.adtypes')}}">
<i class="icon fa fa-picture-o"></i>Types</a>
</li>
</ul>
</li>
<li class="treeview
@if(request()->path() == 'admin/deposits')  is-expanded
@elseif(request()->path() == 'admin/gateway')  is-expanded
@endif">
<a class="app-menu__item" href="#" data-toggle="treeview">
<i class="app-menu__icon fa fa-plus"></i>
<span class="app-menu__label">Deposit</span>
<i class="treeview-indicator fa fa-angle-right"></i>
</a>
<ul class="treeview-menu">
<li>
<a class="treeview-item  @if(request()->path() == 'admin/deposits') active @endif" href="{{route('admin.deposits')}}">
<i class="icon fa fa-list"></i> Deposits</a>
</li>
<li>
<a class="treeview-item @if(request()->path() == 'admin/gateway') active @endif" href="{{route('admin.gateway')}}">
<i class="icon fa fa-credit-card"></i> Payment Gateway</a>
</li>
</ul>
</li>
<li class="treeview
@if(request()->path() == 'admin/withdraw-request') is-expanded
@elseif(request()->path() == 'admin/wmethod') is-expanded
@elseif(request()->path() == 'admin/withdraw-log') is-expanded @endif">
<a class="app-menu__item" href="#" data-toggle="treeview">
<i class="app-menu__icon fa fa-share"></i>
<span class="app-menu__label">Withdraw</span>
<i class="treeview-indicator fa fa-angle-right"></i>
</a>
<ul class="treeview-menu">
<li>
<a class="treeview-item  @if(request()->path() == 'admin/withdraw-request') active @endif" href="{{route('admin.withdraw-request')}}">
<i class="icon fa fa-share"></i> Withdraw Request</a>
</li>
<li>
<a class="treeview-item @if(request()->path() == 'admin/withdraw-log') active @endif" href="{{route('admin.withdraw-log')}}">
<i class="icon fa fa-list"></i> Withdraw Log</a>
</li>
<li>
<a class="treeview-item @if(request()->path() == 'admin/wmethod') active @endif" href="{{route('admin.wmethod')}}">
<i class="icon fa fa-credit-card"></i> Withdraw Method</a>
</li>
</ul>
</li>
<li class="treeview
@if(request()->path() == 'admin/general') is-expanded
@elseif(request()->path() == 'admin/logo-icon') is-expanded
@elseif(request()->path() == 'admin/email-sms') is-expanded @endif">
<a class="app-menu__item" href="#" data-toggle="treeview">
<i class="app-menu__icon fa fa-cogs"></i>
<span class="app-menu__label">Website Control</span>
<i class="treeview-indicator fa fa-angle-right"></i>
</a>
<ul class="treeview-menu">
<li>
<a class="treeview-item  @if(request()->path() == 'admin/general') active  @endif " href="{{route('admin.general')}}">
<i class="icon fa fa-cog"></i> General Settings</a>
</li>
<li>
<a class="treeview-item @if(request()->path() == 'admin/logo-icon') active  @endif" href="{{route('admin.logo')}}">
<i class="icon fa fa-picture-o"></i> Logo and Icon</a>
</li>
<li>
<a class="treeview-item @if(request()->path() == 'admin/eamil-sms') active @endif" href="{{route('admin.email')}}">
<i class="icon fa fa-envelope"></i> Email and SMS</a>
</li>
</ul>
</li>
<li class="treeview
@if(request()->path() == 'admin/about-section') is-expanded
@elseif(request()->path() == 'admin/banner-section') is-expanded
@elseif(request()->path() == 'admin/service-section') is-expanded
@elseif(request()->path() == 'admin/testimonial-section') is-expanded
@elseif(request()->path() == 'admin/footer-section') is-expanded
@elseif(request()->path() == 'admin/social-section') is-expanded
@elseif(request()->path() == 'admin/faq-section') is-expanded
@elseif(request()->path() == 'admin/stat-section') is-expanded
@elseif(request()->path() == 'admin/blog-section') is-expanded
@elseif(request()->path() == 'admin/blog-create') is-expanded
@endif">
<a class="app-menu__item" href="#" data-toggle="treeview">
<i class="app-menu__icon fa fa-globe"></i>
<span class="app-menu__label">Frontend Content</span>
<i class="treeview-indicator fa fa-angle-right"></i>
</a>
<ul class="treeview-menu">
<li>
<a class="treeview-item  @if(request()->path() == 'admin/banner-section') active  @endif " href="{{route('admin.bannersection')}}">
<i class="icon fa fa-cog"></i> Banner Section</a>
</li>
<li>
<a class="treeview-item  @if(request()->path() == 'admin/service-section') active  @endif " href="{{route('admin.slidersection')}}">
<i class="icon fa fa-cog"></i> Service Section</a>
</li>
<li>
<a class="treeview-item  @if(request()->path() == 'admin/about-section') active  @endif " href="{{route('admin.aboutsection')}}">
<i class="icon fa fa-cog"></i> About Section</a>
</li>
<li>
<a class="treeview-item  @if(request()->path() == 'admin/testimonial-section') active  @endif " href="{{route('admin.testimonialsection')}}">
<i class="icon fa fa-cog"></i> Testimonial Section</a>
</li>
<li>
<a class="treeview-item  @if(request()->path() == 'admin/stat-section') active  @endif " href="{{route('admin.statsection')}}">
<i class="icon fa fa-cog"></i> Statistics Section</a>
</li>
<li>
<a class="treeview-item  @if(request()->path() == 'admin/faq-section') active  @endif " href="{{route('admin.faqsection')}}">
<i class="icon fa fa-cog"></i> FAQ Section</a>
</li>
<li>
<a class="treeview-item  @if(request()->path() == 'admin/footer-section') active  @endif " href="{{route('admin.footersection')}}">
<i class="icon fa fa-cog"></i> Footer Section</a>
</li>
<li>
    <a class="treeview-item  @if(request()->path() == 'admin/blog-section') active @elseif(request()->path() == 'admin/blog-create') active  @endif " href="{{route('admin.blogsection')}}">
    <i class="icon fa fa-cog"></i> Blog Section</a>
    </li>
<li>
<a class="treeview-item  @if(request()->path() == 'admin/social-section') active  @endif " href="{{route('admin.socialsection')}}">
<i class="icon fa fa-cog"></i> Social Section</a>
</li>
<li>
<a class="treeview-item  @if(request()->path() == 'admin/social-section') active  @endif " href="{{route('admin.featuresection')}}">
<i class="icon fa fa-cog"></i> Features Section</a>
</li>

</ul>
</li>
</ul>
</aside>
<main class="app-content">
<div class="app-title">
<div>
<h1 style="text-transform:uppercase;"><i class="fa fa-dashboard"></i> {{$pt}}</h1>
</div>
<div class="app-search">
@yield('right_action')
</div>
</div>
<div class="row">
<div class="col-md-12">
@include('layouts.error') @yield('content')
</div>
</div>
</main>
<script src="{{asset('/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('/js/popper.min.js')}}"></script>
<script src="{{asset('/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/js/main.js')}}"></script>
<script src="{{asset('/js/plugins/pace.min.js')}}"></script>
<script src="{{asset('/js/plugins/bootstrap-notify.min.js')}}"></script>
@yield('page_scripts') 
@include('layouts.message')
</body>

</html>