<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Bootshop online Shopping cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--Less styles -->
    <!-- Other Less css file //different less files has different color scheam
 <link rel="stylesheet/less" type="text/css" href="themes/less/simplex.less">
 <link rel="stylesheet/less" type="text/css" href="themes/less/classified.less">
 <link rel="stylesheet/less" type="text/css" href="themes/less/amelia.less">  MOVE DOWN TO activate
 -->
    <!--<link rel="stylesheet/less" type="text/css" href="themes/less/bootshop.less">
 <script src="themes/js/less.js" type="text/javascript"></script> -->

    <!-- Bootstrap style -->
    <link id="callCss" rel="stylesheet" href="{{ asset('themes/bootshop/bootstrap.min.css') }}" media="screen" />
    <link href="{{ asset('themes/css/base.css') }}" rel="stylesheet" media="screen" />
    <!-- Bootstrap style responsive -->
    <link href="{{ asset('themes/css/bootstrap-responsive.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('themes/css/font-awesome.css') }}" rel="stylesheet" type="text/css">
    <!-- Google-code-prettify -->
    <link href="{{ asset('themes/js/google-code-prettify/prettify.css') }}" rel="stylesheet" />
    <!-- fav and touch icons -->
    <link rel="shortcut icon" href="themes/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href=" {{ asset('themes/images/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
        href=" {{ asset('themes/images/ico/apple-touch-icon-114-precomposed.png') }} ">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
        href="{{ asset('themes/images/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed"
        href="{{ asset('themes/images/ico/apple-touch-icon-57-precomposed.png') }}">
    <style type="text/css" id="enject"></style>
</head>

<body>
    <div id="header">
        <div class="container">
            <div id="welcomeLine" class="row">
                <div class="span6" style="padding-top: 15px; font-size:20px">Welcome<strong>
                        @if (Auth::User())
                            {{ Auth::User()->name }}
                    </strong>
                @else
                    User</strong>
                    @endif
                </div>
                <div class="span6">
                    <div class="pull-right">
                        <a href="{{ route('cart') }}"><span class="btn btn-mini btn-primary"
                                style="padding: 15px; font-size: 18px;"><i class="icon-shopping-cart icon-white"
                                    style="font-size: 22px; padding-right: 20px;"></i>@if (Auth::User())
                                    [ {{$cart_data_count}} ]</span>
                                    @else  Cart </span>   @endif </a>
                    </div>
                </div>
            </div>
            <!-- Navbar ================================================== -->
            <div id="logoArea" class="navbar">
                <a id="smallScreen" data-target="#topMenu" data-toggle="collapse" class="btn btn-navbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-inner">
                    <a class="brand" href="index.html"><img src="{{ asset('themes/images/logo.png') }}"
                            alt="Bootsshop" /></a>
                    <form class="form-inline navbar-search" method="post" action="products.html">
                        <input id="srchFld" class="srchTxt" type="text" />
                        <select class="srchTxt">
                            <option>All</option>
                            <option>CLOTHES </option>
                            <option>FOOD AND BEVERAGES </option>
                            <option>HEALTH & BEAUTY </option>
                            <option>SPORTS & LEISURE </option>
                            <option>BOOKS & ENTERTAINMENTS </option>
                        </select>
                        <button type="submit" id="submitButton" class="btn btn-primary">Go</button>
                    </form>
                    <ul id="topMenu" class="nav " >
                        {{-- <li class=""><a href="{{route('special_offer')}}">Specials Offer</a></li> --}}
                        <li class=""><a href="{{ route('delivery') }}">ODER</a></li>
                        <li class=""><a href="{{ route('contact') }}">CONTACT</a></li>
                    </ul>
                    <ul id="topMenu" class="nav pull-right ">
                        <li class="">

                            @if (Auth::User())
                                <div class="text-end">
                        <li><a href="#">Login : {{ Auth::User()->name }}</a></li>
                        <li class=""><a href="{{ route('user.logout') }}">LOGOUT</a></li>
                </div>
            @else
                <li><a href="{{ route('user.login') }}">LOGIN</a></li>
                <li class=""><a href="{{ route('user.register') }}">REGISTER</a></li>
                @endif

                </li>
                </ul>
            </div>
        </div>
    </div>
    </div>
    <!-- Header End====================================================================== -->
