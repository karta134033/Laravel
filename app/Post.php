<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];  //關閉預設的csrf防禦
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
