@extends("admin.template")

@section("main")
	<h1 class="text-center">Ajouter une Nouvelle Categorie pour les blogs</h1>

	<fieldset>
		<form method="post" action="{{route('admin.blogCat.store')}}">
			@csrf
			<div class="mb-3">
				<label class="form-label">Nom de La Categorie</label>
				<input type="text" name="nom" class="form-control" placeholder="nom de la categorie a ajouter">
			</div>
			<button type="submit" class="btn btn-success">Ajouter</button>
		</form>
	</fieldset>
@endsection