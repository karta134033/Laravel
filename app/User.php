<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';     //對應到users的資料表
    protected $fillable = [
        'name', 'email','username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected static function boot()    //  當使用者創建帳號時，新增一個profile
    {
        parent::boot();
        static::created(function($user){ //文件 https://laravel.com/docs/5.8/eloquent#events
            $user->profile()->create([
                'title' => $user->username,
            ]);
        });
    }

    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC'); //讓順序依照時間由最近發出的貼文排在前面
    }
    public function profile()
    {
        return $this->hasOne(Profile::class);    
    }

    public function following()
    {
        return $this->belongsToMany(Profile::class);
    }
}
