@extends('admin.template')

@section('main')
    <div class="container-fluid">
        <h2 class="text-center">Liste des Produits Disponibles</h2>
        <hr>
        <div class="container">
            {{ $produits->links() }}
        </div>
        <div class="row">
            @foreach ($produits as $produit)
                @php
                    $carouselId = 'carouselProduit-' . $produit->id;
                @endphp
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4  my-4 ">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between flex-wrap align-items-baseline">
                                <a href="#" class="btn-sm btn-light"><span class="mdi mdi-image-area"></span></a>
                                <h4 class="card-title text-wrap ">{{ $produit->nom }}</h4>
                            </div>
                            <span class="badge  px-1 mb-2">{{ $produit->quantite }} restant</span>
                        </div>
                        <div class="card-body">
                            <div id="{{ $carouselId }}" class="carousel slide" data-bs-touch="false">
                                <div class="carousel-inner">
                                    @foreach ($produit->images as $image)
                                        <div class="carousel-item  {{ $loop->first ? 'active' : '' }}">
                                            <div class="card w-100">
                                                <img src="{{ asset('storage/' . $image->photo) }}" class="d-block w-100 img-fluid"/>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="btn-group">
                                <button class="btn btn-secondary mdi mdi-arrow-left-bold-box"
                                    onclick="new bootstrap.Carousel('#{{ $carouselId }}').prev()"></button>
                                <button class="btn btn-secondary mdi mdi-arrow-right-bold-box"
                                    onclick="new bootstrap.Carousel('#{{ $carouselId }}').next()"></button>
                            </div>
                            <b>Prix: <span class="font-bold"> {{ number_format($produit->prix, 2, '.', ',') }} $ </span></b>
                        </div>
                        <div class="card-footer">
                            <div class="btn-group ">
                                <a href="{{ route('admin.produits.edit', ['produit' => $produit->id]) }}"
                                    class="btn btn-outlined-success"><span class="mdi mdi-pencil"></span> </a>
                                <a href="#" class="btn btn-outlined-primary mx-1"><span
                                        class="mdi mdi-information-outline"></span>
                                </a>
                                <a href="#" class="btn btn-outlined-secondary  mx-1"><span
                                        class="mdi mdi-delete"></span></a>

                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
        <div class="container-fluid">
            {{ $produits->links() }}
        </div>
    </div>
@endsection
