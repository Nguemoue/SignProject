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
        <div class="row">
            <form action="{{ route('admin.blogs.update', ['blog' => $blog]) }}" class="col-7" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="titre">Titre</label>
                    <input id="titre" type="text" value="{{ $blog->titre }}" name="titre" class="form-control">
                </div>

                <div class="mb-4">
                    <label for="titre">photo du blog</label>
                    <input type="file" id="file" name="photo" class="form-control-file border p-2"
                        accept="image/*">
                </div>

                <div class="mb-2">

                    <label for="resource_type">Resource</label>
                    <select name="resource_type" id="resource_type" class="form-control">
                        <option value="video">Video</option>
                        <option value="audio">Audio</option>
                        <option value="image">Image</option>
                    </select>
                    <div class="mt-2">
                        <label for="resource" class="btn btn-success">selectionner la resource</label>
                        <input type="file" accept="video/*" name="resource" autofocus aria-controls="" id="resource"
                            class="d-none" value="">
                    </div>
                </div>
                <div class="mb-4">
                    <label for="categorie">Categories </label>
                    <select name="categorie" id="langue" class="select2-container form-control">
                        @foreach ($categories as $categorie)
                            <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="titre">contenu blog</label>
                    <textarea id="description" name="content" row="10" class="form-control border p-2">{{ $blog->contenu }}</textarea>
                </div>
                <input type="hidden" name="cropData" value="" id="imageHidden">
                <div>
                    <button type="reset" class="btn btn-danger">Reinitialiser</button>
                    <button type="submit" class="btn btn-success">Mettre A Jour</button>
                </div>
            </form>
            <div id="preview-box" class="col border d-flex flex-column flex-wrap">
                <h3 class="text-muted text-center">
                    previsualisation du post
                </h3>
                <div class="row">
                    <div class="col-12">
                        <img src="{{ asset('storage/' . $blog->image) }}" id="preview-image" class="img img-fluid"
                            alt="prview image">

                    </div>
                    <div class="col-12">
                        <p id="preview-title" class="text-center h4">
                            {{ $blog->titre }}
                        </p>
                        <textarea disabled  id="preview-description" class="form-control text-danger p-3" >{{ $blog->contenu }}</textarea>
                    </div>
                </div>
            </div>

        </div>
        <hr class="my-2"/> 
        <div class="border my-2 bg-"></div>
        <div class="row">
            <div class="col-7">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Resource du post</h4>
                    </div>
                    <div class="card-footer">
                        @php($resource = $blog->resource)
                        @if ($resource)
                            @if ($resource->type == 'audio')
                                <video controls src="{{ asset('storage/' . $resource->contenu) }}"></video>
                            @elseif ($resource->type == 'video')
                                <video controls src="{{ asset('storage/' . $resource->contenu) }}"></video>
                            @elseif ($resource->type == 'image')
                                <img class="img-fluid" src="{{ asset('storage/' . $resource->contenu) }}" alt="image">
                            @endif
                        @endif
                    </div>
                    <div class="card-footer">
                        Type: {{ $resource->type??'non defini' }}
                    </div>
                </div>
            </div>
        </div>
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
    <script type="text/javascript">
        const file = document.querySelector("#file")
        const img = document.getElementById("preview-image")
        const titre = document.getElementById("titre")
        const description = document.getElementById("description")
        const preview_title = document.getElementById("preview-title")
        const preview_description = document.getElementById("preview-description")
        titre.addEventListener("keyup", function(event) {
            preview_title.textContent = event.target.value
        })
        description.addEventListener("keyup", function(event) {
            preview_description.textContent = event.target.value
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
    <script>
        (function() {
            let changeMimeType = function(event) {
                let value = event.target.value
                if (value == "audio") {
                    resource.setAttribute('accept', "audio/*")
                } else if (value == "video") {
                    resource.setAttribute('accept', "video/*")

                } else if (value == "image") {
                    resource.setAttribute('accept', "image/*")

                }
            }
            // changeMimeType()

            let resource = document.getElementById("resource")
            let resourceType = document.getElementById("resource_type")
            resourceType.addEventListener("change", changeMimeType)
        })()
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
