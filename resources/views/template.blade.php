<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta name="color-scheme" content="light dark"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content="projet de surveillance des armmes"/>
    <meta name="author" content=""/>
    <title>{{ env('APP_NAME') }}</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{asset('logo.jpg')}}"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{asset('css/styles.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('mdi/css/materialdesignicons.min.css') }}">
    @livewireStyles()
    @stack('styles')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        ::-webkit-scrollbar-button {
            width: 0px;
            height: 0px;
        }

        ::-webkit-scrollbar-thumb {
            background: #e1e1e1;
            border: 31px none #fff;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }

        ::-webkit-scrollbar-thumb:active {
            background: #a3a3a3;
        }

        ::-webkit-scrollbar-track {
            background: #f0f0f0;
            border: 1px solid #fff;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-track:hover {
            background: #f2f2f2;
        }

        ::-webkit-scrollbar-track:active {
            background: #f5f5f5;
        }

        ::-webkit-scrollbar-corner {
            background: transparent;
        }

        :root {
            color-scheme: light dark;
        }

        .accordion-item {
            box-shadow: 0 0 1px red !important;
        }

        body {
            font-family: "Fira Code" !important;
        }
    </style>
</head>

<body>
<div class="d-flex" id="wrapper">
    <!-- Sidebar-->
@includeIf('_partials.sidebar')
<!-- Page content wrapper-->
    <div id="page-content-wrapper" style="height: 100vh;overflow-y: scroll;overflow-x: hidden; ">
        <!-- Top navigation-->
    @includeIf('_partials.navbar')
    <!-- Page content-->
        @yield("main")
    </div>
</div>
@livewireScripts()
<!-- Bootstrap core JS-->
<script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
<!-- Core theme JS-->
<script src="{{asset('js/scripts.js')}}"></script>
<script>

</script>
@vite(['resources/js/app.js'])
@stack("scripts")
@includeIf("_partials.swal")
</body>

</html>
