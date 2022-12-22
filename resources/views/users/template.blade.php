<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title', 'Dashboard')</title>

    <meta name="description" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('logo-ico.jpg') }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com" /> --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    {{-- <link rel="stylesheet" href="{{ asset('sneat/css/boxicons.css') }}" /> --}}

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sneat/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('sneat/css/theme-default.css') }}"  />
    <link rel="stylesheet" href="{{ asset('sneat/css/demo.css') }}" />

    <!-- Vendors CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('sneat/libs/perfect-scrollbar/perfect-scrollbar.css') }}" /> --}}

    <link rel="stylesheet" href="{{ asset('sneat/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('sneat/js/helpers.js') }}"></script>

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('sneat/js/config.js') }}"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @includeIf('_partials.dashboard.sidebar')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page " style="max-height: 100vh;overflow-y: scroll">
                <!-- Navbar -->
                @includeIf('_partials.dashboard.navbar')
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield("main")
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <!-- / Footer -->
                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('sneat/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('sneat/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('sneat/js/bootstrap.js') }}"></script>
    <script src="{{ asset('sneat/js/extended-ui-perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('sneat/js/menu.js') }}"></script>
    <!-- endbuild -->
    @vite("resources/js/app.js")
    <!-- Vendors JS -->
    <script src="{{ asset('sneat/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('sneat/js/main.js') }}"></script>

    <!-- Page JS -->
    {{-- <script src="{{ asset('sneat/js/dashboards-analytics.js') }}"></script> --}}
    @stack("scripts")
</body>

</html>
