<meta charset="utf-8" />
{{-- <meta name="color-scheme" content="light dark" /> --}}
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="description" content="Projet de E-Commerce" />
<meta name="author" content="" />
<title>{{ env('APP_NAME') }}</title>
<!-- Favicon-->
<link rel="icon" type="image/x-icon" href="{{ asset('logo.jpg') }}" />
<!-- Core theme CSS (includes Bootstrap)-->
{{-- <link href="{{ asset('css/styles.css') }}" rel="stylesheet" /> --}}
{{-- <link rel="stylesheet" href="{{ asset('mdi/css/materialdesignicons.min.css') }}"> --}}
<link rel="icon" href="img/Fevicon.png" type="image/png">
<link rel="stylesheet" href="{{ asset('vendors/bootstrap/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/fontawesome/css/all.min.css') }}}}">
<link rel="stylesheet" href="{{ asset('vendors/themify-icons/themify-icons.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/nice-select/nice-select.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/owl-carousel/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/owl-carousel/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<style>
    ::-webkit-scrollbar {
        width: 7px;
        height: 2px;
    }

    ::-webkit-scrollbar-button {
        width: 0px;
        height: 0px;
    }

    ::-webkit-scrollbar-thumb {
        /* background: #e1e1e1; */
        background: #07a;
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

    /* :root {
        color-scheme: light dark;
    } */

    .accordion-item {
        box-shadow: 0 0 1px red !important;
    }

</style>
