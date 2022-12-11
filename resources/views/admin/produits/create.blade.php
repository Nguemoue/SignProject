@extends('admin.template')

@section('main')
    <div class="container-fluid">
        <h2 class="text-center">Page de creation d'un Nouveau Produit produit</h2>
    </div>
    <div class="card">
        <div class="card-header">
            @includeIf('_partials.errors')
        </div>
        <div class="card-body">

            <form method="POST" action="{{ route('admin.produits.store') }}">
                @csrf
                <div class="mb-2">
                    <label for="nom" class="form-label">Nom du Produit</label>
                    <input type="text" name="nom" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="nom" class="form-label">Prix du Produit</label>
                    <div class="input-group">
                        <input type="text" name="prix" class="form-control">
                        <span class="input-group-text">
                            Euro<span class="mdi mdi-currency-eur"></span>
                        </span>
                    </div>
                </div>
                <div class="mb-2">
                    <label for="nom" class="form-label">Quantite Restante</label>
                    <div class="input-group">
                        <input required min="0" minlength="1" type="number" name="quantite" class="form-control">
                        <span class="input-group-text">
                            Pieces
                        </span>
                    </div>
                </div>
                <div class="mb-2">
                    <label for="nom" class="form-label">Categorie du Produit</label>
                    <select name="categorie_produit_id" id="categorie" class="form-select form-control">
                        @foreach ($categories as $categorie)
                            <option value="{{ $categorie['id'] }}">
                                {{ $categorie['nom'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <label for="nom" class="form-label">Image du produit</label>
                    <div class="input-group">
                        <input type="file" class="form-control" id="imageFile">
                        <span class="input-group-text">
                            <span class="mdi mdi-image"></span>
                        </span>
                    </div>
                </div>
                <div class="mb-2">
                    <label for="nom" class="form-label">Descriptiondu Produit</label>
                    <textarea name="description" id="description" class="form-control"></textarea>
                </div>
                <input type="hidden" id="imageHidden" name="imageHidden" value="0">
                <button type="submit" class="btn btn-primary mt-2"><i class="mdi mdi-download"></i>Enregistrer</button>
            </form>
        </div>

        {{-- je cree ma modal pour le cropper de l'image --}}
        <div class="modal  fade" id="cropPhotoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="cropPhotoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-4" id="cropPhotoModalLabel">Edition de la photo</h1>
                        <button type="button" class="btn btn-danger mdi mdi-close-box" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="editPhotoField">Cop Image.</label>
                        <img src="" class="w-100" id="cropImage" alt="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="cropButton" class="btn btn-success">crop</button>
                    </div>
                </div>
            </div>

        </div>
    @endsection

    @push('scripts')
        <script defer>
            const imageFile = document.getElementById('imageFile')
            const image = document.getElementById('cropImage');
            const cropPhotoModal = document.getElementById("cropPhotoModal")
            const imageHidden = document.getElementById("imageHidden")
            const cropButton = document.getElementById("cropButton")
            var cropper;
            const modalObject = new bootstrap.Modal(cropPhotoModal) ;

            imageFile.addEventListener('change', function(e) {
                var files = e.target.files;
                var done = function(url) {
                    image.src = url;
                    modalObject.show();
                };
                var reader;
                var file;
                var url;
                if (files && files.length > 0) {
                    file = files[0];
                    if (URL) {
                        done(URL.createObjectURL(file));
                    } else if (FileReader) {
                        reader = new FileReader();
                        reader.onload = function(e) {
                            done(reader.result);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            })

            // j'ajoute mon evenement
            cropPhotoModal.addEventListener('show.bs.modal', function() {
                cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 3,
                    preview: '.preview'
                });
            });

            cropPhotoModal.addEventListener('hidden.bs.modal', function() {
                cropper.destroy();
                cropper = null;
            });

            cropButton.addEventListener('click', function() {
                canvas = cropper.getCroppedCanvas();

                canvas.toBlob(function(blob) {
                    url = URL.createObjectURL(blob);
                    var reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function() {
                        var base64data = reader.result;
                        imageHidden.value = base64data
                        modalObject.hide();
                    }
                });
            });
        </script>
    @endpush

    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
    @endpush
