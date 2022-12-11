@extends('template')


@section('main')
    <!-- ================ start banner area ================= -->
    <section class="blog-banner-area" id="category">
        <div class="container h-100">
            <div class="blog-banner">
                <div class="text-center">
                    <h1>Shopping Cart</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ end banner area ================= -->

    <!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                @if (session()->exists('panier.produits') and session()->get('panier.produits')!=[])
                    @includeIf('_partials.errors')
                    <form action="{{ route('shop.checkout.store') }}" method="POST">
                        @csrf
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Produit</th>
                                        <th scope="col">Prix</th>
                                        <th scope="col">Quantite</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($produits as $produit)
                                        <x-cart-element-component :produit="$produit" :key="'produit-' . $produit->nom" />
                                    @endforeach
                                </tbody>
                            </table>
                            <div>
                                <button type="submit" class="btn btn-primary">Proceder au paiement</button>
                            </div>
                        </div>
                    </form>
                @else
                    <div class="alert alert-warning">
                        Aucun produit dans le panier
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!--================End Cart Area =================-->
@endsection
