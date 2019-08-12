@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($posts as $post)
        <div class="row">
            <div class="col-8 offset-2">
                <a href="/profile/{{ $post->user->id }}">
                    <img src="/storage/{{ $post->image }}" class="rounded-circle" style="max-width: 500px; max-height: 500px">
                </a>
            </div>
            <div class="column col-4 offset-2 pt-2 pb-2">
                <div class="row pt-4"> 
                    <h4><a href="/profile/{{ $post->user->id }}"><span class="text-dark">{{ $post->user->username }}</span></a></h4>
                </div>
                <div class="pt-4">
                    <strong><a href="/profile/{{ $post->user->id }}"><span class="text-dark">{{ $post->user->username }}</span></a></strong>
                    {{ $post->caption }}
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
