@extends('admin.template')

@section('main')
    <h4 class="text-center">Editions des events</h4>
    <div class="row">
        <form class="col-8" action="{{ route('admin.events.update', [$event->id]) }}" method="post"
            enctype="multipart/form-data" id="form">
            @csrf
            @method('put')
            <div class="my-2">
                <div class="mb-4">
                    <label for="titre">Titre</label>
                    <input type="text" name="titre" value="{{ $event->titre }}" class="form-control">
                </div>

                <div class="mb-4">
                    <label for="titre">Lieu</label>
                    <input type="text" name="lieu" value="{{ $event->lieu }}" class="form-control">
                </div>

                <div class="mb-4">
                    <label for="titre">Description</label>
                    <textarea name="description" class="form-control" id="" cols="30" rows="5">
                        {{ $event->description }}
                    </textarea>
                </div>
                <div class="mb-4">
                    <label for="titre">Nouveau Poster Du event</label>
                    <input type="file" id="file_poster" name="poster_url" class="form-control-file border p-2"
                        accept="image/*">
                </div>


                <input type="hidden" value="" name="cropdata" id="inputHide">

                <div>
                    <button type="reset" class="btn btn-danger">Reinitialiser</button>
                    <button id="submit" type="submit" class="btn btn-outline-success">Editer
                    </button>
                </div>
            </div>
        </form>
        <p class="text-muted col-9">
            <span class="h5 mb-4">Event Actuelle</span>
            <br>
            <img src="{{ asset('storage' . DIRECTORY_SEPARATOR . $event->poster_url) }}" class="img-fluid" id="event"
                alt="">
            <img src="" width="50" id="event2" alt="">
            <button class="btn btn-social-icon btn-success mt-2" id="crop">crop</button>
            <button class="btn btn-danger btn-social-icon mt-2" id="del">delete</button>
        </p>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/cropper.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('js/cropper.js') }}"></script>
@endpush
@push('scripts')
    <script defer>
        var tmp = document.getElementById("event");
        const ev2 = document.getElementById("event2");
        const cropButton = document.getElementById("crop")
        const file_poster = document.querySelector("#file_poster")
        const del = document.getElementById("del")
        // file reader
        const fr = new FileReader();
        fr.onloadend = finishLoad
        var isCropped = false
        var cropper = null;
        const uploadHiden = document.getElementById("inputHide")
        cropButton.addEventListener("click", setCroppedImageToForm)
        del.onclick = function() {
            if (cropper != null) {
                if (cropper.cropped) {
                    cropper.destroy()
                }
                cropper = null
            }
        }

        function finishLoad(data) {
            tmp.src = data.target.result
            ev2.src = data.target.result
            done()

        }

        file_poster.addEventListener("change", (event) => {
            tmp.src = ""
            const files = event.target.files
            const blob = files[0]
            fr.readAsDataURL(files[0])

        })

        function done() {
            if (cropper == null) {
                cropper = new Cropper(tmp, {
                    scalable: true,
                    viewMode: 3,
                    aspectRatio: 16 / 9,
                    cropBoxResizable: true,
                })
            }

        }

        function setCroppedImageToForm() {

            console.log("setc called")
            // canvas = cropper.getCroppedCanvas();
            // setTimeout(() => {
            if (cropper != null) {
                canvas = cropper.getCroppedCanvas();
                canvas.toBlob(function(blob) {
                    var fr2 = new FileReader();
                    fr2.readAsDataURL(blob);
                    fr2.onloadend = function(data) {
                        uploadHiden.value = data.target.result;
                        console.log(uploadHiden.value)
                        // document.getElementById("form").submit();
                    };
                });
            } else {
                done()
                setTimeout(() => {
                    canvas = cropper.getCroppedCanvas();
                    canvas.toBlob(function(blob) {
                        var fr2 = new FileReader();
                        fr2.readAsDataURL(blob);
                        fr2.onloadend = function(data) {
                            uploadHiden.value = data.target.result;
                            console.log(uploadHiden.value)
                            // document.getElementById("form").submit();
                        };
                    });
                }, 500);
            }
            // }, 500);
        }
    </script>
@endpush
