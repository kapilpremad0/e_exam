<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">

    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto"><a class="navbar-brand" href="{{ route('admin.dashboard') }}">

                    <h2>{{ env('APP_NAME') }}</h2>
                    {{-- <img src="{{ url('public/frontend/img/footerlogo.png') }}" alt="" width="100%"
                        style="    height: 64px;
                "> --}}

                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i
                        class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                        class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
                        data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">


            <li class=" nav-item {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('admin.dashboard') }}"><i
                        data-feather="home"></i><span class="menu-title text-truncate"
                        data-i18n="Dashboards">Dashboard</span><span
                        class="badge badge-light-warning rounded-pill ms-auto me-1"></span></a>

            </li>

            <li
                class=" nav-item {{ \Str::is('admin.exams.*', request()->route()->getName()) ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.exams.index') }}"><i
                        data-feather="user"></i><span class="menu-title text-truncate"
                        data-i18n="Dashboards">Exams</span><span
                        class="badge badge-light-warning rounded-pill ms-auto me-1"></span></a>

            </li>

            {{-- <li
                class=" nav-item {{ \Str::is('admin.subjects.*', request()->route()->getName()) ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.subjects.index') }}"><i
                        data-feather="user"></i><span class="menu-title text-truncate"
                        data-i18n="Dashboards">Subject</span><span
                        class="badge badge-light-warning rounded-pill ms-auto me-1"></span></a>

            </li>

            <li
                class=" nav-item {{ \Str::is('admin.levels.*', request()->route()->getName()) ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.levels.index') }}"><i
                        data-feather="user"></i><span class="menu-title text-truncate"
                        data-i18n="Dashboards">Lavel</span><span
                        class="badge badge-light-warning rounded-pill ms-auto me-1"></span></a>

            </li> --}}

            <li
                class=" nav-item {{ \Str::is('admin.submit_results.*', request()->route()->getName()) ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.submit_results.index') }}"><i
                        data-feather="user"></i><span class="menu-title text-truncate"
                        data-i18n="Dashboards">Submit Results</span><span
                        class="badge badge-light-warning rounded-pill ms-auto me-1"></span></a>

            </li>

            <li
                class=" nav-item {{ \Str::is('admin.transactions.*', request()->route()->getName()) ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.transactions.index') }}"><i
                        data-feather="user"></i><span class="menu-title text-truncate"
                        data-i18n="Dashboards">Transaction</span><span
                        class="badge badge-light-warning rounded-pill ms-auto me-1"></span></a>

            </li>

            <li
                class=" nav-item {{ \Str::is('admin.levels.*', request()->route()->getName()) ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.levels.index') }}"><i
                        data-feather="user"></i><span class="menu-title text-truncate"
                        data-i18n="Dashboards">Users</span><span
                        class="badge badge-light-warning rounded-pill ms-auto me-1"></span></a>

            </li>
            


        </ul>



    </div>
</div>
<!-- END: Main Menu-->
