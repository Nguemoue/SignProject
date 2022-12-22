@extends('template')

@section('main')
    <!-- ================ start banner area ================= -->
    <section class="blog-banner-area" id="blog">
        <div class="container h-100">
            <div class="blog-banner">
                <div class="text-center">
                    <h1>Blog Details</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Blog Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ end banner area ================= -->



    <!--================Blog Area =================-->
    <section class="blog_area single-post-area py-80px section-margin--small">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="single-post row">
                        <div class="col-lg-12">
                            <div class="feature-img">
                                <img class="img-fluid" src="{{ asset('storage/' . $blog->image) }}"
                                    alt="image {{ $blog->titre }}">
                            </div>
                        </div>
                        <div class="col-lg-3  col-md-3">
                            <div class="blog_info text-right">
                                <div class="post_tag">
                                    @foreach ($blog->tags as $tag)
                                        <span>{{ $tag->nom }} {{ $loop->last ? '' : ',' }} </span>
                                    @endforeach

                                </div>
                                <ul class="blog_meta list">

                                    <li>
                                        <a href="#">{{ $blog->created_at->isoformat('ll') }}
                                            <i class="lnr lnr-calendar-full"></i>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <strong id="commentCount">{{ $blog->comments->count() }}</strong> Comments
                                            <i class="lnr lnr-bubble"></i>
                                        </a>
                                    </li>
                                </ul>

                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 blog_details">
                            <h2>{{ $blog->titre }}</h2>
                            <p class="excert">
                                {{ $blog->sousTitre }}
                            </p>
                            <p>
                                {{ $blog->contenu }}
                            </p>
                        </div>

                        <hr />


                    </div>
                    <hr>
                    {{-- blo pour la ressource --}}
                    <div class="col-lg-12 mt-2">
                        {{-- <div class="quotes">
                                MCSE boot camps have its supporters and its detractors. Some people do not understand why
                                you should have to spend money
                                on boot camp when you can get the MCSE study materials yourself at a fraction of the camp
                                price. However, who has the willpower to actually sit through a self-imposed MCSE training.
                            </div> --}}
                        <x-blog-resource :resource="$blog->resource" />
                    </div>
                    <hr>
                    {{-- bloc des commentaires --}}
                    <div class="comments-area">
                        <div class="comments-area">
                            @php
                            $comments = $blog->comments;
                            @endphp
                            <h4><span id="nbComment2">{{ $comments->count() }}</span> Commentaires</h4>
                            <div class="comment-list" id="commentList" style="max-height: 40vh;overflow-y: scroll">
                                @foreach ($comments as $comment)
                                    <div class="single-comment border my-1 justify-content-between d-flex">
                                        <div class="user p-2 mt-2 justify-content-between d-flex">
                                            <div class="desc">
                                                <h5>
                                                    <a href="#">{{ $comment->user->name }}</a>
                                                </h5>
                                                <p class="date">{{ $comment->created_at->IsoFormat('lll') }} </p>
                                                <p class="comment">
                                                    {{ $comment->contenu }}
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @auth
                        @php
                            $user = auth()->user();
                        @endphp
                        <div class="comment-form">
                            <h4>laisser un commentaire</h4>
                            <form id="sendForm">
                                <div class="form-group form-inline">
                                    <div class="form-group col-lg-6 col-md-6 name">
                                        <input type="text" readonly value="{{ $user->name }}" class="form-control">
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 email">
                                        <input type="email" class="form-control" value="{{ $user->email }}" readonly />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group col-lg-12 col-md-12 name">
                                        <input type="text" class="form-control" value="{{ $blog->titre }}" readonly />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control mb-10" id="message" rows="5" name="message" placeholder="Message"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Message'" required=""></textarea>
                                </div>
                                <a href="#nbComment2" id="postComment" class="button button-postComment button--active">
                                    Commenter ce post</a>
                            </form>
                        </div>
                    @endauth

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
                                <img class="img-fluid" src="{{ asset('img/blog/add.jpg') }}" alt="">
                            </a>
                            <div class="br"></div>
                        </aside>
                        {{-- bloc pour la categorie de post --}}
                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Categories</h4>
                            <ul class="list cat-list">
                                @foreach ($allCategories as $categorie)
                                    <li>
                                        <a href="{{ route('blog.index', ['categorie' => $categorie->nom]) }}"
                                            class="d-flex justify-content-between">
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
                                        <a href="{{ route('blog.index', ['tag' => $tag->nom]) }}">{{ $tag->nom }}</a>
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

@push('scripts')
    <script>
        const postCommentButton = document.getElementById("postComment")
        const messageField = document.getElementById("message")
        const postId = {{ $blog->id }}
        const userId = {{ $user->id }}
        const commentCountSpan = document.getElementById("commentCount")
        postCommentButton.addEventListener('click', function(event) {
            axios.post("/post/comment", {
                message: messageField.value,
                postId,
                userId
            }).then(({
                data
            }) => {
                // Live
                commentCountSpan.textContent = data.nbComment
                comment = JSON.parse(data.comment)[0]
                document.getElementById("nbComment2").textContent = data.nbComment
                // console.log(comment)
                var component = `
                    <div class="single-comment p-2 border my-1 justify-content-between d-flex">
                        <div class="user mt-2 justify-content-between d-flex">
                            <div class="desc">
                                <h5>
                                    <a href="#">${comment.user.name}</a>
                                </h5>
                                <p class="date">${comment.created_at}</p>
                                <p class="comment">
                                    ${comment.contenu}
                                </p>
                            </div>
                        </div>
                    </div>`;
                $('#commentList').append(component)
                $("message").val("")

            })
        });
    </script>
@endpush
