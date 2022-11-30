@extends('admin.template')

@section('main')
    <h4 class="text-center">Editions des livres</h4>
    <div class="">
        <form class="col-11" action="{{ route('admin.livres.update', [$livre->id]) }}" method="post"
            enctype="multipart/form-data" id="form">
            @csrf
            @method('put')
            <div class="my-2">
                <div class="mb-4">
                    <label for="titre">Titre</label>
                    <input type="text" name="titre" value="{{ $livre->titre }}" class="form-control">
                </div>

				<div class="mb-4">
					<label for="langue">Langue </label>
					<select name="langue" id="langue" class="select2-container form-control">
						<option @if($livre->langue == 'francais') selected @endif value="francais">Francais</option>
						<option @if($livre->langue == 'anglais') selected @endif value="anglais">Anglais</option>
						<option @if($livre->langue == 'billingue') selected @endif value="billingue">Billingue</option>
					</select>
				</div>

                <div class="mb-4">
                    <label for="titre">Description</label>
                    <textarea name="description" class="form-control" id="" cols="30" rows="5">
                        {{ trim($livre->description) }}
                    </textarea>
                </div>

                <div class="mb-4">
                    <label for="titre">Nouveau Poster Du livre</label>
                    <input type="file" id="file_poster" name="poster_url" class="form-control-file border p-2"
                        accept="image/*">
                </div>

                <div class="mb-4">
                    <label for="titre">Nouveau Pdf Du livre</label>
                    <input type="file" id="resource_url" name="resource°url" class="form-control-file border p-2"
                        accept="application/pdf">
                </div>


                <div>
                    <button type="reset" class="btn btn-danger">Reinitialiser</button>
                    <button id="submit" type="submit" class="btn btn-outline-success">Editer
                    </button>
                </div>
            </div>
        </form>
        <p class="text-muted col-9">
            <span class="h5 mb-4">livre Actuelle</span>
            <br>
            <img src="{{ asset('storage' . DIRECTORY_SEPARATOR . $livre->poster_url) }}" class="img-fluid" id="livre"
                alt="">
            <button class="btn btn-social-icon btn-success mt-2" id="crop">crop</button>
        </p>
    </div>
@endsection
