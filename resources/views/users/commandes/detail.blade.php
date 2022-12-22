@extends("users.template")

@section("main")
<h4 class="text-center">
   <a class="btn btn-primary btn-sm mdi mdi-arrow-left" ></a> Information sur la commande <b>{{ $commande->numero }}</b>
</h4>
<div class="card">
        <div class="card-header border">
            <button class="btn btn-primary"> <span class="mdi mdi-download"></span> Telecharger le pdf</button>
        </div>
        <div class="card-header">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Date de commande</th>
                        <th>Prix TTC</th>
                        <th>Prix Hors Taxe</th>
                        <th>Taxe</th>
                        <th>Valider</th>
                    </tr>
                </thead>    
                <tbody>
                    <tr>
                        <th>{{ $commande->created_at->isoformat('lll') }}</th>
                        <th>{{ $commande->prixTtc }} Eur.</th>
                        <th>{{ $commande->prix }} Eur.</th>
                        <th>{{ $commande->prixTtc  - $commande->prix }} Eur.</th>
                        <th>{{ $commande->isValidated?"Oui":"non" }}</th>
                    </tr>
                </tbody>
            </table>    
            <hr>
            <div class="card">
                <div class="card-header border mb-2">Produits Commandes</div>
                <div class="card-body d-flex">
                    @foreach ($commande->commandeProduits as $item)
                        <ul class="list-unstyled border text-right p-4 mx-4">
                            <li><span class="badge badge-dark bg-dark">{{ $item->produit->nom }} =  <em>{{ $item->quantite }} Piece</em></span> </li>
                            <br>
                            <li>Prix  : <b>{{ $item->quantite * $item->produit->prix }} Eur.</b></li>
                        </ul>
                    @endforeach
                </div>
            </div>
        </div>
        
    </div>
@endsection