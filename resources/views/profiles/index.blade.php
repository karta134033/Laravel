@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-3 p-5">
            <img src="{{ $user->profile->profileImage() }}" class="rounded-circle" style="max-width: 200px; max-height: 200px">
        </div>
        <div class="col-xs-9 pt-5 pl-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex pb-4">
                    <h1 class="pr-5">{{ $user->username }}</h1>
                    <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button> <!--  將使用者的id傳入 -->
                </div>
                @can('update', $user->profile)
                    <a href="/p/create" class="pl-5">Add New Post</a>
                    <a href="/profile/{{ $user->id }}/edit" class="pl-5">Edit Profile</a>
                @endcan
            </div>
            <div class="d-flex"> 
                <div>
                    <strong>{{ $postCount }}</strong>&nbsp;posts
                </div>
                <div class="pl-5">
                    <strong>{{ $followerCount }}</strong>&nbsp;follower
                </div>
                <div class="pl-5">
                    <strong>{{ $followingCount }}</strong>&nbsp;following
                </div>
            </div>
            <div class="pt-4">一些測試的字----</div>
            <div class="pt4 font-weight-bold">{{ $user->profile->title ?? 'N/A'}}</div> 
            <div>{{ $user->profile->description ?? 'N/A'}}</div>
            <div><a href="https://{{ $user->profile->url ?? 'N/A'}}" target="_blank">{{ $user->profile->url ?? 'N/A'}}</a></div>
        </div>
    </div>
    <div class="row pt-5">
        @foreach($user->posts as $post)
            <div class="col-4 pb-4" style="max-width: 400px; max-height: 400px">
                <a href="/p/{{ $post->id }}">
                    <img src="/storage/{{ $post->image }}" style="max-width:100%; max-height: 100%" class="w-auto pl-5">
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
