<?php

namespace App\Http\Controllers;

use \App\Post;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Intervention\Image\Facades\Image;
class PostsController extends Controller
{

    public function __construct()
    {   
        $this->middleware('auth');  //確保所有進入這個頁面的狀態都是auth
                                    //若未登入則跳入登入頁面
    }

    public function create()
    {
        return view('posts.create');    //導入views/posts/create.blade.php   
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id'); //因為有多個欄位有user_id，所以
                                                                        //要告知他我們是使用profiles欄位的user_id
        $posts = Post::whereIn('user_id', $users)->orderBy('created_at', 'DESC')->with('user')->get();
        return view('posts.index',compact('posts'));   //with('user')可以使query不會產生limited1而可以直接query
    }

    public function store()
    {
        $data = request()->validate([   //validate這個方法是從Illuminate\Http\Request;而來
            'caption' => 'required',
            'image' => ['required', 'image'],
        ]);

        $imagePath = request('image')->store('uploades', 'public'); //取得本地端圖片路徑 並寫入

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200); //改變圖片大小 強制轉1200,1200大小
        $image->save();

        auth()->user()->posts()->create([   //利用create這個方法去寫入資料庫
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);                           //有user的關連

        //\App\Post::create($data);  //沒有user的關連

        return redirect('/profile/' . auth()->user()->id);
    }

    public function show(\App\Post $post)   //因為此$post跟web.php裡的參數名稱一模一樣，所以前面加上\App\Post的話，
                                            //laravel會自動去找尋相符的選項，而不用再去加上findOrFail
    {
        return view('posts.show', compact('post'));  //因為命名相同於上，compact可直接傳遞
    }
}
