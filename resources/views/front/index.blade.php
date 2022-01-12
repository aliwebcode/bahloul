<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Home Page</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Stylesheets -->
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
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
    </style>

    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="{{ asset('assets/js/respond.js') }}"></script><![endif]-->
</head>

<body>

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
                <ul class="navigation">
                    <li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a href="/dashboard"> <i
                                    class="la la-home"></i> Dashboard</a></li>
                    <li class="{{ Request::is('profile') ? 'active' : '' }}"><a href="/profile"><i
                                    class="la la-user-tie"></i>My Profile</a></li>
                    @if(auth()->user()->type == 1)
                        <li class="{{ Request::is('profile/resume') ? 'active' : '' }}"><a href="/profile/resume"><i
                                        class="la la-file-invoice"></i>My Resume</a></li>
                        <li class="{{ Request::is('profile/portfolio') ? 'active' : '' }}"><a href="/profile/portfolio"><i
                                        class="la la-images"></i>Portfolio</a></li>
                        <li class="{{ Request::is('profile/applied-jobs') ? 'active' : '' }}"><a
                                    href="/profile/applied-jobs"><i class="la la-briefcase"></i> Applied Jobs </a></li>
                    @elseif(auth()->user()->type == 2)
                        <li class="{{ Request::is('profile/jobs') ? 'active' : '' }}"><a href="/profile/jobs"><i
                                        class="la la-briefcase"></i>Jobs</a></li>
                    @elseif(auth()->user()->type == 3)
                        <li class="{{ Request::is('profile/portfolio') ? 'active' : '' }}"><a href="/profile/portfolio"><i
                                        class="la la-images"></i>Portfolio</a></li>
                    @endif
                    <li class="{{ Request::is('profile/shortlists') ? 'active' : '' }}"><a href="/profile/shortlists"><i
                                    class="la la-bookmark-o"></i>Shortlists</a></li>
                    <li class="{{ Request::is('profile/my-account') ? 'active' : '' }}"><a
                                href="/profile/my-account"><i class="la la-lock"></i>My Account</a></li>
                    <li><a href="/logout"><i class="la la-sign-out"></i>Logout</a></li>
                  </ul>

                <div class="skills-percentage">
                    <h4>Skills Percentage</h4>
                    <p>Put value for "Cover Image" field to increase your skill up to "85%"</p>

                    <!-- Pie Graph -->
                    <div class="pie-graph">
                        <div class="graph-outer">
                            <input type="text" class="dial" data-fgColor="#7367F0" data-bgColor="transparent"
                                   data-width="234" data-height="234" data-linecap="normal" value="60">
                            <div class="inner-text count-box"><span class="count-text txt" data-stop="60"
                                                                    data-speed="2000"></span>%
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End User Sidebar -->
    @endif

    <div id="app">
        <router-view></router-view>
    </div>

    @include('front.partials.footer')

</div><!-- End Page Wrapper -->
<script type='text/javascript'>
    window.onload = function () {
        let loadingComponent = document.getElementById("page-loader");
        loadingComponent.remove();
        // setTimeout(function(){
        //     loadingComponent.remove();
        // },1000); // set the time here

    };
</script>
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
<script src="{{ asset('js/app.js') }}"></script>
<script>
    Chart.defaults.global.defaultFontFamily = "Sofia Pro";
    Chart.defaults.global.defaultFontColor = '#888';
    Chart.defaults.global.defaultFontSize = '14';

    var ctx = document.getElementById('chart').getContext('2d');

    var chart = new Chart(ctx, {

        type: 'line',
        // The data for our dataset
        data: {
            labels: ["January", "February", "March", "April", "May", "June"],
            // Information about the dataset
            datasets: [{
                label: "Views",
                backgroundColor: 'transparent',
                borderColor: '#1967D2',
                borderWidth: "1",
                data: [196, 132, 215, 362, 210, 252],
                pointRadius: 3,
                pointHoverRadius: 3,
                pointHitRadius: 10,
                pointBackgroundColor: "#1967D2",
                pointHoverBackgroundColor: "#1967D2",
                pointBorderWidth: "2",
            }]
        },

        // Configuration options
        options: {

            layout: {
                padding: 10,
            },

            legend: {display: false},
            title: {display: false},

            scales: {
                yAxes: [{
                    scaleLabel: {
                        display: false
                    },
                    gridLines: {
                        borderDash: [6, 10],
                        color: "#d8d8d8",
                        lineWidth: 1,
                    },
                }],
                xAxes: [{
                    scaleLabel: {display: false},
                    gridLines: {display: false},
                }],
            },

            tooltips: {
                backgroundColor: '#333',
                titleFontSize: 13,
                titleFontColor: '#fff',
                bodyFontColor: '#fff',
                bodyFontSize: 13,
                displayColors: false,
                xPadding: 10,
                yPadding: 10,
                intersect: false
            }
        },
    });

</script>

@stack('script')

</body>
</html>


