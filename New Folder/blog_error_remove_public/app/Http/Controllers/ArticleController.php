<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{
	#CRUDのread
	public function index()
	{
		$articles = Article::all(); #articlesテーブルからデータを抽出
		return view('article.index', ['articles' => $articles]);	#変数articlesをビューへ渡す
		#view('フォルダ名.ファイル名', ['渡す値' => $読み込ませる変数]);
	}
	
	#CRUDのcreate
	public function create()	#新規追加フォームの表示
	{
		return view('article.create');
	}
	
	public function store(Request $request)		#DBへの書き込み
	{											#storeメソッドはフォームから送られたデータを変数$requestで受け取り、データベースに書き込む
		$article = new Article;					#データベースの操作はEloquent ORMを使用
		$article->title = $request->title;
		$article->body = $request->body;
		$article->save();
		
		return view('article.store');
	}
}
