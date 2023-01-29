<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Bahloul</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Stylesheets -->
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    @if(substr(Request::path(), 0, 2) == "ar")
    <link href="{{ asset('assets/css/rtl.css') }}" rel="stylesheet">
    @endif
    {{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">

    <style>
        .candidate-block-three .bookmark-btn {
            opacity: 1;
            visibility: visible;
            margin-right: 10px;
            width: 35px;
            height: 35px;
            font-size: 13px;
        }

        .candidate-block-three .bookmark-btn:hover {
            background-color: #1967D2;
            color: #fff;
        }
        .rtl {
            direction: rtl !important;
            text-align: right;
        }
        .dropdown-menu {
            top: 90%;
            left: -25px;
        }
        .dropdown-item img,
        .dropdown-toggle img {
            border-radius: 2px;
        }
        .whatsapp-icon {
            position: fixed;
            bottom: 30px;
            left: 30px;
            z-index: 9999;
            font-size: 55px;
            padding: 12px;
            background-color: #fff;
            border-radius: 50%;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
            transition: .4s all;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 75px;
            height: 75px;
        }
        .whatsapp-icon i {
            color: #189d0e;
            display: block;
            padding-bottom: 5px;
        }
        @media(max-width: 756px) {
            .whatsapp-icon {
                font-size: 35px;
                width: 50px;
                height: 50px;
            }
        }
    </style>

    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="{{ asset('assets/js/respond.js') }}"></script><![endif]-->

    @if(substr(Request::path(), 0, 2) == "ar")
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@500&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Cairo', sans-serif !important;
                position: relative;
            }
        </style>
    @endif

</head>

<body class="{{ substr(Request::path(), 0, 2) == "ar" ? 'rtl' : '' }}">

<div class="page-wrapper dashboard">
    <!-- Preloader -->
{{--    <div class="preloader"></div>--}}

@include('front.partials.header')

@if(auth()->check())
    <!-- Sidebar Backdrop -->
        <div class="sidebar-backdrop"></div>
        <!-- User Sidebar -->
        <div class="user-sidebar">

            <div class="sidebar-inner">

                @if(substr(Request::path(), 0, 2) == "ar")
                    <ul class="navigation">
                        <li class="{{ Request::is('ar/dashboard') ? 'active' : '' }}"><a href="/ar/dashboard"> <i
                                        class="la la-home"></i> لوحة التحكم</a></li>
                        <li class="{{ Request::is('ar/profile') ? 'active' : '' }}"><a href="/ar/profile"><i
                                        class="la la-user-tie"></i>ملفي الشخصي</a></li>
                        @if(auth()->user()->type == 1)
                            <li class="{{ Request::is('ar/profile/resume') ? 'active' : '' }}"><a href="/ar/profile/resume"><i
                                            class="la la-file-invoice"></i>السيرة الذاتية</a></li>
                            <li class="{{ Request::is('ar/profile/applied-jobs') ? 'active' : '' }}"><a
                                        href="/ar/profile/applied-jobs"><i class="la la-briefcase"></i> تقديماتي </a></li>
                        @elseif(auth()->user()->type == 2)
                            <li class="{{ Request::is('ar/profile/jobs') ? 'active' : '' }}"><a href="/ar/profile/jobs"><i
                                            class="la la-briefcase"></i>الوظائف</a></li>
                        @endif
                        <li class="{{ Request::is('ar/profile/portfolio') ? 'active' : '' }}"><a href="/ar/profile/portfolio"><i
                                        class="la la-images"></i>معرض الأعمال</a></li>
                        <li class="{{ Request::is('ar/profile/shortlists') ? 'active' : '' }}"><a href="/ar/profile/shortlists"><i
                                        class="la la-bookmark-o"></i>اختصاراتي</a></li>
                        <li class="{{ Request::is('ar/profile/my-account') ? 'active' : '' }}"><a
                                    href="/ar/profile/my-account"><i class="la la-lock"></i>حسابي</a></li>
                        <li><a href="/ar/logout"><i class="la la-sign-out"></i>تسجيل الخروج</a></li>
                    </ul>
                @elseif(substr(Request::path(), 0, 2) == "en")
                    <ul class="navigation">
                        <li class="{{ Request::is('en/dashboard') ? 'active' : '' }}"><a href="/en/dashboard"> <i
                                        class="la la-home"></i> Dashboard</a></li>
                        <li class="{{ Request::is('en/profile') ? 'active' : '' }}"><a href="/en/profile"><i
                                        class="la la-user-tie"></i>My Profile</a></li>
                        @if(auth()->user()->type == 1)
                            <li class="{{ Request::is('en/profile/resume') ? 'active' : '' }}"><a href="/en/profile/resume"><i
                                            class="la la-file-invoice"></i>My Resume</a></li>
                            <li class="{{ Request::is('en/profile/applied-jobs') ? 'active' : '' }}"><a
                                        href="/en/profile/applied-jobs"><i class="la la-briefcase"></i> Applied Jobs </a></li>
                        @elseif(auth()->user()->type == 2)
                            <li class="{{ Request::is('en/profile/jobs') ? 'active' : '' }}"><a href="/en/profile/jobs"><i
                                            class="la la-briefcase"></i>Jobs</a></li>
                        @endif
                        <li class="{{ Request::is('en/profile/portfolio') ? 'active' : '' }}"><a href="/en/profile/portfolio"><i
                                        class="la la-images"></i>Portfolio</a></li>
                        <li class="{{ Request::is('en/profile/shortlists') ? 'active' : '' }}"><a href="/en/profile/shortlists"><i
                                        class="la la-bookmark-o"></i>Shortlists</a></li>
                        <li class="{{ Request::is('en/profile/my-account') ? 'active' : '' }}"><a
                                    href="/en/profile/my-account"><i class="la la-lock"></i>My Account</a></li>
                        <li><a href="/en/logout"><i class="la la-sign-out"></i>Logout</a></li>
                    </ul>
                @else
                    <ul class="navigation">
                        <li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a href="/dashboard"> <i
                                        class="la la-home"></i> Dashboard</a></li>
                        <li class="{{ Request::is('profile') ? 'active' : '' }}"><a href="/profile"><i
                                        class="la la-user-tie"></i>Mein Profil</a></li>
                        @if(auth()->user()->type == 1)
                            <li class="{{ Request::is('profile/resume') ? 'active' : '' }}"><a href="/profile/resume"><i
                                            class="la la-file-invoice"></i>Mein Lebenslauf</a></li>
                            <li class="{{ Request::is('profile/applied-jobs') ? 'active' : '' }}"><a
                                        href="/profile/applied-jobs"><i class="la la-briefcase"></i> Beworbene Jobs </a></li>
                        @elseif(auth()->user()->type == 2)
                            <li class="{{ Request::is('profile/jobs') ? 'active' : '' }}"><a href="/profile/jobs"><i
                                            class="la la-briefcase"></i>Jobs</a></li>
                        @endif
                        <li class="{{ Request::is('profile/portfolio') ? 'active' : '' }}"><a href="/profile/portfolio"><i
                                        class="la la-images"></i>Portfolio</a></li>
                        <li class="{{ Request::is('profile/shortlists') ? 'active' : '' }}"><a href="/profile/shortlists"><i
                                        class="la la-bookmark-o"></i>Auswahllisten</a></li>
                        <li class="{{ Request::is('profile/my-account') ? 'active' : '' }}"><a
                                    href="/profile/my-account"><i class="la la-lock"></i>Mein Konto</a></li>
                        <li><a href="/logout"><i class="la la-sign-out"></i>Abmelden</a></li>
                    </ul>
                @endif
            </div>
        </div>
        <!-- End User Sidebar -->
    @endif

    <div id="app">
        <router-view :settings="settings"></router-view>
{{--        <div id="map" style="height:400px; width: 800px;" class="my-3"></div>--}}
    </div>

    @include('front.partials.footer')

</div><!-- End Page Wrapper -->


@if(\App\Setting::first()->whatsapp)
    <div class="whatsapp-icon" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="انقر للتواصل على واتساب" data-bs-original-title="" title="">
        <a href="https://wa.me/{{ \App\Setting::first()->whatsapp }}">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>
@endif

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/chosen.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.fancybox.js') }}"></script>
<script src="{{ asset('assets/js/jquery.modal.min.js') }}"></script>
<script src="{{ asset('assets/js/mmenu.polyfills.js') }}"></script>
<script src="{{ asset('assets/js/mmenu.js') }}"></script>
<script src="{{ asset('assets/js/appear.js') }}"></script>
<script src="{{ asset('assets/js/owl.js') }}"></script>
<script src="{{ asset('assets/js/wow.js') }}"></script>
<script src="{{ asset('assets/js/knob.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>

<script src="{{ asset('assets/js/chart.min.js') }}"></script>
@if(auth()->check())
    <script>
        let authUser =@JSON(auth()->user())
    </script>
@endif

<script src="{{ asset('js/app.js') }}"></script>

@if(auth()->check())
    <script>
        let map;
        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: -34.397, lng: 150.644 },
                zoom: 8,
                scrollwheel: true,
            });
            const uluru = { lat: -34.397, lng: 150.644 };
            let marker = new google.maps.Marker({
                position: uluru,
                map: map,
                draggable: true
            });
            google.maps.event.addListener(marker,'position_changed',
                function (){
                    let lat = marker.position.lat()
                    let lng = marker.position.lng()
                    $('#lat').val(lat)
                    $('#lng').val(lng)
                })
            google.maps.event.addListener(map,'click',
                function (event){
                    pos = event.latLng
                    marker.setPosition(pos)
                })
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDve3bov1xzqWzPFvAZGYcxmCns-ddeVto&callback=initMap"
            type="text/javascript"></script>
@endif

@stack('script')

<script>
    let dropdownBtn = document.getElementById('navbarDropdown')
    let dropdownMobileBtn = document.getElementById('navbarDropdownMobile')
    let dropdown = document.getElementsByClassName('dropdown-menu')[0]
    let dropdownMobile = document.getElementsByClassName('dropdown-menu')[1]
    dropdownBtn.onclick = function () {
        if(dropdown.classList.contains('d-block')) {
            dropdown.classList.remove('d-block');
        } else {
            dropdown.classList.add('d-block');
        }
    }
    dropdownMobileBtn.onclick = function () {
        if(dropdownMobile.classList.contains('d-block')) {
            dropdownMobile.classList.remove('d-block');
        } else {
            dropdownMobile.classList.add('d-block');
        }
    }
</script>

</body>
</html>


