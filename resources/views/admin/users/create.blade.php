@extends('admin.template')

@section('main')
    @if ($errors->any())
        <div class="alert alert-secondary alert-dismissible">
            <div class="alert-heading">des Erreurs on ete detectes</div>
            @foreach ($errors->all() as $error)
                <div>
                    {{ $error }}
                </div>
            @endforeach
        </div>
    @endif
    <div class="container border p-2">
        <div class="">
            <h2 class="text-center">Ajout d'un Administrateur</h2>
            <form action="{{ route('admin.users.store') }}" class="col-11" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="titre">Selectione l'utilisateur</label>
                    <select name="admin_id" id="" class="form-select form-control">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}"> {{ $user->id }} ( {{ $user->email }} ) </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="titre">Selectionner le role</label>
                    <select name="admin_id" id="" class="form-select form-control">
                        <option value="admin" class="text-danger">Admin</option>
                    </select>
                </div>

                <div>
                    <button type="reset" class="btn btn-danger">Reinitialiser</button>
                    <button type="submit" class="btn btn-success">Ajouter
                        <i class="mdi mdi-plus"></i>

                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
