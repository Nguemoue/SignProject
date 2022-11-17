<!DOCTYPE html>
<html lang="fr">

<head>
    @includeIf("_partials.head")
    @livewireStyles()
</head>

<body>
    <!--================ Start Header Menu Area =================-->
        @includeIf("_partials.header")    
    <!--================ End Header Menu Area =================-->

    <main class="site-main">
        @yield("main")
    </main>

    <!--================ Start footer Area  =================-->
    @includeIf("_partials.script")
    @livewireScripts()
</body>

</html>
