<div class="container">
    <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-5">
            <div class="sidebar-categories " style="max-height: 70vh;overflow-y:scroll">
                <div class="head position-sticky">Categories</div>
                <ul class="main-categories">
                    <li class="common-filter">
                        <form action="#">
                            <ul>
                                <a class="d-block" style="color: none;text-decoration:none">
                                    <li class="filter-list">
                                        <input wire:click="setCategorie('')" checked class="pixel-radio" type="radio"
                                            id="men" name="brand">
                                        <label for="toute"><span>Toutes
                                                ({{ $nbProduits }})</span></label>
                                    </li>
                                </a>
                                @foreach ($categories as $categorie)
                                    <li>

                                        <label wire:click="setCategorie('{{ $categorie->nom }}')" class="filter-list"
                                            for="{{ $categorie->nom }}">
                                            <input class="pixel-radio" type="radio" id="{{ $categorie->nom }}"
                                                name="brand">
                                            <span> {{ $categorie->nom }} ({{ $categorie->nbProduits() }})</span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-xl-9 col-lg-8 col-md-7" >
            <!-- Start Filter Bar -->
            <div class="filter-bar d-flex flex-wrap align-items-center">

                <div>
                    <form action="#" wire:submit.prevent='rechercher' >
                        <div class="input-group filter-bar-search">
                            <input wire:model.debounce.4000="search" type="text" placeholder="Search">
                            <div class="input-group-append">
                                <button  type="submit"><i
                                        class="ti-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>


            </div>
            <!-- End Filter Bar -->
            <!-- Start Best Seller -->
            <section class="lattest-product-area pb-40 category-list">
                <div class="row">
                    <div class="text-danger mx-auto  p-2 container" wire:target='search'  wire:loading>
                        Recherche des elements en cours .....
                    </div>
                    @forelse ($produits as $produit)
                        <div class="col-md-4 col-lg-4">
                            <div class="card text-center card-product">
                                <div class="card-product__img">
                                    <img class="card-img" loading="lazing" 
                                        src="{{ asset('storage/' . ($produit->images?->first()?->photo)  )}}" alt="image {{ $produit->nom }}"/>
                                    <ul class="card-product__imgOverlay">
                                        <li><a href="{{ route('shop.singleProduct', ['productId' => $produit->id]) }}">

                                                <button><i class="ti-search"></i></button>
                                            </a></li>
                                        <li>
                                            <form action="{{ route('cart.index') }}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ $produit->id }}" name="produitId">
                                                <input type="hidden" name="quantite" value="1" />
                                                <button type="submit"><i class="ti-shopping-cart"></i></button>
                                            </form>
                                        </li>
                                        @auth
                                            
                                        <li>
                                            <button  wire:click="like({{ $produit->id}})" ><i 
                                                @class(["ti-heart", "liked"=>$produit->isLiked(auth()->user()->id)])>
                                            </i></button>
                                        </li>
                                        @endauth
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <p>{{ $produit->categorie ? $produit->categorie->nom : 'aucune categorie' }}</p>
                                    <h4 class="card-product__title"><a
                                            href="{{ route('shop.singleProduct', ['productId' => $produit->id]) }}">{{ $produit->nom }}</a>
                                    </h4>
                                    <p class="card-product__price">${{ $produit->prix }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="container alert alert-warning">
                            Aucun Element
                        </div>
                    @endforelse
                </div>
                @if($produits->links())
                    <div class="card-footer">
                            {{ $produits->links() }}
                    </div>
                @endif
            </section>
            <!-- End Best Seller -->
        </div>
    </div>
</div>
