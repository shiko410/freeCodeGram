<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; #Userメソッドを使用するため

class ProfilesController extends Controller
{
    // public function index($user)
    // {
    //     // dd($user); #URLの値を取得できるか確認＆Viewに送らない
    //     // dd(User::find($user));　#DB情報を取得できるかチェック
        
    //     $i = User::findOrFail($user);
        
    //     return view('profiles.index', [
    //         'user' => $i,   #'xxx' viewに{{ $xxx }} として渡す
    //     ]);
    // }
    
        public function index(User $user)  # 上のUser::findOrFailがUser
    {
        // dd($user); #URLの値を取得できるか確認＆Viewに送らない
        // dd(User::find($user));　#DB情報を取得できるかチェック
        
        return view('profiles.index', compact('user'));
    }
    
    public function edit(User $user)
    {
        return view('profiles.edit', compact('user'));
    }
}
