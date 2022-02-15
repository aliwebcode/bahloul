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
                        <a href="/">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="Bahloul" title="Bahloul">
                        </a>
                    </div>
                </div>

                <nav class="nav main-menu">
                    <ul class="navigation" id="navbar">
                        <li>
                            <a href="/" id="header-home">Home</a>
                        </li>

                        <li>
                            <a href="/jobs" id="header-jobs">Jobs</a>
                        </li>

                        <li>
                            <a href="/resumes" id="header-candidates">Candidates</a>
                        </li>
                        <li>
                            <a href="/local-businesses" id="header-business">Local Businesses</a>
                        </li>

                        <li>
                            <a href="#">Blog</a>
                        </li>
                    </ul>
                </nav>
                <!-- Main Menu End-->
            </div>

            @if(auth()->check())
                <div class="outer-box">

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
            @else
                <div class="nav main-menu">
                    <ul class="navigation">
                        <li class="mr-4">
                            <a href="/login">Login</a>
                        </li>
                        <li>
                            <a href="/register">Register</a>
                        </li>
                    </ul>
                </div>
            @endif
        </div>
    </div>

    <!-- Mobile Header -->
    <div class="mobile-header">
        <div class="logo">
            <a href="/">
                <img src="{{ asset('assets/images/logo.png') }}">
            </a>
        </div>

        <!--Nav Box-->
        <div class="nav-outer clearfix">

            <div class="outer-box">
            @if(!auth()->check())
                <!-- Login/Register -->
                    <div class="login-box">
                        <button class="call-modal" onclick="window.location.href='/login'">
                            <span class="icon-user"></span>
                        </button>
                    </div>
                @endif
                @if(auth()->check())
                    <button id="toggle-user-sidebar">
                        <img src="{{ auth()->user()->image ? asset('/images/users/' . auth()->user()->image) : asset('assets/images/default_avatar.png') }}"
                             class="thumb"></button>
                    <a href="#nav-mobile" class="mobile-nav-toggler navbar-trigger"><span
                                class="flaticon-menu-1"></span></a>
                @endif
            </div>
        </div>

    </div>

    <!-- Mobile Nav -->
    <div id="nav-mobile"></div>
</header>
<!--End Main Header -->
