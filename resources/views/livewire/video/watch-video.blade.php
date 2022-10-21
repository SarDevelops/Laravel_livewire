<div>
    @push('custom-css')
        <link href="https://vjs.zencdn.net/7.20.3/video-js.css" rel="stylesheet" />
    @endpush


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 p-0">
                <div class="video-container" wire:ignore>
                    <video id="video_watch" controls preload="auto"
                        poster="{{ asset('videos/' . $video->uid . '/' . $video->thumbnail_image) }}"
                        class="video-js vjs-fill vjs-style=defaults vjs-big-play-centered" data-setup="{}"
                        src="">
                        <source src="{{ asset('videos/' . $video->uid . '/' . $video->processed_file) }}"
                            type="application/x-mpegURL" />
                        <p class="vjs-no-js">
                            To view this video please enable JavaScript, and consider upgrading to a
                            web browser that
                            <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                        </p>
                    </video>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">
                                <h3 class="mt-4">
                                    {{ $video->title }}
                                </h3>
                                <p class="gray-text">{{ $video->views }} view . {{ $video->updated_data }} </p>

                            </div>
                            <div>
                                <livewire:video.voting :video="$video" />

                                {{-- <button>Like</button>
                                <button>Dislike</button> --}}

                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <livewire:channel.channel-info :channel="$video->channel" />
                    </div>
                </div>
                <hr>
                <h1> {{ $video->AllCommentsCount() }}Comments</h1>
                @auth
                    <div class="my-2">

                        <livewire:comment.new-comment :video="$video" :col=0 :key="$video->id" />
                    </div>
                @endauth

                <livewire:comment.all-comments :video="$video" />
            </div>
            <div class="col-md-4">
                <livewire:lists.list-of-videos :video="$video" />
            </div>
        </div>
    </div>


    @push('scripts')
        <script src="https://vjs.zencdn.net/7.20.3/video.min.js"></script>
        <script src="{{ asset('js/custom.js') }}"></script>
    @endpush
</div>
