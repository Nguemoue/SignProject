@extends("admin.template")

@section("main")
<h1 class="text-center">Liste des commandes</h1>
<hr>
<div class="container">
    <div class="row">
        <table class="table table-hover table-bordered">
            <thead>
                <tr class="border table-header-group">
                    <th>#</th>
                    <th>Prix Total</th>
                    <th>Utilisateur</th>
                    <th>Date de commande</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($commandes as $commande)
                    @php
                        $user = $commande->user;
                    @endphp
                    <tr>
                        <td>{{ $commande->id }}</td>
                        <td>{{ $commande->prixTtc }} Eur.</td>
                        <td>{{$user->name .' / '.$user->email  }}</td>
                        <td>{{ $commande->created_at->IsoFormat('lll') }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.user.commande.details',['user'=>$user->id,'commande'=>$commande->id ]) }}" class="btn btn-success">
                                    <span class="mdi mdi-eye"></span>
                                </a>   
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection