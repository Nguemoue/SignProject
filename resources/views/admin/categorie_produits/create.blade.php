@extends("admin.template")

@section('main')
    <h2 class="text-center">Edition d'une categorie</h2>
    
    <hr>
    <div class="container">
        <div class="">
            @includeIf("_partials.errorss")
            <form enctype="multipart/form-data" action="{{ route('admin.categorieProduit.store') }}"
                method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nom">Nom</label>
                    <input id="nom" name="nom" type="text" class="form-control"
                        placeholder="entrez le nom de la categorie de produit" value="{{ old('nom') }}" />
                </div>

                <div class="mb-3">
                    <label for="description">Description</label>
                    <textarea name="description" placeholder="entrez la description du produit" id="description" class="form-control">{{ old('description')}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="fileField" class="btn btn-secondary"> <span class="mdi mdi-image"></span> Image de la categorie</label>
                    <input id="fileField" accept="image/*" name="image" type="file" class="d-none form-control-file"  />
                </div>
                <input type="hidden" id="imageHidden" name="imageHidden" value=""/>
                <button type="submit" class="btn btn-primary">Creer</button>

            </form>
        </div>
    </div>
    {{-- misc --}}
    {{-- je cree ma modal pour le cropper de l'image --}}
        <div class="modal  fade" id="cropPhotoElement" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="cropPhotoElementLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-4" id="cropPhotoElementLabel">Creation de la photo</h1>
                        <button type="button" class="btn btn-danger mdi mdi-close-box" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="editPhotoField">Cop Image.</label>
                        <img src="" class="w-100" id="cropImage" alt="image">
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
        const fileField = document.getElementById('fileField')
        const image = document.getElementById('cropImage');
        const cropPhotoElement = document.getElementById("cropPhotoElement")
        const imageHidden = document.getElementById("imageHidden")
        const cropButton = document.getElementById("cropButton")
        var cropper;
        const cropPhotoModal = new bootstrap.Modal(cropPhotoElement);

        fileField.addEventListener('change', function(e) {
            var files = e.target.files;
            var done = function(url) {
                image.src = url;
                cropPhotoModal.show();
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
        cropPhotoElement.addEventListener('show.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
                preview: '.preview'
            });
        });

        cropPhotoElement.addEventListener('hidden.bs.modal', function() {
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
                    cropPhotoModal.hide();
                }
            });
        });
    </script>
@endpush

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
@endpush
