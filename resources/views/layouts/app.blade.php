<!DOCTYPE html>
<html class="not-loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>@yield('title', 'CEMS')</title>
    <link rel="apple-touch-icon" href="{{ asset('app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/charts/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/ui/prism.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/semi-dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/extensions/toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/fullcalendar/main.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <style>
        :root {
            --primary-color: #4361ee;
            --primary-light: #4895ef;
            --primary-dark: #3f37c9;
            --secondary-color: #64748b;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }
        
        .main-menu.menu-dark .navigation > li.active > a, 
        .main-menu.menu-dark .navigation > li.nav-item.open > a, 
        .main-menu.menu-dark .navigation > li.sidebar-group-active > a {
            background: linear-gradient(118deg, #4361ee, rgba(67, 97, 238, 0.7));
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
            border-radius: 8px;
        }
        
        .main-menu.menu-light .navigation > li.active > a {
            background: linear-gradient(118deg, #4361ee, rgba(67, 97, 238, 0.7));
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
            color: #fff;
            font-weight: 500;
            border-radius: 8px;
        }
        
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        }
        
        .dark-layout .card {
            background-color: #1e293b;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.2);
        }
        
        .dark-layout .main-menu {
            background-color: #1e293b;
        }
        
        .dark-layout .header-navbar {
            background-color: #1e293b !important;
        }
        
        .navigation i {
            margin-right: 0.75rem;
            font-size: 1.1rem;
            width: 1.1rem;
            text-align: center;
        }
        
        .brand-logo img {
            max-height: 36px;
        }
        
        .header-navbar {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .dropdown-menu {
            border-radius: 10px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .btn-primary {
            background-color: #4361ee;
            border-color: #4361ee;
        }
        
        .btn-primary:hover {
            background-color: #3f37c9;
            border-color: #3f37c9;
        }
        
        .breadcrumb {
            background: transparent;
        }
        
        .form-control {
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }
        
        .form-control:focus {
            border-color: #4361ee;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }
        
        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            border-radius: 6px;
        }
        
        .page-heading {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1e293b;
        }
        
        .footer {
            border-top: 1px solid #e2e8f0;
        }
        
        .tooltip-inner {
            max-width: 600px;
            text-align: left;
        }
        
        .fc-daygrid-day-frame {
            height: 100px;
        }
        
        .fc-event-title-container, .fc-daygrid-event {
            text-align: center;
            margin-top: -10px;
            padding: 10px 0;
            background-color: #fff;
            background-image: url('{{ asset('assets/cloud.jpg') }}');
            background-repeat: no-repeat;
            background-position: center center;
        }
        
        .fc-event-title {
            font-size: 24px;
            color: #000;
        }
        
        * {
            transition: background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease;
        }
    </style>
    @yield('styles')
</head>
<body class="vertical-layout vertical-menu-modern semi-dark-layout 2-columns navbar-sticky fixed-footer todo-application" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="semi-dark-layout">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top navbar-light navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon feather icon-menu"></i></a></li>
                        </ul>
                    </div>
                    <ul class="nav navbar-nav float-right">
                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link nav-link-expand"><i class="ficon feather icon-maximize"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link dark-layout-toggle"><i class="ficon feather icon-moon"></i></a>
                        </li>
                        <li class="dropdown dropdown-notification nav-item">
                            <a id="notif_count" class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon feather icon-bell"></i></a>
                            <ul id="notif_list" class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                <li class="dropdown-menu-header">
                                    <div class="dropdown-header m-0 p-2">
                                        <span class="white"><strong>Notifications</strong></span>
                                    </div>
                                </li>
                                <li id="notif_data" class="scrollable-container media-list">
                                </li>
                                <li class="dropdown-menu-footer"><a class="dropdown-item p-1 text-center" href="{{ url('notif/all_notif') }}">Read all notifications</a></li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-user nav-item">
                            <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-sm-flex d-none">
                                    <span class="user-name text-bold-600">{{ auth()->user()->name ?? 'Guest' }}</span>
                                    <span class="user-status">{{ auth()->user()->role ?? 'Visitor' }}</span>
                                </div>
                                <span><img class="round" src="{{ asset('app-assets/images/profile/user.jpg') }}" alt="avatar" height="40" width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ url('myprofile') }}"><i class="feather icon-user"></i> My Profile</a>
                                @if(auth()->user()->role != 'Operator')
                                    <a class="dropdown-item" href="{{ url('setting') }}"><i class="feather icon-settings"></i> Settings</a>
                                @endif
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item w-100 border-0 bg-transparent text-left"><i class="feather icon-power"></i> Logout</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ url('/') }}">
                        <div class="brand-logo"></div>
                        <h2 class="brand-text mb-0">CEMS</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" href="javascript:void(0)"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block primary" data-ticon="icon-disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="nav-item {{ request()->is('/') ? 'active' : '' }}"><a href="{{ url('/') }}"><i class="feather icon-home"></i><span class="menu-title">Dashboard</span></a></li>
                <li class="nav-item">
                    <a href="#"><i class="feather icon-list"></i><span class="menu-title">Lihat Data</span></a>
                    <ul class="menu-content">
                        @foreach(\App\Models\Cerobong::all() as $cerobong)
                            <li class="{{ request()->is('cerobong/'.$cerobong->cerobong_id) ? 'active' : '' }}">
                                <a href="{{ url('cerobong/'.$cerobong->cerobong_id) }}"><i class="feather icon-circle"></i><span class="menu-item">{{ $cerobong->cerobong_name }}</span></a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                @if(in_array(auth()->user()->role ?? '', ['Administrator', 'Admin', 'Engineer']))
                    <li class="nav-item {{ request()->is('profile') ? 'active' : '' }}"><a href="{{ url('profile') }}"><i class="feather icon-globe"></i><span class="menu-title">Profil Perusahaan</span></a></li>
                    <li class="nav-item {{ request()->is('maintenance') ? 'active' : '' }}"><a href="{{ url('maintenance') }}"><i class="feather icon-command"></i><span class="menu-title">Maintenance</span></a></li>
                    <li class="nav-item {{ request()->is('kirim') ? 'active' : '' }}"><a href="{{ url('kirim') }}"><i class="feather icon-send"></i><span class="menu-title">Submit Data</span></a></li>
                    <li class="nav-item {{ request()->is('logkirimdata') ? 'active' : '' }}"><a href="{{ url('logkirimdata') }}"><i class="feather icon-calendar"></i><span class="menu-title">Log Kirim Data</span></a></li>
                    <li class="nav-item {{ request()->is('activity') ? 'active' : '' }}"><a href="{{ url('activity') }}"><i class="feather icon-activity"></i><span class="menu-title">Activity</span></a></li>
                @endif
                @if(in_array(auth()->user()->role ?? '', ['Administrator', 'Admin']))
                    <li class="nav-item {{ request()->is('user') ? 'active' : '' }}"><a href="{{ url('user') }}"><i class="feather icon-users"></i><span class="menu-title">User</span></a></li>
                    <li><a href="#"><i class="feather icon-database"></i><span class="menu-title">Data Master</span></a>
                        <ul class="menu-content">
                            <li class="{{ request()->is('parameter') ? 'active' : '' }}"><a href="{{ url('parameter') }}"><i class="feather icon-circle"></i><span class="menu-item">Parameter</span></a></li>
                        </ul>
                    </li>
                @endif
                <li class="nav-item {{ request()->is('csv') ? 'active' : '' }}"><a href="{{ url('csv') }}"><i class="feather icon-upload"></i><span class="menu-title">Upload CSV</span></a></li>
                <li class="nav-item">
                    <a href="#"><i class="feather icon-bar-chart-2"></i><span class="menu-title">Laporan</span></a>
                    <ul class="menu-content">
                        <li class="{{ request()->is('reportbydaterange') ? 'active' : '' }}"><a href="{{ url('reportbydaterange') }}"><i class="feather icon-circle"></i><span class="menu-item">Antar Tanggal</span></a></li>
                        <li class="{{ request()->is('reportbydate') ? 'active' : '' }}"><a href="{{ url('reportbydate') }}"><i class="feather icon-circle"></i><span class="menu-item">Per Tanggal</span></a></li>
                        <li class="{{ request()->is('reportbymonth') ? 'active' : '' }}"><a href="{{ url('reportbymonth') }}"><i class="feather icon-circle"></i><span class="menu-item">Per Bulan</span></a></li>
                        <li class="{{ request()->is('reportbyyear') ? 'active' : '' }}"><a href="{{ url('reportbyyear') }}"><i class="feather icon-circle"></i><span class="menu-item">Per Tahun</span></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    @yield('content')

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    <footer class="footer fixed-footer footer-light">
        <p class="clearfix blue-grey lighten-2 mb-0">
            <span class="float-md-left d-block d-md-inline-block mt-25">&copy; {{ date('Y') }}<a class="text-bold-800 grey darken-2" href="#" target="_blank">CEMS</a>.</span>
            <span class="float-md-right d-none d-md-block">All Rights Reserved.</span>
            <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="feather icon-arrow-up"></i></button>
        </p>
    </footer>

    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/pickadate/picker.time.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/pickadate/legacy.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/fullcalendar/main.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/fullcalendar/moment.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/libraries/bootstrap.min.js') }}"></script>
    
    <div id="global-data"
         data-notif-url="{{ route('notif.header') }}"
         data-notif-redirect-url="{{ url('notif') }}?q=all_notif">
    </div>

    <script>
    $(document).ready(function() {
        const globalDataEl = document.getElementById('global-data');
        const notifUrl = globalDataEl.getAttribute('data-notif-url');
        const notifRedirectUrl = globalDataEl.getAttribute('data-notif-redirect-url');

        // Global AJAX Error Handling
        $.ajaxSetup({
            error: function(xhr, status, error) {
                if (xhr.status === 401) {
                    window.location.reload();
                } else {
                    console.error('AJAX Error:', error);
                    toastr.error('Something went wrong with the request.', 'Error!');
                }
            }
        });

        // Dark Mode Logic
        var $body = $('body');
        var $nav = $('.header-navbar');
        var $mainMenu = $('.main-menu');
        var $toggle = $('.dark-layout-toggle i');

        // Check local storage for theme
        if (localStorage.getItem('theme') === 'dark-layout') {
            $body.removeClass('semi-dark-layout').addClass('dark-layout');
            $body.attr('data-layout', 'dark-layout');
            $nav.removeClass('navbar-light').addClass('navbar-dark');
            $mainMenu.removeClass('menu-light').addClass('menu-dark');
            $toggle.removeClass('icon-moon').addClass('icon-sun');
        }

        $('.dark-layout-toggle').on('click', function() {
            if ($body.hasClass('dark-layout')) {
                $body.removeClass('dark-layout').addClass('semi-dark-layout');
                $body.attr('data-layout', 'semi-dark-layout');
                $nav.removeClass('navbar-dark').addClass('navbar-light');
                $mainMenu.removeClass('menu-dark').addClass('menu-light');
                $toggle.removeClass('icon-sun').addClass('icon-moon');
                localStorage.setItem('theme', 'semi-dark-layout');
            } else {
                $body.removeClass('semi-dark-layout').addClass('dark-layout');
                $body.attr('data-layout', 'dark-layout');
                $nav.removeClass('navbar-light').addClass('navbar-dark');
                $mainMenu.removeClass('menu-light').addClass('menu-dark');
                $toggle.removeClass('icon-moon').addClass('icon-sun');
                localStorage.setItem('theme', 'dark-layout');
            }
        });

        function updateNotif() {
            $.getJSON(notifUrl, function(data) {
                if (data.count > 0) {
                    $('#notif_count').append('<span class="badge badge-pill badge-danger badge-up">'+data.count+'</span>');
                }
                var html = '';
                $.each(data.data, function(i, item) {
                    html += '<a class="d-flex justify-content-between" href="' + notifRedirectUrl + '">';
                    html += '<div class="media d-flex align-items-start">';
                    html += '<div class="media-left"><i class="feather icon-alert-circle font-medium-5 primary"></i></div>';
                    html += '<div class="media-body"><h6 class="primary media-heading">'+item.title+'</h6><small class="notification-text">'+item.desc+'</small></div>';
                    html += '<small><time class="media-meta">'+item.time+'</time></small>';
                    html += '</div></a>';
                });
                $('#notif_data').html(html);
            });
        }
        updateNotif();
        // setInterval(updateNotif, 60000);
    });
    </script>
    @yield('scripts')
</body>
</html>
