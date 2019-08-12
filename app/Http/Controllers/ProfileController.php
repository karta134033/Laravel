<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;
use App\User;

class ProfileController extends Controller
{
    public function index($user) //方法一
    {
        $follows = (auth()->user() ? auth()->user()->following->contains($user) : false);
        $user = User::findOrFail($user);

        $postCount = Cache::remember(
            'count.posts.' . $user->id,
            now()->addSecond(30),       //'count.posts.'為cache的key ， now()->addSecond(30)為時間
            function () use ($user) {
                return $user->posts->count();   // 如果超過30秒則使用這個方法
            }
        );

        $followerCount = Cache::remember(
            'count.followers.' . $user->id,
            now()->addSecond(30),
            function () use ($user) {
                return $user->profile->followers->count();
            }
        );
        
        $followingCount = Cache::remember(
            'count.following.' . $user->id,
            now()->addSecond(30),
            function () use ($user) {
                return $user->following->count();
            }
        );

        return view('profiles.index', [
            'user' => $user,
            'follows' => $follows,
            'postCount' => $postCount,
            'followerCount' => $followerCount,
            'followingCount' => $followingCount,

        ]);  //home.blade.php
    }

    public function edit(User $user) //方法二
    {
        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '',
        ]);
        $imagePath = '';
        if (request('image')) {
            $imagePath = request('image')->store('profile', 'public'); //取得本地端圖片路徑
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000); //改變圖片大小 強制轉1200,1200大小
            $image->save();
        }
        auth()->user()->profile()->update(array_merge(
            $data,
            ['image' => $imagePath]  //複寫掉前$data所帶的image
        ));

        return redirect("/profile/{$user->id}");
    }
}
