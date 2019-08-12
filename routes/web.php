<?php
use App\News;
use App\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//--start--新增入news資料庫區塊
Route::get('/insert', function () {
    DB::insert('insert into news(title,description) values(?, ?)', ['最新消息','這是一則消息']);
});

Route::get('/inserdata', function () {
    $post = new News;
    $post->title = 'goodjob';
    $post->description = '這是一則描述';
    $post->save();
});
Route::get('/create', function () {
    News::create(['title'=>'利用create新增的','description'=>'create的描述']);
});
//--end--

Route::get('/userCreate', function () {
    User::create([
        'name' => 'test',
        'email' => 'test',
        'username' => 'test',
        'password' => 'test',
    ]);
});
Route::get('/read', function () {
    $posts = News::all();
    
    foreach ($posts as $post) {
        return $post->description;
    };
});


Auth::routes();
//-------------範例新增------------//
Route::get('/', 'PostsController@index');
Route::get('/p/create', 'PostsController@create');   // profile->createPost
Route::post('/p', 'PostsController@store');
Route::get('/p/{post}', 'PostsController@show');   //  show出post  ！！(要再/p/create之前)！！

Route::get('/profile/{user}', 'ProfileController@index')->name('profile.show');
Route::get('/profile/{user}/edit', 'ProfileController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'ProfileController@update')->name('profile.update');   //更新資料使用patch

Route::post('follow/{user}', 'FollowsController@store');
