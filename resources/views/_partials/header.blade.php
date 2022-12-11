<header class="header_area position-sticky">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand logo_h" href="{{ route('home') }}"><img src="{{ asset('logo.jpg') }}"
                        alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
                        <li @class(['nav-item', 'active' => Route::is('home')])><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                        <li @class(['nav-item', 'active' => Route::is('shop.*')])>
                            <a href="{{ route('shop.category') }}" class="nav-link">Shop</a>
                        </li>
                        <li @class(['nav-item submenu dropdown', 'active' => Route::is('blog.*')])>
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">Blog</a>
                            <ul class="dropdown-menu">
                                <li @class(['nav-item', 'active' => Route::is('blog.index')])><a class="nav-link"
                                        href="{{ route('blog.index') }}">Blog</a></li>
                                <li @class(['nav-item', 'active' => Route::is('blog.singleBlog')])><a class="nav-link"
                                        href="{{ route('blog.singleBlog', ['blogId' => 1]) }}">Blog Details</a>
                                </li>
                            </ul>
                        </li>
                        <li @class(['nav-item', 'active' => Route::is('contact')])><a class="nav-link" href="{{ route('contact') }}">Contact</a>
                        </li>
                    </ul>

                    <ul class="nav-shop">

                        <li class="nav-item"><button><i class="ti-search"></i></button></li>
                        <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" aria-haspopup="true"
                                aria-expanded="false" data-toggle="dropdown" role="button">
                                <i class="ti-user"></i>
                            </a>
                            <ul class="dropdown-menu text-center">
                                @guest
                                    <li><a class="nav-link" href="{{ route('register') }}">Sign up</a></li>

                                    <li><a class="nav-link" href="{{ route('login') }}">Sign in</a></li>
                                @endguest
                                @auth('web')
                                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a onclick="document.getElementById('logoutForm').submit()"
                                            class="nav-link text-danger" href="#">
                                            Logout
                                        </a>
                                    </li>
                                    <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                    </form>
                                @endauth
                            </ul>
                        </li>
                        <li class="nav-item"><a href="{{ route('shop.cart') }}"><button><i
                                        class="ti-shopping-cart"></i><span class="nav-shop__circle">
                                        @php
                                            $nbprod = session()->get('panier.produits', 0);
                                            $sessionNumber = $nbprod == 0 ? $nbprod : count($nbprod);
                                        @endphp
                                        {{ $sessionNumber }} </span></button></a> </li>

                        @auth('admin')
                            <li @class(['nav-item', 'active' => Route::is('admin.home')])><a class="button active button-header"
                                    href="{{ route('shop.checkout') }}">Administration</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
