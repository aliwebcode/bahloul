<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
{{--        <div class="sidebar-brand-icon rotate-n-15">--}}
{{--            <i class="fas fa-laugh-wink"></i>--}}
{{--        </div>--}}
        <div class="sidebar-brand-text mx-3">لوحة التحكم</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @yield('home')">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>الرئيسية</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        أساسي
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
{{--    <li class="nav-item @yield('orders')">--}}
{{--        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"--}}
{{--           aria-expanded="true" aria-controls="collapseTwo">--}}
{{--            <i class="fas fa-fw fa-bars"></i>--}}
{{--            <span>الطلبات</span>--}}
{{--        </a>--}}
{{--        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">--}}
{{--            <div class="bg-white py-2 collapse-inner rounded">--}}
{{--                <h6 class="collapse-header">الطلبات</h6>--}}
{{--                <a class="collapse-item" href="/admin/orders">كل الطلبات</a>--}}
{{--                <a class="collapse-item" href="/admin/orders?status=pending">الطلبات المعلقة</a>--}}
{{--                <a class="collapse-item" href="/admin/orders?status=approved">الطلبات المقبولة</a>--}}
{{--                <a class="collapse-item" href="/admin/orders?status=rejected">الطلبات المرفوضة</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </li>--}}

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item @yield('users')">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
           aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-users"></i>
            <span>المستخدمين</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">المستخدمين</h6>
                <a class="collapse-item" href="{{ route('admin.users','resume') }}">المستقلين</a>
                <a class="collapse-item" href="{{ route('admin.users','company') }}">الشركات</a>
                <a class="collapse-item" href="{{ route('admin.users','business') }}">الأعمال</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
{{--    <li class="nav-item @yield('categories')">--}}
{{--        <a class="nav-link" href="#">--}}
{{--            <i class="fas fa-fw fa-list"></i>--}}
{{--            <span>الوظائف</span>--}}
{{--        </a>--}}
{{--    </li>--}}

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item @yield('faq')">
        <a class="nav-link" href="{{ route('admin.faq.index') }}">
            <i class="fas fa-fw fa-question"></i>
            <span>الأسئلة الشائعة</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
{{--    <li class="nav-item">--}}
{{--        <a class="nav-link" href="#">--}}
{{--            <i class="fas fa-fw fa-home"></i>--}}
{{--            <span>الصفحة الرئيسية</span>--}}
{{--        </a>--}}
{{--    </li>--}}

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item @yield('settings')">
        <a class="nav-link" href="{{ route('admin.settings.index') }}">
            <i class="fas fa-fw fa-cog"></i>
            <span>الإعدادات</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
