@extends('layouts.app')

@section('content')
    <div class="jumbotron jumbotron-fluid bg-primary">
        <div class="container">
            <h1 class="display-4">{{ $channel->name }}</h1>
            <p class="lead"> {{ $channel->description }}</p>
        </div>
    </div>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center ">
                <img src="{{ asset('/images/' . $channel->image) }}" class="rounded-circle mr-3" height="130px;">
                <div>
                    <h3>{{ $channel->name }}</h3>
                    <p>{{ $channel->subscribers() }} Subscriber</p>
                </div>
            </div>
            <div>
                @can('update', $channel)
                    <a href="{{ route('channel.edit', $channel) }}" class="btn btn-primary">Edit Channel</a>
                @endcan
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row my-4">
            @foreach ($channel->videos as $video)
                <div class="col-12 col-md-6 col-lg-4">
                    <a href="{{ route('video.watch', $video) }}" class="card-link">
                        <img src="{{ asset($video->thumbnail) }}" alt="" class="card-img-top"
                            style="height: 174px; width: 333px; border: none">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('/images/' . $video->channel->image) }}" height="40px"
                                    class="rounded-circle" alt="">
                                <h4 class="ml-3">{{ $video->title }}</h4>
                            </div>
                            <p class="gray-text mt-4 font-weight-bold" style="line-height: 0.2px">
                                {{ $video->channel->name }}
                            </p>
                            <p class="gray-text mt-4 font-weight-bold" style="line-height: 0.2px">
                                {{ $video->views }} views . {{ $video->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
