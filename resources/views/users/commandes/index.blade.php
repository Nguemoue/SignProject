@extends("users.template")

@section("main")
    <h6 class="text-center ">Vos Commandes</h6>
    <hr>
    @forelse ($commandesPerYear as $item)
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Commande Pour l'annee : {{ $item->y }}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Livre ? </th>
                                <th>Produits </th>
                                <th>Prix (Eur.)</th>
                                <th>Mois</th>
                                <th>Jour</th>
                                <th>Heure</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->infos as $detail)
                                <tr>
                                    <td>{{ $loop->index + 1  }}</td>
                                    <td><span @class(["btn-sm btn","btn-danger","btn-success"=>$detail->isValidated])>{{ $detail->isValidated?'Oui':"Non" }}</span>    </td>
                                    <td>
                                       <div class="d-flex flex-wrap">
                                         @forelse ($p = $detail->commandeProduits as $c )
                                                <span class="badge badge-success bg-secondary border p-1  "> {{ $c->produit->nom }} </span>
                                            @empty
                                                <span class="badge bg-secondary">Aucun</span>
                                             @endforelse
                                       </div>
                                    </td>
                                    <td>{{ $detail->prix }}</td>
                                    <td>{{ $detail->created_at->Format('M') }}</td>
                                    <td>{{ $detail->created_at->Format('d') }}</td>
                                    <td>{{ $detail->created_at->Format('H \hi') }}</td>
                                    <td>
                                        <div class="btn-group" >
                                            <a href="#" class="mdi mdi-download btn"></a>
                                            <a href="{{ route('dashboard.commandes.detail',['id'=>$detail->id]) }}" class="mdi mdi-eye btn "></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tr>
                            <th>Total</th>
                            <th class="text-center" colspan="8"><b>{{ $item->total }} Eur</b></th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-warning">
            Aucune Commande 
        </div>
    @endforelse
@endsection