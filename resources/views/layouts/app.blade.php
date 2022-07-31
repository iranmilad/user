<!doctype html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>code generator</title>
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/font-icon/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">
    @yield('css')
</head>
<body>
<nav class="sidebar dark_sidebar">
    <div class="logo d-flex justify-content-between">
        <a class="large_logo" href="index.html"><img src="img/logo_white.png" alt=""></a>
        <a class="small_logo" href="index.html"><img src="img/mini_logo.png" alt=""></a>
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>

    </div>

    <ul id="sidebar_menu" class="metismenu">
        <li>

            <a href="" aria-expanded="false">
                <i class="bi bi-menu-down"></i>
                <div class="nav_title">
                    <span>فهرست استان و شهرها‌ها </span>
                </div>
            </a>
        </li>
    </ul>
</nav>
<div class="main_content">
    <div class="container-fluid no-gutters">
        <div class="row">
            <div class="col-lg-12 p-0 ">
                <div class="header_iner d-flex justify-content-between align-items-center">
                    <div class="sidebar_icon d-lg-none">
                        <i class="ti-menu"></i>
                    </div>
                    <div class="line_icon open_miniSide d-none d-lg-block">
                        <i class="bi bi-menu-down"></i>
                    </div>
                    <div class="header_right d-flex justify-content-between align-items-center">
                        <div class="profile_info d-flex align-items-center">
                            <div class="profile_thumb mr_20">
                                <img src="img/transfer/4.png" alt="#">
                            </div>
                            <div class="author_name">
                                <h4 class="f_s_15 f_w_500 mb-0">Jiue Anderson</h4>
                                <p class="f_s_12 f_w_400">Manager</p>
                            </div>
                            <div class="profile_info_iner">
                                <div class="profile_author_name">
                                    <p>Manager</p>
                                    <h5>Jiue Anderson</h5>
                                </div>
                                <div class="profile_info_details">
                                    <a href="#">My Profile </a>
                                    <a href="#">Settings</a>
                                    <a href="#">Log Out </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main_content_iner">
       
        @yield('content')
    </div>
</div>
<script src="{{asset('assets/js/jquery-3.5.1.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
@stack('scripts')
</body>
</html>
