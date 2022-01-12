<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Register</title>

    <!-- Stylesheets -->
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">

    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="{{ asset('assets/js/respond.js') }}"></script><![endif]-->

    <style>
        a.active {
            position: relative;
            text-align: center;
            white-space: nowrap;
            color: #ffffff;
            background-color: #34A853;
            line-height: 20px;
            border-radius: 8px;
            font-weight: 400;
            padding: 15px 35px;
        }
    </style>
</head>

<body>

<div class="page-wrapper">

    <!-- Preloader -->
    <div class="preloader"></div>

    <!-- Info Section -->
    <div class="login-section">
        <div class="image-layer" style="background-image: url({{ asset('assets/images/background/12.jpg') }});"></div>
        <div class="outer-box">
            <!-- Register Form -->
            <div class="login-form default-form">
                <div class="form-inner">
                    <h3>Create Free Account</h3>
                <!--Register Form-->
                    <form method="post" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <div class="btn-box row user_type_options">
                                <div class="col-lg-4 col-md-12">
                                    <a href="javascript:void(0)"
                                       class="theme-btn active"
                                       onclick="changeType(1,this)">
                                        <i class="la la-user"></i> Candidate
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <a href="javascript:void(0)"
                                       class="theme-btn btn-style-four"
                                       onclick="changeType(2,this)">
                                        <i class="la la-briefcase"></i> Employer
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <a href="javascript:void(0)"
                                       class="theme-btn btn-style-four"
                                       onclick="changeType(3,this)">
                                        <i class="la la-user-tie"></i> Business
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- User Type -->
                        <input id="user_type" type="hidden" name="type" value="1">

                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="name" placeholder="Full Name">
                        </div>

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" placeholder="Username">
                        </div>

                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" placeholder="Email">
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input id="password-field" type="password" name="password" value="" placeholder="Password">
                        </div>

                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                        </div>

                        <div class="form-group">
                            <button class="theme-btn btn-style-one " type="submit" name="Register">Register</button>
                        </div>

                    </form>

                    <div class="bottom-box">
                        <div class="text">Do You have an account? <a href="/login">Login</a></div>
                    </div>

                </div>
            </div>
            <!--End Register Form -->
        </div>
    </div>
    <!-- End Info Section -->


</div><!-- End Page Wrapper -->


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
<script src="{{ asset('assets/js/script.js') }}"></script>
<script>
    let changeType = function (e, t) {
        $('#user_type').val(e);
        $('.user_type_options .theme-btn').removeClass('active')
        $('.user_type_options .theme-btn').addClass('btn-style-four')
        t.classList.add('active')
    };
</script>
</body>
</html>


