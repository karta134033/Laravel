<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    public function profileImage()
    {
        return '/storage/' . (($this->image) ? $this->image : 'profile/i93CYK6xpSTuQf6KKNAokxnaTcjj7LIieUrt8LxH.png');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class);   //profile的followers屬於許多的user
    }
}
