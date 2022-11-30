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
            <form action="{{ route('admin.events.store') }}" class="col-5" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="titre">Titre</label>
                    <input type="text" name="titre" class="form-control">
                </div>
                <div class="mb-4">
                    <label for="titre">Lieu De l'event</label>
                    <input type="text" name="lieu" class="form-control border p-2">
                </div>
                <div class="mb-4">
                    <label for="titre">Date de Debut</label>
                    <input type="datetime-local" name="start_at" class="form-control">
                </div>

                <div class="mb-4">
                    <label for="titre">Poster De event</label>
                    <input type="file" id="file" name="poster_url" class="form-control-file border p-2" accept="image/*">
                </div>

                <div class="mb-4">
                    <label for="titre">Description event</label>
                    <textarea name="description" class="form-control border p-2"></textarea>
                </div>
                <input type="hidden" name="cropdata" value="" id="inputHide">
                <div>
                    <button type="reset" class="btn btn-danger">Reinitialiser</button>
                    <button type="submit" class="btn btn-success">Creer</button>
                </div>
            </form>
            <div class="col-7">
                <div class="border p-1">
                    <img src="{{ asset('images/favicon.png') }}" class="img-fluid" alt="" id="imgblock">
                    <button class="btn   btn-success" id="crop">recardrer</button>
                    <button class="btn btn-danger  mt-2" id="del">delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/cropper.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('js/cropper.js') }}"></script>
    <script defer>
        var tmp = document.getElementById("imgblock");
        const ev2 = document.getElementById("event2");
        const cropButton = document.getElementById("crop")
        const file_poster = document.querySelector("#file")
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
                console.log("initialize cropper firsty")
            }
            // }, 500);
        }
    </script>
@endpush


