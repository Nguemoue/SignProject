@extends('admin.template')

@php
    $user = $commande->user;
    $adresse = $user->adresse;
@endphp
@section('main')
    <h1 class="text-center">Information sur la commande Numero {{ $commande->numero }}</h1>
    <hr>
    <div class="">
        <div class="card mx-auto">
            <div class="d-flex justify-content-between card-header">
                <span>Informations sur la commande</span>
                @if ($commande->isValidated)
                    <button class="btn btn-success">Commande Valide</button>
                @else
                    <button class="btn btn-danger">Commande Non Valide</button>
                @endif
                <span class="badge bg-secondary text-dark badge-online p-2">le
                    {{ $commande->created_at->IsoFormat('lll') }}</span>
            </div>
            <div class="card-body">
                <p class="text-secondary">
                    Prix Total : {{ $commande->prixTtc }} Eur.
                </p>
                <p class="text-danger">
                    Nom du client : {{ $user->name }} /
                    Telephone: {{ $user->telephone }}
                    / Email : {{ $user->email }}
                    <br>
                    photo : <img src="{{ asset('storage/' . $user->photo) }}" alt="image">
                </p>
                <div class="jumbottron bg-gradient border">
                    <div class="text-center mb-2">
                        <em>Adresse</em>
                    </div>
                    <ul class="list-unstyled pl-3">
                        <li>pays : {{ $adresse->pays }}</li>
                        <li>Ville : {{ $adresse->ville }}</li>
                        <li>quartier : {{ $adresse->quartier }}</li>
                        <li>boitePostal : {{ $adresse->boitePostal }}</li>
                        <li>numeroRue : {{ $adresse->numeroRue }}</li>
                        <li>District : {{ $adresse->District }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <br>
    <h3 class="text-center mt-3 text-decoration-underline">Produits Commandes</h3>
    <div class="row">
        <table class="table table-bordered ">
            <thead class="bg-gradient" style="background-color: rgba(120, 120, 120, .4)">
                <tr >
                    <th></th>
                    <th>Produit</th>
                    <th>Prix Unitaire (Eur .)</th>
                    <th>Quantite</th>
                    <th>Prix Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($commande->commandeProduits as $cp)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/'.$cp->produit->images?->first()?->photo) }}" alt="">

                        </td>
                        <td>{{ $cp->produit->nom }}</td>
                        <td>{{ $cp->produit->prix }} Eur.</td>
                        <td>{{ $cp->quantite }}</td>
                        <td>{{ $cp->quantite * $cp->produit->prix }} Eur.</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
    <div class="d-flex justify-content-around mt-4">
        <a href="#" class="btn btn-success"> <span class="mdi mdi-check"></span> Valider</a>

        <a href="#" class="btn btn-danger"> <span class="mdi mdi-delete"></span>  Annuler</a>
    </div>
@endsection
