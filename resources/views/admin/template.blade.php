<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Ecommerce | Administration</title>
    <link rel="stylesheet" href="{{asset('adminAssets/mdi/css/materialdesignicons.min.css')}}">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- <link rel="stylesheet" href="{{asset('adminAssets/css/vendor.bundle.base.css')}}"> --}}
    <!-- endinject -->
    <!-- Plugin css for this page -->
    {{-- <link rel="stylesheet" href="{{asset("adminAssets/jvectormap/jquery-jvectormap.css")}}" /> --}}
    {{-- <link rel="stylesheet" href="{{asset('adminAssets/flag-icon-css/css/flag-icon.min.css')}}"/> --}}
    {{-- <link rel="stylesheet" href="{{asset('adminAssets/owl-carousel-2/owl.carousel.min.css')}}"/> --}}
    {{-- <link rel="stylesheet" href="{{asset('adminAssets/owl-carousel-2/owl.theme.default.min.css')}}"/> --}}

    @stack("styles")
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('adminAssets/css/style.css')}}"/>
    <!-- End layout styles -->
    <link rel="shortcut icon" href="de" />
</head>

<body>
    <div class="container-scroller">
        @includeIf('admin._partials.admin_navbar')
        @includeIf('admin._partials.sidebar')

        <div class="main-panel">
            <div class="content-wrapper">
                @yield("main")
            </div>
        </div>
    </div>

    <!-- plugins:js -->
    <script src="{{asset('adminAssets/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->


    <!-- inject:js -->
    {{-- <script src="{{asset('adminAssets/js/off-canvas.js')}}"></script> --}}
    <script src="{{asset('adminAssets/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('adminAssets/js/misc.js')}}"></script>
    <!-- endinject -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- Custom js for this page -->
    <script src="{{asset('adminAssets/js/dashboard.js')}}"></script>
    <!-- End custom js for this page -->
    @stack("scripts")
    @includeIf("_partials.swal")
</body>

</html>
