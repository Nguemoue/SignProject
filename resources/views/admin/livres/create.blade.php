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
            <form action="{{ route('admin.livres.store') }}" class="col-5" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="titre">Titre</label>
                    <input id="titre" type="text" name="titre" class="form-control">
                </div>

                <div class="mb-4">
                    <label for="titre">Poster De livre</label>
                    <input type="file" id="file" name="poster_url" class="form-control-file border p-2" accept="image/*">
                </div>

                <div class="mb-4">
                    <label for="titre">Chemin du pdf</label>
                    <input type="file" id="file" name="resource_url" class="form-control-file border p-2"
                        accept="application/pdf">
                </div>
                <div class="mb-4">
                    <label for="titre">Description livre</label>
                    <textarea id="description" name="description" class="form-control border p-2"></textarea>
                </div>
				<div class="mb-4">
					<label for="langue">Langue </label>
					<select name="langue" id="langue" class="select2-container form-control">
						<option value="francais">Francais</option>
						<option value="anglais">Anglais</option>
						<option value="billingue">Billingue</option>
					</select>
				</div>
                <input type="hidden" name="cropdata" value="" id="inputHide">
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
                <p id="preview-description" class="text-danger border p-3">

                </p>
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
