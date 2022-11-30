@extends("admin.template")

@section("main")
	<h1 class="text-center">Edition de La categorie</h1>

	<fieldset>
		<form method="post" action="{{route('admin.blogCat.update',["blogCat"=>$categorie->id])}}">
			@csrf
			@method("PUT")
			<div class="mb-3">
				<label class="form-label">Nom de La Categorie</label>
				<input type="text" name="nom" value="{{$categorie->nom}}" class="form-control" placeholder="nom de la categorie a ajouter">
			</div>
			<button type="submit" class="btn btn-success">Editer</button>
		</form>
	</fieldset>
@endsection