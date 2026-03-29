<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Company Portal - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="MyraStudio" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="{{ asset('backend') }}/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend') }}/assets/css/theme.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend') }}/assets/css/custom.css" rel="stylesheet" type="text/css" />

    @stack('css')
</head>

<body>
    @include('sweetalert::alert')

    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('backend.layouts.header')

        <!-- ========== Left Sidebar Start ========== -->
        @include('backend.layouts.sidebar')
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            @yield('content')

            @include('backend.layouts.footer')

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Overlay-->
    <div class="menu-overlay"></div>


    <!-- jQuery  -->
    <script src="{{ asset('backend') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/metismenu.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/waves.js"></script>
    <script src="{{ asset('backend') }}/assets/js/simplebar.min.js"></script>

    <!-- Morris Js-->
    <script src="{{ asset('backend') }}/plugins/morris-js/morris.min.js"></script>
    <!-- Raphael Js-->
    <script src="{{ asset('backend') }}/plugins/raphael/raphael.min.js"></script>

    <!-- Morris Custom Js-->
    <script src="{{ asset('backend') }}/assets/pages/dashboard-demo.js"></script>

    <!-- App js -->
    <script src="{{ asset('backend') }}/assets/js/theme.js"></script>

    @stack('js')
</body>

</html>
