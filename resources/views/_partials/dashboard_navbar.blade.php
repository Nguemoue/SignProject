<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom" >
    <div class="container-fluid">
        <button class="btn btn-danger" id="sidebarToggle" ><span class="mdi mdi-menu-left-outline"></span></button>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                <a href="{{route('home')}}" class="btn btn-success">
                    <span class="mdi mdi-home"></span>
                </a>
                &nbsp;&nbsp;&nbsp;
                <a href="#!" class="navbar-brand">
                    {{auth()->user()->nom}}
                </a>
                <li class="nav-item">

                </li>
            </ul>
        </div>
    </div>
</nav>

