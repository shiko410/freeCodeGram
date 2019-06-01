<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller // Postsのviewは「Posts」フォルダに保存
{
    public function __construct(){ 
        $this->middleware('auth'); // ログインユーザー以外はログインページへ(Controllerを管理)
    }
    
    public function create() // ファンクション名(create)はcreate.blade.phpに表示させる
    {
        return view('posts.create'); // viewの場所はclass名.メソッド名とする。
    }
    
    public function store()
    {
        // dd(request()->all()); // postされた値が通るかのテスト
        
        #バリデーションの設定
        $data = request()->validate([
            // 'another' =>'', // バリデーションが不要なときつけておけばいい？ 2:01:00ｓ
            'caption' => 'required',
            'image' => ['required','image']      // 'required | image', もOK
        ]);
        
        $imagePath = request('image')->store('uploads', 'public');
        
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath
        ]);
        
        return redirect('/profile/' . auth()->user()->id);  // URL/profile/ユーザーid へ移動
        
        // dd(request('image')->store('uploads', 'public')); // 'image'はインスタンス
        
        #DB保存の際のuserとの紐付け
        auth()->user()->posts()->create($data);
        dd($data);
        
        #DBへの保存（エラー）
        /**
        \App\Post::create($data);
        #バリデーションをしていないなら以下のように定義
        \App\Post::create([
            'caption' => $data['caption']
        ]);
        */
        
        /* tinkerと同じ方法でもOK
        $post = new \App\Post();
        $post->caption = $data['caption'];
        $post->save();
        */
    }
}
