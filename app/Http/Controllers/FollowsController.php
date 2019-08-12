<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FollowsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');  //確保所有進入這個頁面的狀態都是auth
                                    //若未登入則跳入登入頁面
    }

    public function store(\App\User $user)
    {
        return auth()->user()->following()->toggle($user->profile); //注意profile與profile()的不同
    }


}
