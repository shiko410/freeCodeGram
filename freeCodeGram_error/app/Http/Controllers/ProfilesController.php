<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfilesController extends Controller
{
    public function index($user) // $userはweb.phpの{user}で定義した変数
    {
        // $user = User::find($user);
        // dd(User::find($user)); ← インスタンスとして扱われる
        // $data = User::find($user); // Userモデルを通ってDBからデータを取得
        
        # DBから取り出されたデータはインスタンスとして扱われる
        // dd($data);
        // dd($data->name); // Name
        // dd($data->username); // UserName
        // dd($data->id); // 1
        // dd($data->password); // $2y$10$faZUWbtZsE/zNfm7P6T1buOq3hC.8QOV1bxja/ppOvrxwbIQY1YXC
        
         $data = User::findOrFail($user);
        
        return view('profile.index', [      // viewの場所はclass名.メソッド名とする。
            'info' => $data, //infoが$infoとしてviewのhome.blade.phpに渡される
            // 'user' => $user,
        ]);
    }
}
