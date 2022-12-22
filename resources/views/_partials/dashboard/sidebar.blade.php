<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('logo.jpg') }}" alt="">
            </span> </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="mdi mdi-chevron-down"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li @class(["menu-item","active"=>Route::is("dashboard")])>
            <a href="{{ route('dashboard') }}" class="menu-link" >
                <i class="mdi mdi-home menu-icon "></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        <!-- Commande -->
        <li @class(["menu-item","active"=>Route::is("dashboard.commandes.*")])>
            <a class="menu-link"   href="{{ route('dashboard.commandes.index') }}">
                <i class="mdi mdi-cart-check menu-icon "></i>
                <div data-i18n="Layouts">Commandes</div>
            </a>


        </li>

        {{-- Mon compte --}}
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Mon Compte</span>
        </li>
        <li @class(["menu-item","active"=>Route::is("dashboard.account.profile")])>
            <a href="{{ route('dashboard.account.profile') }}" class="menu-link">
                <i class="mdi mdi-account-cog menu-icon"></i>
                <div data-i18n="Account">Parametres</div>
            </a>
        </li>
        <li @class(["menu-item","active"=>Route::is("dashboard.account.notifications")])>
            <a href="{{ route('dashboard.account.notifications') }}"  class="menu-link" >
                <i class="mdi mdi-bell menu-icon"></i>
                <div data-i18n="Notifications"> Notifications</div>
            </a>
        </li>



        <!-- Autres -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Autre</span></li>
        <li class="menu-item">
            <a href="#" target="_blank"
                class="menu-link">
                <i class="menu-icon mdi mdi-face-agent"></i>
                <div data-i18n="Support">Causer avec un agent</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="#" target="_blank"
                class="menu-link">
                <i class="menu-icon mdi mdi-hand-coin"></i>
                <div data-i18n="Support">Support</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="#" target="_blank"
                class="menu-link">
                <i class="menu-icon mdi mdi-book-education"></i>
                <div data-i18n="Documentation">Documentation</div>
            </a>
        </li>
    </ul>
</aside>
