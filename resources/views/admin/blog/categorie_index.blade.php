@extends("admin.template")

@section("main")
	<h2 class="text-center">Listes Des Categories</h2>
		<a href="{{route('admin.blogCat.create')}}">Creer Une nouvelle Categorie</a>
	<div class="container-wrapper">
		@foreach($categories as $cat)
			<div class="card w-auto d-inline-block">
				<div class="card-header">
					# {{$loop->index + 1}}
				</div>
				<div class="card-title">
					{{ $cat->nom }}
				</div>
				<div class="card-footer d-flex justify-content-around">
					<a href="{{route('admin.blogCat.edit',['blogCat'=>$cat->id])}}" class="btn btn-outline-info">Editer</a>
					<form method="POST" action="{{route('admin.blogCat.destroy',$cat->id)}}">
						@csrf
						<button type="submit" class="btn btn-danger">Del</button>
					</form>
				</div>
			</div>
		@endforeach
	</div>
@endsection