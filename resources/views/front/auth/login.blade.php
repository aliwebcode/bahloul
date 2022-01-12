<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>

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

</head>

<body>

<div class="page-wrapper">

    <!-- Preloader -->
    <div class="preloader"></div>

    <!-- Info Section -->
    <div class="login-section">
        <div class="image-layer" style="background-image: url({{ asset('assets/images/background/12.jpg') }});"></div>
        <div class="outer-box">
            <!-- Login Form -->
            <div class="login-form default-form">
                <div class="form-inner">
                    <h3>Login to Superio</h3>

                <!--Login Form-->
                    <form method="post" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" placeholder="Email" required>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input id="password-field" type="password" name="password" placeholder="Password" required>
                        </div>

                        <div class="form-group">
                            <div class="field-outer">
                                <a href="#" class="pwd">Forgot password?</a>
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="theme-btn btn-style-one" type="submit" name="log-in">Log In</button>
                        </div>
                    </form>

                    <div class="bottom-box">
                        <div class="text">Don't have an account? <a href="/register">Signup</a></div>
                    </div>
                </div>
            </div>
            <!--End Login Form -->
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
</body>
</html>


