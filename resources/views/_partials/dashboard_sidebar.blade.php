<div class="border-end bg-white" id="sidebar-wrapper">
    <div class="sidebar-heading border-bottom bg-light"> <img src="{{ asset('assets/amoirie.jpg') }}" width="50"
            alt=""> 〰〰 <img src="{{ asset('assets/amoirie.jpg') }}" width="50" alt="">
    </div>
    <div class="list-group list-group-flush">
        {{-- si il est chef --}}

        <x-navlink-component link="{{ route('home') }}" icon='mdi mdi-home '>
            Acceuil
        </x-navlink-component>
        @if (auth()->user()->chef)
            @includeIf('_partials.dashboard_sidebar.chef')
        @elseif (auth()->user()->element)
            @includeIf('_partials.dashboard_sidebar.element')
        @endif
    </div>
</div>
`
