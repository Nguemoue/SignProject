@extends('template')

@section('main')
    <!--================ Hero banner start =================-->
    <section class="hero-banner">
        <div class="container">
            <div class="row no-gutters align-items-center pt-60px">
                <div class="col-5 d-none d-sm-block">
                    <div class="hero-banner__img">
                        <img class="img-fluid" src="img/home/hero-banner.png" alt="">
                    </div>
                </div>
                <div class="col-sm-7 col-lg-6 offset-lg-1 pl-4 pl-md-5 pl-lg-0">
                    <div class="hero-banner__content">
                        <h4>Shop is fun</h4>
                        <h1>Browse Our Premium Product</h1>
                        <p>Us which over of signs divide dominion deep fill bring they're meat beho upon own earth
                            without morning over third. Their male dry. They are great appear whose land fly grass.
                        </p>
                        <a class="button button-hero" href="{{ route('shop.category') }}">Browse Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ Hero banner start =================-->

    <!--================ Hero Carousel start =================-->
    <section class="section-margin mt-0">
        <div class="owl-carousel owl-theme hero-carousel">
            @foreach ($categories as $cat)
                <div class="hero-carousel__slide">
                    <img src="{{ asset('storage/' . $cat->image) }}" alt="categorie {{ $cat->nom }}" class="img-fluid">
                    <a href="{{ route('shop.category',['categorie'=>$cat->nom]) }}" class="hero-carousel__slideOverlay">
                        <h3>{{ $cat->nom }}</h3>
                        <p>{{ $cat->description }}</p>
                    </a>
                </div>
            @endforeach

        </div>
    </section>
    <!--================ Hero Carousel end =================-->

    <!-- ================ trending product section start ================= -->
    <section class="section-margin calc-60px">
        <div class="container">
            <div class="section-intro pb-60px">
                <p>Popular Item in the market</p>
                <h2>Trending <span class="section-intro__style">Product</span></h2>
            </div>
            <div class="row">
                @foreach ($mostLiked as $item)
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card text-center card-product">
                            <div class="card-product__img">
                                <img class="card-img" src="{{ asset('storage/' . $item->images?->first()?->photo) }}"
                                    alt="image {{ $item->nom }}">
                                <ul class="card-product__imgOverlay">
                                    <li>
                                        <a href="{{ route('shop.singleProduct', ['productId' => $item->id]) }}">
                                            <button><i class="ti-search"></i></button>
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('cart.index') }}" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{ $item->id }}" name="produitId">
                                            <input type="hidden" name="quantite" value="1" />
                                            <button type="submit"><i class="ti-shopping-cart"></i></button>
                                        </form>
                                    </li>
                                    <li>
                                        <button><i @class(['ti-heart'])></i></button>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <p>{{ $item->categorie?->nom }}</p>
                                <h4 class="card-product__title"><a href="single-product.html">{{ $item->nom }}</a>
                                </h4>
                                <p class="card-product__price">{{ $item->prix }} Eur</p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- ================ trending product section end ================= -->


    <!-- ================ offer section start ================= -->
    <section class="offer" id="parallax-1" data-anchor-target="#parallax-1" data-300-top="background-position: 20px 30px"
        data-top-bottom="background-position: 0 20px">
        <div class="container">
            <div class="row">
                <div class="col-xl-5">
                    <div class="offer__content text-center">
                        <h3>Up To 50% Off</h3>
                        <h4>Winter Sale</h4>
                        <p>Him she'd let them sixth saw light</p>
                        <a class="button button--active mt-3 mt-xl-4" href="#">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ offer section end ================= -->

    <!-- ================ Best Selling item  carousel ================= -->
    <section class="section-margin calc-60px">
        <div class="container">
            <div class="section-intro pb-60px">
                <p>Popular Item in the market</p>
                <h2>Best <span class="section-intro__style">Sellers</span></h2>
            </div>
            <div class="owl-carousel owl-theme" id="bestSellerCarousel">
                @foreach ($mostSell as $item)
                <div class="card text-center card-product">
                    <div class="card-product__img">
                        <img class="img-fluid" src="{{ asset('storage/'.$item->images?->first()?->photo) }}" alt="logo {{ $item->nom }}">
                        <ul class="card-product__imgOverlay">
                            <li>
                                <a href="{{ route('shop.singleProduct', ['productId' => $item->id]) }}">
                                    <button><i class="ti-search"></i></button>
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('cart.index') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $item->id }}" name="produitId">
                                    <input type="hidden" name="quantite" value="1" />
                                    <button type="submit"><i class="ti-shopping-cart"></i></button>
                                </form>
                            </li>
                            <li>
                                <button><i @class(['ti-heart'])></i></button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <p>{{ $item->categorie?->nom }}</p>
                        <h4 class="card-product__title"><a href="single-product.html">{{ $item->nom }}</a></h4>
                        <p class="card-product__price">{{ $item->prix }} Eur.</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ================ Best Selling item  carousel end ================= -->

    <!-- ================ Blog section start ================= -->
    <section class="blog">
        <div class="container">
            <div class="section-intro pb-60px">
                <p>Popular Item in the market</p>
                <h2>Latest <span class="section-intro__style">News</span></h2>
            </div>

            <div class="row">
                @foreach ($latestBlogs as $blog)                
                <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                    <div class="card card-blog">
                        <div class="card-blog__img">
                            <img class="card-img rounded-0" src="{{ asset('storage/'.$blog->image) }}" alt="image {{ $blog->titre }}">
                        </div>
                        <div class="card-body">
                            <ul class="card-blog__info">
                                {{-- <li><a href="#">By Admin</a></li> --}}
                                <li><a href="#"><i class="ti-comments-smiley"></i> {{ $blog->comments->count() }} Comments</a></li>
                            </ul>
                            <h4 class="card-blog__title"><a href="{{ route('blog.singleBlog',['blogId'=>$blog->id]) }}">{{ $blog->titre }}</a></h4>
                            <p>{{ Str::words($blog->contenu,10)}}</p>
                            <a class="card-blog__link" href="{{ route('blog.singleBlog',['blogId'=>$blog->id]) }}">Lire la suite <i class="ti-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>
    <!-- ================ Blog section end ================= -->
@endsection
