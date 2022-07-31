<!doctype html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>trader admin</title>
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/font-icon/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">
    @yield('css')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ env('APP_URL') }}">
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

                        <ul id="sidebar_menu" class="metismenu"> <li>

                                <a  href="{{route('users.index')}}" aria-expanded="false">
                        <i class="bi bi-menu-down"></i>
                                    <div class="nav_title">
                                        <span>‌کاربران</span>
                                    </div>
                                </a>
                            </li> <li>

                                <a  href="{{route('charts.index')}}" aria-expanded="false">
                        <i class="bi bi-menu-down"></i>
                                    <div class="nav_title">
                                        <span>نمودارها و جدول‌ها</span>
                                    </div>
                                </a>
                            </li><li>

                                <a  href="{{route('menus.index')}}" aria-expanded="false">
                        <i class="bi bi-menu-down"></i>
                                    <div class="nav_title">
                                        <span>منو‌ها</span>
                                    </div>
                                      </a>
                            </li><li>

                                <a  href="{{route('userQuestions.index')}}" aria-expanded="false">
                        <i class="bi bi-menu-down"></i>
                                    <div class="nav_title">
                                        <span>پرسش های ‌کاربران</span>
                                    </div>
                                    @if (($count=App\Models\UserQuestion::whereNull('answerd_at')->count())>0)
                                    <span
                                    style="text-align: center;padding:0 8px;background-color: #868181;margin-right: 5px;border-radius: 50%;position: absolute;left: 10px;top: 10px">{{$count}}</span>
                            
                                    @endif
                                </a>
                            </li><li>

                                <a  href="{{route('subscribes.index')}}" aria-expanded="false">
                        <i class="bi bi-menu-down"></i>
                                    <div class="nav_title">
                                        <span>اشتراک‌ها</span>
                                    </div>
                                </a>
                            </li> <li>

                                <a  href="{{route('userSubscribes.index')}}" aria-expanded="false">
                        <i class="bi bi-menu-down"></i>
                                    <div class="nav_title">
                                        <span>اشتراک ‌کاربران</span>
                                    </div>
                                </a>
                            </li>  <li>

                                <a  href="{{route('payments.index')}}" aria-expanded="false">
                        <i class="bi bi-menu-down"></i>
                                    <div class="nav_title">
                                        <span>پرداخت‌ها</span>
                                    </div>
                                </a>
                            </li>

                            <li>

                                <a  href="{{route('memberLists.index')}}" aria-expanded="false">
                        <i class="bi bi-menu-down"></i>
                                    <div class="nav_title">
                                        <span>ممبر لیست‌ها</span>
                                    </div>
                                </a>
                            </li>
                            
                            <li>

                                <a  href="{{route('faqs.index')}}" aria-expanded="false">
                        <i class="bi bi-menu-down"></i>
                                    <div class="nav_title">
                                        <span>پرسش و پاسخ‌ها</span>
                                    </div>
                                </a>
                            </li> 
                        
                            <li>

                                <a  href="{{route('notifications.index')}}" aria-expanded="false">
                        <i class="bi bi-menu-down"></i>
                                    <div class="nav_title">
                                        <span>نوتیفیکیشن‌ها</span>
                                    </div>
                                </a>
                            </li> <li>

                                <a  href="{{route('userNotifications.index')}}" aria-expanded="false">
                        <i class="bi bi-menu-down"></i>
                                    <div class="nav_title">
                                        <span>نوتیفیکیشن‌های کاربران</span>
                                    </div>
                                </a>
                            </li>  <li>

                                <a  href="{{route('admins.index')}}" aria-expanded="false">
                        <i class="bi bi-menu-down"></i>
                                    <div class="nav_title">
                                        <span>ادمین‌ها</span>
                                    </div>
                                </a>
                            </li></ul>
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
                            @if(auth()->check())
                                <div class="profile_thumb mr_20">
                                    <img class="rounded-circle ms-2"
                                         src="{{asset(auth()->user()->profile_image?"storage/images/admin/".auth()->user()->profile_image:"assets/images/default-user.jpg")}}"
                                         alt="#" width="50" height="50">
                                </div>
                                <div class="author_name">
                                    <h4 class="f_s_15 f_w_500 mb-0">{{auth()->user()->first_name." ".auth()->user()->last_name}}</h4>
                                </div>
                            @endif
                            <div class="profile_info_iner">
                                <div class="profile_author_name">
                                    <h5>{{auth()->user()->first_name." ".auth()->user()->last_name}}</h5>
                                </div>
                                <div class="profile_info_details">
                                                                        <a href="{{route('admin.profile')}}">پروفایل من</a>
                                                                        <a href="{{route('admin.changePassword')}}">تغییر رمز عبور</a>
                                    <a href="{{route('logout')}}">خروج</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>         </div>
         <div class="main_content_iner">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show mt-2 px-3">
                {{ session()->get('success') }}
                <a type="button" class="close float-start" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
        @endif
             @yield('content')
         </div>
     </div>
     @stack('modals')
   <script src="{{asset('assets/js/jquery-3.5.1.js')}}"></script>
   <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
   <script src="{{asset('assets/js/custom.js')}}"></script>
   @stack('scripts')
</body>
</html>