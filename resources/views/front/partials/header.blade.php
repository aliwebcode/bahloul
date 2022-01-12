<!-- Header Span -->
<span class="header-span"></span>

<!-- Main Header-->
<header class="main-header header-shaddow">
    <div class="container-fluid">
        <!-- Main box -->
        <div class="main-box">
            <!--Nav Outer -->
            <div class="nav-outer">
                <div class="logo-box">
                    <div class="logo">
                        <a href="#"><img src="{{ asset('assets/images/logo.svg') }}" alt="" title=""></a>
                    </div>
                </div>

                <nav class="nav main-menu">
                    <ul class="navigation" id="navbar">
                        <li>
                            <a href="/">Home</a>
                        </li>

                        <li>
                            <a href="/jobs">Jobs</a>
                        </li>

                        <li>
                            <a href="/resumes">Candidates</a>
                        </li>
                        <li>
                            <a href="/local-businesses">Local Businesses</a>
                        </li>

                        <li>
                            <a href="#">Blog</a>
                        </li>

                        <!-- Only for Mobile View -->
                        <li class="mm-add-listing">
                            <a href="add-listing.html" class="theme-btn btn-style-one">Job Post</a>
                            <span>
                                <span class="contact-info">
                                    <span class="phone-num"><span>Call us</span><a
                                                href="tel:1234567890">123 456 7890</a></span>
                                    <span class="address">329 Queensberry Street, North Melbourne VIC <br>3051, Australia.</span>
                                    <a href="mailto:support@superio.com" class="email">support@superio.com</a>
                                </span>
                                <span class="social-links">
                                    <a href="#"><span class="fab fa-facebook-f"></span></a>
                                    <a href="#"><span class="fab fa-twitter"></span></a>
                                    <a href="#"><span class="fab fa-instagram"></span></a>
                                    <a href="#"><span class="fab fa-linkedin-in"></span></a>
                                </span>
                            </span>
                        </li>
                    </ul>
                </nav>
                <!-- Main Menu End-->
            </div>

            @if(auth()->check())
                <div class="outer-box">
                    <button class="menu-btn">
                        <span class="count">1</span>
                        <span class="icon la la-bell"></span>
                    </button>

                    <a href="/profile/shortlists" class="menu-btn">
                        <span class="icon la la-bookmark-o"></span>
                    </a>

                    <!-- Dashboard Option -->
                    <div class="dropdown dashboard-option">
                        <a class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false">
                            <img src="{{ auth()->user()->image ? asset('/images/users/' . auth()->user()->image) : asset('assets/images/default_avatar.png') }}"
                                 alt="avatar" class="thumb">
                            <span class="name">My Account</span>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Mobile Header -->
    <div class="mobile-header">
        <div class="logo">
            <a href="/">
                <img src="assets/images/logo.svg">
            </a>
        </div>

        <!--Nav Box-->
        <div class="nav-outer clearfix">

            <div class="outer-box">
                <!-- Login/Register -->
                <div class="login-box">
                    <a href="login.html" class="call-modal"><span class="icon-user"></span></a>
                </div>

                <button id="toggle-user-sidebar"><img src="assets/images/resource/company-6.png" alt="avatar"
                                                      class="thumb"></button>
                <a href="#nav-mobile" class="mobile-nav-toggler navbar-trigger"><span
                            class="flaticon-menu-1"></span></a>
            </div>
        </div>

    </div>

    <!-- Mobile Nav -->
    <div id="nav-mobile"></div>
</header>
<!--End Main Header -->