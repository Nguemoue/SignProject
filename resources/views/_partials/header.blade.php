<header class="header_area position-sticky" >
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand logo_h" href="index.html"><img src="img/logo.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
                        <li @class(['nav-item', 'active' => Route::is('home')])><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                        <li @class(['nav-item submenu dropdown', 'active' => Route::is('shop.*')])>
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu">
                                <li @class(['nav-item', 'active' => Route::is('shop.category')])>
                                    <a class="nav-link" href="{{ route('shop.category') }}">Shop Category</a>
                                </li>
                                <li @class(['nav-item', 'active' => Route::is('shop.checkout')])><a class="nav-link"
                                        href="{{ route('shop.checkout') }}">Product
                                        Checkout</a>
                                </li>
                                <li @class(['nav-item', 'active' => Route::is('shop.confirmation')])><a class="nav-link"
                                        href="{{ route('shop.confirmation') }}">Confirmation</a>
                                </li>
                                <li @class(['nav-item', 'active' => Route::is('shop.cart')])><a class="nav-link"
                                        href="{{ route('shop.cart') }}">Shopping
                                        Cart</a></li>
                            </ul>
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
                        <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">Account</a>
                            <ul class="dropdown-menu">
                                @guest
                                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Sign in</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Sign up</a></li>
                                @endguest
                                @auth
                                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard/{{ auth()->user()->name }}</a></li>
                                    <li class="nav-item">
                                        <a onclick="document.getElementById('logoutForm').submit()" class="nav-link text-danger" href="#">
                                            <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                Logout
                                            </form>
                                        </a>
                                    </li>
                                @endauth

                            </ul>
                        </li>
                        <li @class(['nav-item', 'active' => Route::is('contact')])><a class="nav-link" href="{{ route('contact') }}">Contact</a>
                        </li>
                    </ul>

                    <ul class="nav-shop">
                        <li class="nav-item"><button><i class="ti-search"></i></button></li>
                        <li class="nav-item"><button><i class="ti-shopping-cart"></i><span
                                    class="nav-shop__circle">{{ session()->get('panier.count',0) }}</span></button> </li>
                        <li class="nav-item"><a class="button button-header" href="#">Buy Now</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
