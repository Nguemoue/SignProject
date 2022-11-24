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
                                        <input wire:click="setCategorie('')" class="pixel-radio" type="radio"
                                            id="men" name="brand">
                                        <label for="toute"><span>Toutes
                                                ({{ $nbProduits }})</span></label>
                                    </li>
                                </a>
                                @foreach ($categories as $categorie)
                                    <a class="d-block" style="color: none;text-decoration:none;">
                                        <li class="filter-list">
                                            <input wire:click="setCategorie('{{ $categorie->nom }}')"
                                                class="pixel-radio" @checked($categorie->nom == $currentCat) type="radio"
                                                id="men" name="brand">
                                            <label for="{{ $categorie->nom }}"><span> {{ $categorie->nom }}
                                                    ({{ $categorie->nbProduits() }})
                                                </span></label>
                                        </li>
                                    </a>
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
                    <select>
                        <option hidden selected>Filtrer par</option>
                        <option value="1">Couleur</option>
                        <option value="1">Nom</option>
                    </select>
                </div>
                <div class="sorting mr-auto">
                    <select>
                        <option hidden selected>Prix :</option>
                        <option value="1">0-99</option>
                        <option value="1">100-199</option>
                        <option value="1">200-299</option>
                        <option value="1">300-399</option>
                        <option value="1">400-499</option>
                        <option value="1"> -- </option>
                    </select>
                </div>
                <div>
                    <div class="input-group filter-bar-search">
                        <input type="text" placeholder="Search">
                        <div class="input-group-append">
                            <button type="button"><i class="ti-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Filter Bar -->
            <!-- Start Best Seller -->
            <section class="lattest-product-area pb-40 category-list">
                <div class="row">
                    <div class="text-danger border px-4 container" wire:loading>
                        chargement du resultat .....
                    </div>
                    @forelse ($produits as $produit)
                        <div class="col-md-6 col-lg-4">
                            <div class="card text-center card-product">
                                <div class="card-product__img">
                                    <img class="card-img" loading="lazing" lazy
                                        src="{{ asset($produit->images[0]->photo) }}" alt="">
                                    <ul class="card-product__imgOverlay">
                                        <li><button><i class="ti-search"></i></button></li>
                                        <li><button><i class="ti-shopping-cart"></i></button></li>
                                        <li><button><i class="ti-heart"></i></button></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <p>{{ $produit->categorie?->nom }}</p>
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
                @if ($produits->links())
                    <div class="card-footer mx-auto w-50">
                        {{ $produits->links() }}
                    </div>
                @endif
            </section>
            <!-- End Best Seller -->
        </div>
    </div>
</div>
