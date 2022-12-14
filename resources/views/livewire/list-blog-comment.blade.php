<div class="comments-area" >
    <h4><span id="nbComment2">{{ $nbComment }}</span> Commentaires</h4>
    <div class="comment-list" id="commentList" style="max-height: 40vh;overflow-y: scroll">
        @foreach ($comments as $comment)
            <div class="single-comment border my-1 justify-content-between d-flex">
                <div class="user mt-2 justify-content-between d-flex">
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
