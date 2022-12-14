@extends('template')

@section('main')
    <!-- ================ start banner area ================= -->
    <section class="blog-banner-area" id="blog">
        <div class="container h-100">
            <div class="blog-banner">
                <div class="text-center">
                    <h1>Our Blog</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Blog</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ end banner area ================= -->


    <!--================Blog Categorie Area =================-->
    <section class="blog_categorie_area">
        <div class="container">
            <div class="row">
                @foreach ($latestCategories as $categorie)
                    <div class="col-sm-6 col-lg-4 mb-4 mb-lg-0">
                        <div class="categories_post">
                            <img class="card-img rounded-0" src="{{ $categorie->poster }}" alt="post">
                            <div class="categories_details">
                                <div class="categories_text">
                                    <a href="{{ route('blog.index', ['categorie' => $categorie->nom]) }}">
                                        <h5>{{ $categorie->nom }}
                                    </a>
                                    <div class="border_line"></div>
                                    <p>{{ $categorie->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--================Blog Categorie Area =================-->

    <!--================Blog Area =================-->
    <section class="blog_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog_left_sidebar">
                        @forelse ($blogs as $blog)
                            <article class="row blog_item">
                                <div class="col-md-3">
                                    <div class="blog_info text-right">
                                        <div>
                                            <a class="badge bg-secondary text-light p-1 text-wrap text-truncate"
                                                href="#">
                                                {{ Str::words($blog->categorie->nom, 2) }}
                                                <i class="lnr lnr-eye"></i>
                                            </a>
                                        </div>
                                        <ul class="blog_meta list">
                                            <li>
                                                <em href="#!">Mark wiens
                                                    <i class="lnr lnr-user"></i>
                                                </em>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    {{ $blog->created_at->IsoFormat('ll') }}
                                                </a>
                                            </li>
                                            <li>
                                                <span>{{ $blog->comments->count() }} Comments
                                                    <i class="lnr lnr-bubble"></i>
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="blog_post">
                                        <img src="{{ asset('storage/'.$blog->image) }}" alt="image de {{ $blog->titre }}">
                                        <div class="blog_details">
                                            <a href="{{ route('blog.singleBlog', ['blogId' => $blog->id]) }}">
                                                <h2>{{ $blog->titre }}</h2>
                                            </a>
                                            <p>{{ $blog->contenu }}</p>
                                            <a class="button button-blog"
                                                href="{{ route('blog.singleBlog', ['blogId' => $blog->id]) }}">View More</a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="alert alert-warning">
                                desole aucune post dispobible 
                            </div>
                        @endforelse

                        <nav class="blog-pagination justify-content-center d-flex">
                            {{ $blogs->links() }}
                        </nav>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search Posts">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="lnr lnr-magnifier"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                            <div class="br"></div>
                        </aside>
                        {{-- <aside class="single_sidebar_widget author_widget">
                            <img class="author_img rounded-circle" src="img/blog/author.png" alt="">
                            <h4>Charlie Barber</h4>
                            <p>Senior blog writer</p>
                            <div class="social_icon">
                                <a href="#">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#">
                                    <i class="fab fa-github"></i>
                                </a>
                                <a href="#">
                                    <i class="fab fa-behance"></i>
                                </a>
                            </div>
                            <p>Boot camps have its supporters andit sdetractors. Some people do not understand why you
                                should
                                have to spend money on boot camp when you can get. Boot camps have itssuppor ters andits
                                detractors.
                            </p>
                            <div class="br"></div>
                        </aside> --}}
                        {{-- <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Popular Posts</h3>
                            <div class="media post_item">
                                <img src="img/blog/popular-post/post1.jpg" alt="post">
                                <div class="media-body">
                                    <a href="single-blog.html">
                                        <h3>Space The Final Frontier</h3>
                                    </a>
                                    <p>02 Hours ago</p>
                                </div>
                            </div>
                            <div class="media post_item">
                                <img src="img/blog/popular-post/post2.jpg" alt="post">
                                <div class="media-body">
                                    <a href="single-blog.html">
                                        <h3>The Amazing Hubble</h3>
                                    </a>
                                    <p>02 Hours ago</p>
                                </div>
                            </div>
                            <div class="media post_item">
                                <img src="img/blog/popular-post/post3.jpg" alt="post">
                                <div class="media-body">
                                    <a href="single-blog.html">
                                        <h3>Astronomy Or Astrology</h3>
                                    </a>
                                    <p>03 Hours ago</p>
                                </div>
                            </div>
                            <div class="media post_item">
                                <img src="img/blog/popular-post/post4.jpg" alt="post">
                                <div class="media-body">
                                    <a href="single-blog.html">
                                        <h3>Asteroids telescope</h3>
                                    </a>
                                    <p>01 Hours ago</p>
                                </div>
                            </div>
                            <div class="br"></div>
                        </aside> --}}
                        <aside class="single_sidebar_widget ads_widget">
                            <a href="#">
                                <img class="img-fluid" src="img/blog/add.jpg" alt="">
                            </a>
                            <div class="br"></div>
                        </aside>
                        {{-- bloc pour la categorie de post --}}
                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Categories</h4>
                            <ul class="list cat-list">
                                @foreach ($allCategories as $categorie)
                                    
                                <li>
                                    <a href="{{ route('blog.index',['categorie'=>$categorie->nom] )}}" class="d-flex justify-content-between">
                                        <p>{{ $categorie->nom }}</p>
                                        <p>{{ $categorie->posts->count() }}</p>
                                    </a>
                                </li>
                                @endforeach
                                
                            </ul>
                            <div class="br"></div>
                        </aside>
                        {{-- bloc pour les tags --}}
                        <aside class="single-sidebar-widget tag_cloud_widget">
                            <h4 class="widget_title">Tags </h4>
                            <ul class="list">
                                @foreach ($allTags as $tag)
                                    <li>
                                        <a href="{{ route('blog.index',['tag'=>$tag->nom]) }}">{{ $tag->nom }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->

    
@endsection
