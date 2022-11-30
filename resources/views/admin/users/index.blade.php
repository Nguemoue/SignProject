@extends('admin.template')

@section('main')
    <h1 class="text-center">Les users</h1>
    <div class="float-right mb-3 border p-2 btn-link btn btn-light">
        <a href="{{ route('admin.users.create') }}">Ajouter un Administrateur</a>
    </div>
    <div class="table-responsive mb-1">
        <table class="table  table-bordered">
            <caption>Listes des Utilisateurs</caption>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Photo</th>
                    <th>Email </th>
                    <th>Telephone </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td> {{ $user->name }} </td>
                        <td><img src="{{asset('avatar/'.$user->poster_url)}}" alt=""></td>
                        <td> {{ $user->email }} </td>
                        <td> {{ $user->telephone }} </td>
                        <td>
                            <div class="btn-group">
                                <form method="POST"
                                    action="{{ route('admin.users.destroy', ['user' => $user->id]) }}"
                                    class="menu-icon">
                                    @csrf
                                    @method('delete')
                                    <button class="mdi mdi-delete mdi-30px btn btn-outline-warning" type="submit"> </button>
                                </form>
                                &nbsp;
                                <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}"
                                    class="btn btn-outline-info"><i class="mdi mdi-pencil"></i></a>
                                    <a href="#!" class="btn btn-light">
                                        <i class="mdi mdi-information"></i>
                                    </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <div class="table-responsive mt-4">
        <h4 class="text-center mb-4">Les Administrateur</h4>
<table class="table  table-bordered">
            <caption>Listes des Administrateur</caption>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>role</th>
                    <th>Email </th>
                    <th>Telephone </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admins as $admin)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td> {{ $admin->nom }} </td>
                        <td>{{ Str::words($admin->role??"non defini",2) }}</td>
                        <td> {{ $admin->email }} </td>
                        <td> {{ $admin->telephone }} </td>
                        <td>
                            <div class="btn-group">
                                <form method="POST"
                                    action="{{ route('admin.users.destroy', ['user' => $user->id]) }}"
                                    class="menu-icon">
                                    @csrf
                                    @method('delete')
                                    <button class="mdi mdi-delete mdi-30px btn btn-outline-warning" type="submit"> </button>
                                </form>
                                &nbsp;
                                <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}"
                                    class="btn btn-outline-info"><i class="mdi mdi-pencil"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
@endsection


@push('styles')
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
@endpush
@push('scripts')

    @if (session()->has('messages.info'))
        <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/toastr.js') }}"></script>
        <script>
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "rtl": false,
                "positionClass": "toast-top-full-width",
                "pruserDuplicates": false,
                "onclick": null,
                "showDuration": 300,
                "hideDuration": 1000,
                "timeOut": 5000,
                "extendedTimeOut": 1000,
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr["info"](`{{ session("messages.info")  }}`,"Information")
        </script>
    @endif

@endpush
