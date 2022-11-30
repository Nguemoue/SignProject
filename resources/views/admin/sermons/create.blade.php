@extends("admin.template")

@section("main")
@if ($errors->any())
    
    <div class="alert alert-secondary alert-dismissible">
        <div class="alert-heading">des Erreurs on ete detectes</div>
        @foreach ($errors->all() as $error )
            <div>
                {{$error}}
            </div>
        @endforeach
    </div>
@endif
    <div class="container border p-4">
        <form action="{{ route("admin.sermons.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="titre">Titre</label>
                <input type="text" name="titre" class="form-control">
            </div>

            <div class="mb-4">
                <label for="titre">Poster Du Sermon</label>
                <input type="file" name="poster_url" class="form-control-file border p-2" accept="image/*">
            </div>

            <div class="mb-4">
                <label for="titre">Video Du Sermon</label>
                <input type="file" class="form-control-file border p-2" name="video_url" accept="video/*">
            </div>

            <div class="mb-4">
                <label for="titre">Description</label>
                <textarea name="description" class="form-control" id="" cols="30" rows="5"></textarea>
            </div>

            <div class="mb-4">
                <label for="titre">Auteur</label>
                <input type="text" class="form-control" name="author">
            </div>
            <div>
                <button type="reset" class="btn btn-danger">Reinitialiser</button>
                <button type="submit" class="btn btn-success">Creer</button>
            </div>
        </form>
    </div>
@endsection