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
                        @if(substr(Request::path(), 0, 2) == "ar")
                            <a href="/ar">
                                <img src="{{ asset('assets/images/logo.png') }}">
                            </a>
                        @elseif(substr(Request::path(), 0, 2) == "en")
                            <a href="/en">
                                <img src="{{ asset('assets/images/logo.png') }}">
                            </a>
                        @else
                            <a href="/">
                                <img src="{{ asset('assets/images/logo.png') }}">
                            </a>
                        @endif
                    </div>
                </div>

                <nav class="nav main-menu">
                    <ul class="navigation" id="navbar">
                        <li>
                            @if(substr(Request::path(), 0, 2) == "en")
                                <a href="/en" id="header-home">Home</a>
                            @elseif(substr(Request::path(), 0, 2) == "ar")
                                <a href="/ar" id="header-home">الرئيسية</a>
                            @else
                                <a href="/" id="header-home">Startseite</a>
                            @endif
                        </li>

                        <li>
                            @if(substr(Request::path(), 0, 2) == "en")
                                <a href="/en/jobs" id="header-jobs">Jobs</a>
                            @elseif(substr(Request::path(), 0, 2) == "ar")
                                <a href="/ar/jobs" id="header-jobs">الوظائف</a>
                            @else
                                <a href="/jobs" id="header-jobs">Jobs</a>
                            @endif
                        </li>

                        <li>
                            @if(substr(Request::path(), 0, 2) == "en")
                                <a href="/en/resumes" id="header-candidates">Candidates</a>
                            @elseif(substr(Request::path(), 0, 2) == "ar")
                                <a href="/ar/resumes" id="header-candidates">المستقلين</a>
                            @else
                                <a href="/resumes" id="header-candidates">Bewerber</a>
                            @endif
                        </li>
                        <li>
                            @if(substr(Request::path(), 0, 2) == "en")
                                <a href="/en/local-businesses" id="header-business">Local Businesses</a>
                            @elseif(substr(Request::path(), 0, 2) == "ar")
                                <a href="/ar/local-businesses" id="header-business">أعمال محلية</a>
                            @else
                                <a href="/local-businesses" id="header-business">Lokale Unternehmen</a>
                            @endif
                        </li>

                        <li>
                            @if(substr(Request::path(), 0, 2) == "en")
                                <a href="/blog">Blog</a>
                            @elseif(substr(Request::path(), 0, 2) == "ar")
                                <a href="/blog">المدونة</a>
                            @else
                                <a href="/blog">Blog</a>
                            @endif
                        </li>
                    </ul>
                </nav>
                <!-- Main Menu End-->
            </div>

            @if(auth()->check())
                <div class="outer-box">

                    <div class="dropdown text-left pb-1">
                        <a class="nav-link dropdown-toggle p-0" href="javascript:void(0)"
                           id="navbarDropdown">
                            @if(substr(Request::path(), 0, 2) == "ar")
                                <img class="mb-1" src="{{ asset('assets/images/ar.png') }}" width="30" height="30">
                            @elseif(substr(Request::path(), 0, 2) == "en")
                                <img class="mb-1" src="{{ asset('assets/images/en.png') }}" width="30" height="30">
                            @else
                                <img class="mb-1" src="{{ asset('assets/images/de.png') }}" width="30" height="30">
                            @endif
                        </a>
                        <div class="dropdown-menu {{ substr(Request::path(), 0, 2) == "ar" ? 'text-right' : '' }}">
                            @if(substr(Request::path(), 0, 2) != "ar")
                                <a class="dropdown-item" href="/ar">
                                    <img class="mb-1" src="{{ asset('assets/images/ar.png') }}" width="30"
                                         height="30">
                                    Arabic
                                </a>
                            @endif
                            @if(substr(Request::path(), 0, 2) != "en")
                                <a class="dropdown-item" href="/en">
                                    <img class="mb-1" src="{{ asset('assets/images/en.png') }}" width="30"
                                         height="30">
                                    English
                                </a>
                            @endif
                            @if(substr(Request::path(), 0, 2) == "en" || substr(Request::path(), 0, 2) == "ar")
                                <a class="dropdown-item" href="/">
                                    <img class="mb-1" src="{{ asset('assets/images/de.png') }}" width="30"
                                         height="30">
                                    Germany
                                </a>
                            @endif
                        </div>
                    </div>

                    @if(substr(Request::path(), 0, 2) == "ar")
                        <a href="/ar/profile/shortlists" class="menu-btn">
                            <span class="icon la la-bookmark-o"></span>
                        </a>
                    @elseif(substr(Request::path(), 0, 2) == "en")
                        <a href="/en/profile/shortlists" class="menu-btn">
                            <span class="icon la la-bookmark-o"></span>
                        </a>
                    @else
                        <a href="/profile/shortlists" class="menu-btn">
                            <span class="icon la la-bookmark-o"></span>
                        </a>
                @endif

                <!-- Dashboard Option -->
                    <div class="dropdown dashboard-option">
                        <a class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false">
                            <img src="{{ auth()->user()->image ? asset('/images/users/' . auth()->user()->image) : asset('assets/images/default_avatar.png') }}"
                                 alt="avatar" class="thumb">
                            @if(substr(Request::path(), 0, 2) == "en")
                                <span class="name">My Account</span>
                            @elseif(substr(Request::path(), 0, 2) == "ar")
                                <span class="name">حسابي</span>
                            @else
                                <span class="name">Mein Konto</span>
                            @endif
                        </a>
                    </div>
                </div>
            @else
                <div class="nav main-menu">
                    <ul class="navigation">
                        <li class="mr-4">
                            @if(substr(Request::path(), 0, 2) == "en")
                                <a href="/en/login">Login</a>
                            @elseif(substr(Request::path(), 0, 2) == "ar")
                                <a href="/ar/login">تسجيل الدخول</a>
                            @else
                                <a href="/login">Anmelden</a>
                            @endif
                        </li>
                        <li>
                            @if(substr(Request::path(), 0, 2) == "en")
                                <a href="/en/register">Register</a>
                            @elseif(substr(Request::path(), 0, 2) == "ar")
                                <a href="/ar/register">حساب جديد</a>
                            @else
                                <a href="/register">Registrieren</a>
                            @endif
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                               id="navbarDropdown">
                                @if(substr(Request::path(), 0, 2) == "ar")
                                    <img class="mb-1" src="{{ asset('assets/images/ar.png') }}" width="30" height="30">
                                @elseif(substr(Request::path(), 0, 2) == "en")
                                    <img class="mb-1" src="{{ asset('assets/images/en.png') }}" width="30" height="30">
                                @else
                                    <img class="mb-1" src="{{ asset('assets/images/de.png') }}" width="30" height="30">
                                @endif
                            </a>
                            <div class="dropdown-menu {{ substr(Request::path(), 0, 2) == "ar" ? 'text-right' : '' }}">
                                @if(substr(Request::path(), 0, 2) != "ar")
                                    <a class="dropdown-item" href="/ar">
                                        <img class="mb-1" src="{{ asset('assets/images/ar.png') }}" width="30"
                                             height="30">
                                        Arabic
                                    </a>
                                @endif
                                @if(substr(Request::path(), 0, 2) != "en")
                                    <a class="dropdown-item" href="/en">
                                        <img class="mb-1" src="{{ asset('assets/images/en.png') }}" width="30"
                                             height="30">
                                        English
                                    </a>
                                @endif
                                @if(substr(Request::path(), 0, 2) == "en" || substr(Request::path(), 0, 2) == "ar")
                                    <a class="dropdown-item" href="/">
                                        <img class="mb-1" src="{{ asset('assets/images/de.png') }}" width="30"
                                             height="30">
                                        Germany
                                    </a>
                                @endif
                            </div>
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
                <ul>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                           id="navbarDropdownMobile">
                            @if(substr(Request::path(), 0, 2) == "ar")
                                <img class="mb-1" src="{{ asset('assets/images/ar.png') }}" width="30" height="30">
                            @elseif(substr(Request::path(), 0, 2) == "en")
                                <img class="mb-1" src="{{ asset('assets/images/en.png') }}" width="30" height="30">
                            @else
                                <img class="mb-1" src="{{ asset('assets/images/de.png') }}" width="30" height="30">
                            @endif
                        </a>
                        <div class="dropdown-menu {{ substr(Request::path(), 0, 2) == "ar" ? 'text-right' : '' }}"
                             style="left: -70px">
                            @if(substr(Request::path(), 0, 2) != "ar")
                                <a class="dropdown-item" href="/ar">
                                    <img class="mb-1" src="{{ asset('assets/images/ar.png') }}" width="30"
                                         height="30">
                                    Arabic
                                </a>
                            @endif
                            @if(substr(Request::path(), 0, 2) != "en")
                                <a class="dropdown-item" href="/en">
                                    <img class="mb-1" src="{{ asset('assets/images/en.png') }}" width="30"
                                         height="30">
                                    English
                                </a>
                            @endif
                            @if(substr(Request::path(), 0, 2) == "en" || substr(Request::path(), 0, 2) == "ar")
                                <a class="dropdown-item" href="/">
                                    <img class="mb-1" src="{{ asset('assets/images/de.png') }}" width="30"
                                         height="30">
                                    Germany
                                </a>
                            @endif
                        </div>
                    </li>
                </ul>
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
                @endif
                <a href="#nav-mobile" class="mobile-nav-toggler navbar-trigger"><span
                            class="flaticon-menu-1"></span></a>
            </div>
        </div>

    </div>

    <!-- Mobile Nav -->
    <div id="nav-mobile"></div>
</header>
<!--End Main Header -->
