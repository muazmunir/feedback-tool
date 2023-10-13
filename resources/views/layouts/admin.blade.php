<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
     
        <meta name="csrf-token" content="{{ csrf_token() }}">
     
        <!-- Icons Css -->
        <link href="{{ asset('assets/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Css -->
        <link href="{{ asset('assets/admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('assets/admin/css/app.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/admin/css/toastr.css') }}" rel="stylesheet" type="text/css" >
        <!-- Scripts --> 
        @vite(['resources/js/app.js'])
        @yield('style')            
    </head>
    <body data-topbar="colored">
        <!-- Begin page -->
        <div id="layout-wrapper">
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box p-0">
                            <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
                            <span class="logo-lg"  style="font-size: 30px">                                
                                Admin Panel                             
                            </span>
                            <span class="logo-sm" style="font-size: 30px">
                                M
                            </span>
                            </a>
                        </div>
                        <!-- Menu Icon -->
                        <button type="button" class="btn px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                        <i class="mdi mdi-menu"></i>
                        </button>
                    </div>
                    <div class="d-flex">
                        <div class="dropdown d-inline-block d-lg-none ms-2">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-magnify"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-search-dropdown">
                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search ..."
                                                aria-label="Recipient's username">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit"><i
                                                    class="mdi mdi-magnify"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
          
    
                        <!-- User -->
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="{{ asset('assets/admin/images/avatar.jpg') }}"
                                >
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item text-primary" href="{{ route('logout') }}"  onclick="event.preventDefault();
                                        this.closest('form').submit();"><i
                                        class="mdi mdi-power font-size-16 align-middle me-2 text-primary"></i>
                                    <span>Logout</span></a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">
                <div data-simplebar class="h-100">
                    <!--- Sidemenu -->
                    @include('includes.admin.sidebar')
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                @yield('content')
            </div>
            <!-- end main content-->
        </div>
        <!-- END layout-wrapper -->
        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
        <!-- JAVASCRIPT -->
        <script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/metisMenu.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/waves.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/jquery.sparkline.min.js') }}"></script>

        <!-- Peity JS -->
        <script src="{{ asset('assets/admin/js/jquery.peity.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/morris.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/raphael.min.js') }}"></script>        
        <!-- Dashboard init JS -->
        <script src="{{ asset('assets/admin/js/dashboard.init.js') }}"></script>        
        <!-- Include Select2 JS -->
        <script src="{{ asset('assets/admin/js/select2.min.js') }}"></script>
        <!-- App js -->
        <script src="{{ asset('assets/admin/js/app.js') }}"></script>
        <script src="{{ asset('assets/admin/js/toastr.min.js') }}"></script>
        <script>      
            <?php if(session()->has('message')) { ?>
                var type = "{{ Session::get('alert-type', 'info') }}";
                var message = "{{ Session::get('message') }}";                
                var toastrOptions = {
                    info: toastr.info,
                    success: toastr.success,
                    warning: toastr.warning,
                    error: toastr.error
                };
                if (toastrOptions[type]) {
                    toastrOptions[type](message);
                }
            <?php } ?>
           
        </script>
        @stack('scripts')        
        
        <!-- Initialize Select2 -->
        <script>
            $(document).ready(function() {
                $('.select2').select2();
            });
        </script>
    </body>
</html>