@extends('admin.template')

@section('main')
    <h1 class="text-center">Creer un noveau post</h1>
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
        <div class="row">
            <form action="{{ route('admin.blogs.store') }}" class="col-5" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="titre">Titre</label>
                    <input id="titre" type="text" name="titre" class="form-control">
                </div>

                <div class="mb-4">
                    <label for="titre">photo du blog</label>
                    <input type="file" id="file" name="photo" class="form-control-file border p-2"
                        accept="image/*">
                </div>


                <div class="mb-4">
                    <label for="titre">contenu blog</label>
                    <textarea id="description" name="content" class="form-control border p-2"></textarea>
                </div>
                <div class="mb-4">
                    <label for="categorie">Categories </label>
                    <select name="categorie" id="langue" class="select2-container form-control">
                        @foreach ($categories as $categorie)
                            <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" name="cropdata" value="" id="imageHidden">
                <div>
                    <button type="reset" class="btn btn-danger">Reinitialiser</button>
                    <button type="submit" class="btn btn-success">Creer</button>
                </div>
            </form>
            <div id="preview-box" class="col border d-flex flex-column">
                <p class="text-muted">
                    prevusialisation
                </p>
                <img src="" id="preview-image" class="img img-fluid" alt="prview image">
                <p id="preview-title" class="text-center h4">

                </p>
                <textarea  id="preview-description" disabled class="form-control text-danger border p-3">

                </textarea>
            </div>

        </div>
    </div>

    {{-- je cree ma modal pour le cropper de l'image --}}
    <div class="modal  fade" id="cropPhotoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="cropPhotoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" id="cropPhotoModalLabel">Recarder l'image du blog</h1>
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
    <script type="text/javascript">
        const file = document.querySelector("#file")
        const img = document.getElementById("preview-image")
        const titre = document.getElementById("titre")
        const description = document.getElementById("description")
        const preview_title = document.getElementById("preview-title")
        const preview_description = document.getElementById("preview-description")
        titre.addEventListener("keyup", function(event) {
            preview_title.innerText = event.target.value
        })
        description.addEventListener("keyup", function(event) {
            preview_description.innerText = event.target.value
        })
        file.addEventListener("change", changeImage)
        let fileReader = new FileReader()
        fileReader.addEventListener("load", (data) => {
            // put the src data
            img.src = data.target.result
        })

        function changeImage(event) {
            // check if the image is loaded
            if (event.target.files[0] && event.target.files.length) {
                let blob = event.target.files[0]
                // read the blob now
                if (FileReader) {
                    fileReader.readAsDataURL(blob)
                } else if (URL) {
                    URL.createObjectURL(blob)
                }
            }
        }
    </script>
@endpush


@push('scripts')
    <script defer>
        const imageFile = document.getElementById('file')
        const image = document.getElementById('cropImage');
        const cropPhotoModal = document.getElementById("cropPhotoModal")
        const imageHidden = document.getElementById("imageHidden")
        const cropButton = document.getElementById("cropButton")
        var cropper;
        const modalObject = new bootstrap.Modal(cropPhotoModal);

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
                aspectRatio: 3/2,
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
