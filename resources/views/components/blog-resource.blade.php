{{-- code pour la resource d'un post --}}

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="text-center">Element Rataché au Post</h4>
            </div>
            <div class="card-body">
                @if ($resource)
                    @if ($resource->type == 'audio')
                        <video poster="{{ asset('poster-audio3.jpg') }}" controls style="width: 100%;max-width: 100%"
                            src="{{ asset('storage/' . $resource->contenu) }}"></video>
                    @elseif ($resource->type == 'video')
                        {{-- <video controls class="w-auto" style="object-fit: cover;max-width: 100%;"
                            src="{{ asset('storage/' . $resource->contenu) }}"></video> --}}
                            <div class="artplayer-app" style="width: 40vw;height: 40vh;"></div>
                        @push('scripts')
                            <script src="https://cdn.jsdelivr.net/npm/artplayer/dist/artplayer.js"></script>
                            <script>
                                // alert('')
                                var art = new Artplayer({
                                    container: '.artplayer-app',
                                    url: '{{ "/storage/" . $resource->contenu }}',
                                    title: 'Video rattache au post',
                                    // poster: '{{ asset("poster-audio3.jpg")  }}',
                                    volume: 0.5,
                                    isLive: false,
                                    muted: false,
                                    autoplay: false,
                                    pip: true,
                                    // autoMini: true,
                                    screenshot: true,
                                    setting: true,
                                    loop: true,
                                    flip: true,
                                    playbackRate: true,
                                    aspectRatio: true,
                                    fullscreen: true,
                                    fullscreenWeb: true,
                                    subtitleOffset: true,
                                    miniProgressBar: true,
                                    mutex: true,
                                    backdrop: true,
                                    playsInline: true,
                                    airplay: true,
                                    theme: '#23ade5',
                                    icons:{
                                        state:`<img src="{{ asset('logo-ico.jpg') }}" width="400"/>`
                                    }
                                });
                            </script>
                        @endpush
                    @elseif ($resource->type == 'image')
                        <img class="img-fluid" src="{{ asset('storage/' . $resource->contenu) }}" alt="image">
                    @endif
                @endif
            </div>
            <div class="card-footer">
                Type: {{ $resource->type ?? 'non defini' }}
            </div>
        </div>
    </div>
</div>
