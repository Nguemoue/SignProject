@extends('admin.template')

@section('main')
    <h4 class="text-center">Editions des Sermons</h4>
    <div>
        <p class="text-muted">
            sermon actuelle
        </p>
        <video controls class="border p-2 col-4 img img-thumnail" src="{{ asset('storage/' . $sermon->video_url) }}"
            poster="{{ asset('storage/' . $sermon->poster_url) }}"></video>

        <hr>
        <form action="{{ route('admin.sermons.update',[$sermon->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="my-2">
                <div class="mb-4">
                    <label for="titre">Titre</label>
                    <input type="text" name="titre" value="{{$sermon->titre}}" class="form-control">
                </div>

                <div class="mb-4">
                    <label for="titre">Nouveau Poster Du Sermon</label>
                    <input type="file" name="poster_url" class="form-control-file border p-2" accept="image/*">
                </div>

                <div class="mb-4">
                    <label for="titre">Nouvelle Video Du Sermon</label>
                    <input type="file" class="form-control-file border p-2" name="video_url" accept="video/*">
                </div>

                <div class="mb-4">
                    <label for="titre">Description</label>
                    <textarea name="description" class="form-control"  id="" cols="30" rows="5">
                        {{$sermon->titre}}
                    </textarea>
                </div>

                <div class="mb-4">
                    <label for="titre">Auteur</label>
                    <input type="text" value="{{$sermon->author}}" class="form-control" name="author">
                </div>
                <div>
                    <button type="reset" class="btn btn-danger">Reinitialiser</button>
                    <button type="submit" class="btn btn-outline-success">Editer
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push("scripts")
    <script src="{{public_path("js/cropper.js")}}"></script>
@endpush
