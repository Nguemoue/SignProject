<!DOCTYPE html>
<html lang="fr">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @includeIf('_partials.head')
    @livewireStyles()
</head>

<body>
    <!--================ Start Header Menu Area =================-->
    @includeIf('_partials.header')
    <!--================ End Header Menu Area =================-->

    <main class="site-main">
        @yield('main')
    </main>

    <!--================ Start footer Area  =================-->
    @includeIf("_partials.footer")
    @includeIf('_partials.script')
    @includeIf('_partials.swal')
    @livewireScripts()
</body>

</html>
