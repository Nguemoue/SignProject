<div class="border-end bg-white" id="sidebar-wrapper">
    <div class="sidebar-heading border-bottom bg-light">
        <img src="{{ asset('logo.jpg') }}" width="50"
            alt=""/> 〰〰 <img src="{{ asset('logo.jpg') }}" width="50" alt=""/>
    </div>

    <div class="list-group list-group-flush">

        <li class="list-group-item border p-2">
            <form action="{{route('logout')}}" method="post">
                @csrf
                <button type="submit" class="btn btn-danger">Se deconnecter</button>
            </form>
        </li>
    </div>
</div>

