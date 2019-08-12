<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOnetoeon extends Model
{
    /**
     * 取得與指定使用者互相關聯的電話紀錄。
     */
    public function phone()
    {
        return $this->hasOne('App\Phone');
    }
}
