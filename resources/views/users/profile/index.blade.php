@extends('users.template')

@section('main')
    <h4 class="text-center">Mon Profil</h4>
    <hr>
    <div class="row">
        <div class="col-4 mx-auto p-2">
            <img src="{{ asset('storage/' . $user->photo) }}" class="img-fluid img-thumbnail" alt="moon profil">
        </div>
        <div class="card col-7 mt-2">
            <div class="card-header">Modifier Mon Profile</div>
            <div class="card-body">
                <form action="{{ route('dashboard.photo.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="photo" class="btn btn-success"> <span class="mdi mdi-image"></span>
                            Choisir une
                            nouvelle Photo</label>
                        <input type="file" name="photo" class="d-none" id="photo" accept="image/*" />
                    </div>
                    <button type="submit" class="btn btn-primary"><span class="mdi mdi-pencil"></span>sauvegarder</button>
                </form>
            </div>
        </div>

    </div>
    <hr class="mb-2" />
    <div class="row">
        @includeIf('_partials.errors')
        <div class="col-6 ms-auto">
            <div class="row">
                <div class="card col-12">
                    <div class="card-header">
                        Mes Informations Personnelle
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-condensed">
                            <tr>
                                <td>Nom</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td>Telephone</td>
                                <td>{{ $user->telephone }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer">
                        Compte cree le : {{ $user->created_at->Isoformat('lll') }}
                    </div>
                </div>
                <div class="card col-12 mt-4">
                    <div class="card-header">Modifier mes donnes personnels</div>
                    <div class="card-body">
                        <form action="{{ route('dashboard.profile.update') }}" method="POST">
                            @csrf
                            <div class="mb-2">
                                <label for="nom">Nom</label>
                                <input type="text" value="{{ $user->name }}" class="form-control" name="name">
                            </div>
                            <div class="mb-2">
                                <label for="nom">Numer de Telephone</label>
                                <input type="tel" value="{{ $user->telephone }}" class="form-control"
                                    name="telephone" />
                            </div>
                            <button type="submit" class="btn btn-primary">sauvegarder</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header"> Mon Adresse</div>
                <div class="card-body">
                    <form action="{{ route('dashboard.adresse.update') }}" method="post">
                        @csrf
                        @php
                            $adresse = $user->adresse;
                        @endphp
                        <div class="mb-2">
                            <label for="pays">Pays</label>
                            <input type="text" name="pays" class="form-control" value="{{ $adresse->pays }}" placeholder="votre Pays" />
                        </div>
                        <div class="mb-2">
                            <label for="ville">Ville</label>
                            <input type="text" name="ville" id="ville" class="form-control"
                                placeholder="votre ville" value="{{ $adresse->ville }}">
                        </div>
                        <div class="mb-2">
                            <label for="quartier">quartier</label>
                            <input type="text" name="quartier" id="quartier" class="form-control"
                                placeholder="votre quartier" value="{{ $adresse->quartier}}">
                        </div>
                        <div class="mb-2">
                            <label for="numeroRue">numero Rue</label>
                            <input type="text" name="numeroRue" id="numeroRue" class="form-control"
                                placeholder="votre numeroRue" value="{{ $adresse->numeroRue}}">
                        </div>
                        <div class="mb-2">
                            <label for="zip">zip</label>
                            <input type="text" name="zip" id="zip" class="form-control"
                                placeholder="votre zip" value="{{ $adresse->zip }}">
                        </div>
                        <div class="mb-2">
                            <label for="boitePostal">boite Postal</label>
                            <input type="text" name="boitePostal" id="boitePostal" class="form-control"
                                placeholder="votre boitePostal" value="{{ $adresse->boitePostal }}">
                        </div>
                        <div class="mb-2">
                            <label for="zip">code zip</label>
                            <input type="text" name="zip" id="zip" class="form-control"
                                placeholder="votre zip" value="{{ $adresse->zip }}">
                        </div>
                        <div class="mb-2">
                            <label for="district">district</label>
                            <input type="text" name="district" id="district" class="form-control"
                                placeholder="votre district" value="{{ $adresse->district }}">
                        </div>
                        <button tupe="submit" class="btn btn-primary">save </button>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <hr>
    {{-- bloc pour change de mot de passe et changer ses information --}}
    <div class="row mt-4">
        <div class="card col-7 mr-auto">
            <div class="card-header">Modifier mon mot de passe</div>
            <div class="card-body">
                <form action="{{ route('dashboard.password.update') }}" method="POST">
                    @csrf
                    <div class="mb-2">
                        <label for="password">Nouveau Mot de passe</label>
                        <input type="password" id="password" class="form-control" name="password">
                    </div>
                    <div class="mb-2">
                        <label for="password_confirmation">Confirmer le mot de passe</label>
                        <input type="password" class="form-control" name="password_confirmation" />
                    </div>
                    <button type="submit" class="btn btn-primary">changer</button>
                </form>
            </div>
        </div>

    </div>
@endsection
