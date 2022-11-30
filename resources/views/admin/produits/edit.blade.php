@extends('admin.template')

@section('main')
    <h2 class="text-center">Editer le produit <strong class="text-decoration-underline">{{ $produit->nom }}</strong></h2>
    <hr>
    <div class="card">
        <div class="card-header">
            @includeIf('_partials.errors')
        </div>
        <div class="card-body">

            <form method="POST" action="{{ route('admin.produits.update',['produit'=>$produit->id]) }}">
                @csrf
                @method("PUT")
                <div class="mb-2">
                    <label for="nom" class="form-label">Nom du Produit</label>
                    <input type="text" name="nom" class="form-control" value="{{ $produit->nom }}">
                </div>
                <div class="mb-2">
                    <label for="nom" class="form-label">Prix du Produit</label>
                    <div class="input-group">
                        <input type="text" name="prix" class="form-control" value="{{ $produit->prix }}">
                        <span class="input-group-text">
                            Dollar<span class="mdi mdi-currency-usd"></span>
                        </span>
                    </div>
                </div><div class="mb-2">
                    <label for="nom" class="form-label">Quantite Restante</label>
                    <div class="input-group">
                        <input required min="0" minlength="1" type="number" name="quantite" class="form-control" value="{{ $produit->quantite }}">
                        <span class="input-group-text">
                            Pieces
                        </span>
                    </div>
                </div>
                <div class="mb-2">
                    <label for="nom" class="form-label">Categorie du Produit</label>
                    <select name="categorie_produit_id" id="categorie" class="form-select form-control">
                        @foreach ($categories as $categorie)
                            <option {{ $categorie['nom'] == $produit->categorie->nom ? 'selected' : '' }}
                                value="{{ $categorie['id'] }}">
                                {{ $categorie['nom'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <label for="nom" class="form-label">Descriptiondu Produit</label>
                    <textarea name="description" id="description" class="form-control">{{ $produit->description }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-2"><i class="mdi mdi-download"></i> Modifier</button>
            </form>
        </div>
        <div class="card-footer">

        </div>
    </div>
    <hr>

    {{-- card pour les photo du produits --}}
    <div class="card">
        <div class="card-header">
            <h2 class="card-title text-center">Modification sur les images du produits</h2>

            {{-- modal pour la creation de photo --}}
            <button type="button" data-bs-toggle="modal" data-bs-target="#createPhotoModal" class="btn btn-primary">Novel
                image <span class="mdi mdi-image-plus"></span> </button>
            <div class="modal fade" id="createPhotoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="createPhotoModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-4" id="createPhotoModalLabel">Creer une nouvelle photo</h1>
                            <button type="button" class="btn-close mdi mdi-close-box" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.photoProduit.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="input-group">
                                    <input type="file" class="form-control" accept="image/*"
                                        placeholder="choose your file" name="photo">
                                    <span class="input-group-text mdi mdi-image"></span>
                                </div>
                                <input type="hidden" name="produit_id" id="" value="{{ $produit->id }}">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            {{-- modal pour creer une photo --}}

            {{-- modal pour l'edition d'une photo --}}
            <div class="modal fade" id="editPhotoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="editPhotoModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-4" id="editPhotoModalLabel">Edition de la photo</h1>
                            <button type="button" class="btn btn-danger mdi mdi-close-box" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.photoProduit.changePhoto') }}" enctype="multipart/form-data"
                            method="POST">
                            @csrf
                            <div class="modal-body">
                                <label for="editPhotoField">Choisissez une nouvelle photo.</label>
                                <div class="input-group">
                                    <input type="file" id="editPhotoFile" class="form-control" accept="image/*"
                                        placeholder="choose your file" name="photo">
                                    <span class="input-group-text mdi mdi-image-area"></span>
                                </div>
                                <input type="hidden" id="editPhotoId" name="photo_id" value="0">
                                <input type="hidden" name="produit_id" id="" value="{{ $produit->id }}">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">editer</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            {{-- modal pour l'edition d'une photo --}}


        </div>
        <div class="card-body d-flex">
            @foreach ($produit->images as $image)
                <div class="card position-relative">
                    <div class="btn-group  position-absolute">
                        {{-- la class edit__photo va permetre de declancher le modal d'edition de produit --}}
                        <a href="#!" class="text-center btn btn-secondary edit__photo mdi mdi-pencil"
                            data-image="{{ $image->id }}" data-produitid="{{ $produit->id }}">
                        </a>
                        <a href="#!" class="text-center btn btn-danger">
                            <form onclick="submit()" method="POST"
                                action="{{ route('admin.photoProduit.destroy', ['photoProduit' => $image->id]) }}">
                                @csrf
                                @method('DELETE')
                                <span class="mdi mdi-delete"></span>
                            </form>
                        </a>
                    </div>
                    <img class="img-fluid img-thumbnail" style="max-width: 400px" max-width="40px"
                        src="{{ asset('storage/' . $image->photo) }}" alt="{{ $image->photo }}">
                </div>
            @endforeach
        </div>
    </div>


    {{-- card pour les couleur du produit --}}
    <div class="card mt-3">
        <div class="card-header">
            <h2 class="card-title text-center">Gestion des Couleurs</h2>
            <button data-bs-toggle="modal" data-bs-target="#createColorModal" class="btn btn-primary">Novelle Couleur
                <span class="mdi mdi-select-color"></span> </button>
        </div>
        {{-- modal pour creer une nouvelle couleur au produit --}}
        <div class="modal fade" id="createColorModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">Creer Une Nouvelle Couleur</h2>
                        <button data-bs-dismiss="modal" class="btn btn-danger mdi mdi-delete"></button>
                    </div>
                    <form action="{{ route('admin.couleurProduit.store') }}" method="POST">
                        <div class="modal-body">
                            <fieldset>
                                <legend>Veuillez remplir correctement le formulaire</legend>
                                @csrf
                                <div class="mb-3">
                                    <label for="nom" class="form-label">nom de la couleur</label>
                                    <div class="input-group">
                                        <input name="nom" type="text" class="form-control">
                                        <span class="input-group-text mdi mdi-color-helper"></span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="">Code de couleur</label>
                                    <input name="code" id="fileColor" type="color" class="form-control-color">
                                </div>
                                <input type="hidden" name="produit_id" value="{{ $produit->id }}">
                            </fieldset>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Creer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- fin du modal --}}
        <div class="card-body d-flex">
            @foreach ($produit->couleur as $couleur)
                <div class="card position-relative mx-2 ">
                    <div class="btn-group btn-group-sm  ">
                        <a href="#" class=" text-center btn btn-secondary"><span class="mdi mdi-pencil"></span></a>
                        <a href="#!" onclick="document.getElementById('couleurEditForm{{ $couleur->id }}').submit()" class="text-center btn btn-danger"><span class="mdi mdi-delete"></span></a>
                        <form method="POST" id="couleurEditForm{{ $couleur->id }}" action="{{ route('admin.couleurProduit.destroy',['couleurProduit'=>$couleur->id]) }}" class="hidden">
                            @csrf @method("DELETE")
                        </form>
                    </div>
                    <div class="card p-2 d-flex align-center justify-content-center"
                        style="min-height: 40px; background-color: {{ $couleur->code }}">
                        {{ $couleur->nom }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- card pour la specification du produit --}}
    <div class="card mt-3">
        <div class="card-header">
            <h2 class="card-title">Specification du Produit</h2>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('admin.produit.specification.update',['produit'=>$produit->id]) }}">
                @csrf
                <div class="mb-2">
                    <label for="largeur">Largeur</label>
                    <input type="number" value="{{ $produit->specification?->width }}" name="width" id="width"
                        class="form-control">
                </div>
                <div class="mb-2">
                    <label for="largeur">Longeur</label>
                    <input type="number" name="height" id="height" value="{{ $produit->specification?->height }}"
                        class="form-control">
                </div>
                <div class="mb-2">
                    <label for="largeur">Profondeur</label>
                    <input type="number" name="depth" id="depth" class="form-control"
                        value="{{ $produit->specification?->depth }}">
                </div>
                <div class="mb-2">
                    <label for="largeur">Poids</label>
                    <input type="number" name="weight" id="weight" class="form-control"
                        value="{{ $produit->specification?->weight }}">
                </div>
                <div class="mb-2">
                    <label for="consigne">Consigne</label>
                    <textarea name="consigne" id="consigne" class="form-control">{{ $produit->specification?->consigne }}</textarea>
                </div>
                <div class="mb-2">
                    <label for="peremtion">Date de peremption: {{ $produit->specification?->peremtion->IsoFormat('ll') }}</label>
                    <input type="date" name="peremtion" id="peremption" class="form-control"
                        value="{{ $produit->specification?->peremption }}" />
                </div>
                <button type="submit" class="btn btn-primary">save</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script defer>
        const editPhotoModal = document.getElementById('editPhotoModal')
        const editModal = new bootstrap.Modal(editPhotoModal)
        const editPhotoFile = document.getElementById("editPhotoFile")
        const editPhotoId = document.getElementById("editPhotoId")
        const editphotoButton = document.querySelectorAll("a.edit__photo")

        editPhotoModal.addEventListener('show.bs.modal', function(event) {

        });

        editphotoButton.forEach(item => {
            item.addEventListener('click', function(event) {
                event.stopPropagation()
                console.log('event', event, event.target.dataset)
                // je recupere les donnes en dataset
                let image_id = event.target.dataset.image
                editModal.show(editPhotoModal)
                editPhotoId.value = image_id
            }, false);
        });
    </script>
@endpush
