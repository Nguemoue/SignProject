<div class="container">
    <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-5">
            <div class="sidebar-categories " style="max-height: 70vh;overflow-y:scroll">
                <div class="head position-sticky">Browse Categories</div>
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
        <div class="col-xl-9 col-lg-8 col-md-7" style="max-height:80vh;overflow-y:scroll">
            <!-- Start Filter Bar -->
            <div class="filter-bar d-flex flex-wrap align-items-center">

                <div class="sorting mr-auto">
                    <div class=" mx-auto w-75">
                        {{ $produits->links() }}
                    </div>
                </div>
                <div>
                    <form action="#" wire:submit.prevent='rechercher' >
                        <div class="input-group filter-bar-search">
                            <input wire:model.defer="search" type="text" placeholder="Search">
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
                    <div class="text-danger  px-4 container" wire:loading>
                        traitement en cours .....
                    </div>
                    @forelse ($produits as $produit)
                        <div class="col-md-6 col-lg-4">
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
                                        <li><button><i class="ti-heart"></i></button></li>
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

            </section>
            <!-- End Best Seller -->
        </div>
    </div>
</div>
