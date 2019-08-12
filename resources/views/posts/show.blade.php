@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <img src="/storage/{{ $post->image }}" class="w-100" style="max-width: 700px; max-height: 700px">
        </div>
        <div class="column col-4">
            <div class="pt-2">
                <img src="/storage/{{ $post->user->profile->profileImage() }}" class="rounded-circle" style="max-width: 50px; max-height: 50px">
            </div>
            <div class="row pt-4"> 
                <h4><a href="/profile/{{ $post->user->id }}"><span class="text-dark">{{ $post->user->username }}</span></a></h4>
                <strong class="pl-3 pt-1"><a href="/profile/{{ $post->user->id }}">Follow</a></strong>
            </div>
            <div class="pt-4">
                <strong><a href="/profile/{{ $post->user->id }}"><span class="text-dark">{{ $post->user->username }}</span></a></strong>
                {{ $post->caption }}
            </div>
        </div>
    </div>
</div>
@endsection
