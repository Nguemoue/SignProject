{{-- cette page doit gerer la liste des categories de produits disponibles --}}

@extends("admin.template")


@section("main")
    <h2 class="text-center">Liste des categories de produits disponibles:</h2>
    <hr>
    <div class="float-right mb-2">
        <a href="{{ route('admin.categorieProduit.create') }}" class="btn btn-success">
            <span class="mdi mdi=plus">Nouvelle categorie</span>
        </a>
    </div>
    <div class="container table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr class="border bg-light position-static static table-striped">
                    <th>#</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>creer le</th>
                    <th>Mis a jour le</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorieProduits as $categorieProduit)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $categorieProduit->nom }}</td>
                        <td>{{ Str::words($categorieProduit->description,2) }}</td>
                        <td>
                            <img width="300" style="all:unset;width:100px" src="{{ asset('storage/'.$categorieProduit->image) }}" class="img-fluid" 
                                alt="image de {{ $categorieProduit->nom }}" />
                        </td>
                        <td>{{ $categorieProduit->created_at->IsoFormat('lll') }}</td>
                        <td>{{ $categorieProduit->updated_at->IsoFormat('lll') }}</td>
                        
                        <td>
                            <div class="btn-group">
                                <form action="{{ route('admin.categorieProduit.destroy',['categorieProduit'=>$categorieProduit->id]) }}" method="POST">
                                    @method("DELETE")
                                    @csrf
                                    <button type="submit" class="btn btn-danger"><span class="mdi mdi-delete"></span></button>
                                </form>
                                <a href="{{ route('admin.categorieProduit.edit',['categorieProduit'=>$categorieProduit->id]) }}" class="btn btn-outline-secondary"><span class="mdi mdi-pencil"></span></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>    
    
    </div>   
@endsection