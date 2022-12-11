<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">

    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="{{ route('admin.home') }}">
            <span color="#ffffff">ADMINISTRATION</span>
        </a>
    </div>

    <ul class="nav">
        <li class="nav-item nav-category">
            <span class="nav-link">Onglets</span>
        </li>

        <li @class([
            'nav-item menu-items my-2',
            'active' => Route::is('admin.home'),
        ])>
            <a class="nav-link" href="{{ route('admin.home') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-speedometer"></i>
                </span>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li @class([
            'nav-item menu-items my-2',
            'active' => Route::is('admin.users.*'),
        ])>
            <a class="nav-link" href="{{ route('admin.users.index') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-account-multiple-outline"></i>
                </span>
                <span class="menu-title">Users</span>
            </a>
        </li>



        <li @class([
            'nav-item menu-items my-2',
            'active' => Route::is('admin.produits.*'),
        ])>
            <a class="nav-link" href="{{ route('admin.produits.index') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-book"></i>
                </span>
                <span class="menu-title"> Produits</span>
            </a>
        </li>

        <li @class(['nav-item menu-items my-2', "active"=>Route::is('admin.categorieProduit.*')])>
            <a class="nav-link" href="{{ route('admin.categorieProduit.index') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-book"></i>
                </span>
                <span class="menu-title">Categorie Produit</span>
            </a>
        </li>

        <li @class([
            'nav-item menu-items my-2',
            'active' => Route::is('admin.blogs.*'),
        ])>
            <a class="nav-link" href="{{ route('admin.blogs.index') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-arrow-right-bold-hexagon-outline"></i>
                </span>
                <span class="menu-title">Blog</span>
            </a>
        </li>

        <div class="bg-white" style="color:brown"></div>
        <li class="nav-item menu-items my-1">
            <a class="nav-link" href="{{ route('home') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-home"></i>
                </span>
                <span class="menu-title">Acceuil</span>
            </a>
        </li>
    </ul>
</nav>
