<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{
	#CRUDのread*****************************************************************
	public function index()
	{
		$articles = Article::all(); 	
		
		return view('article.index', ['articles' => $articles]);	
	}
	#articlesテーブルからデータを抽出
	# Article::は、静的メソッドなので、インスタンスを生成しなくてもOK
	# ArticleのextendsのModelのall静的メソッドを呼び出す。
	
	#変数articlesをビューへ渡す
	#view('フォルダ名.ファイル名', ['渡す値' => $読み込ませる変数]);



	#CRUDのcreate***************************************************************
	public function create()	#新規追加フォームの表示
	{
		return view('article.create');
	}

	public function store(Request $request)		#DBへの書き込み（注１）
	{											
		$article = new Article;				// Articleのインスタンス作成
		$article->title = $request->title;	// Articleインスタンスの変数titleにPOSTされた'title'を代入 [値を用意して保存するだけ]
		$article->body = $request->body;	// Articleインスタンスの変数bodyにPOSTされた'body'を代入 [値を用意して保存するだけ]
		$article->save();					// saveメソッドで保存
		
		return view('article.store');
	}
	#storeメソッドはフォームから送られたデータを変数$requestで受け取り、データベースに書き込む
	#データベースの操作はEloquent ORMを使用
	/**	（注１） Requestについて
	PHPなら$_REQUEST['キー']でget/postされた値を取得
	Request: method="get/post" (サーバーへ送られる情報)
	Response: $_REQUEST['キー'] (サーバーから受け取る情報)
	
		public function 〇〇〇〇(Request $request)
		public function 〇〇〇〇(Response $response)
		とするだけで、インスタンスが用意され、使用できる(use文を記載しておく必要あり！)
		★requestはフォームだけでなく、URLパラメータ、DB等の情報も取得できる。
	*/
	
	
	#CRUDのupdate***************************************************************
	public function edit(Request $request, $id)		#修正データを受け取り
	{
		$article = Article::find($id);			//URLパラメータからidを取得し、DBの情報を連想配列で取得
        return view('article.edit', ['article' => $article]);
	}
	#$articleに修正すべきデータのIDを取得
	#viewで取得したIDをを渡す
	
	public function update(Request $request) {		#DB更新処理
        $article = Article::find($request->id);	// Articleインスタンスのfindメソッドでidから値を取得（idはURLパラメータ）
        $article->title = $request->title;		// [値を用意して保存] 
        $article->body = $request->body;		// [値を用意して保存]
        $article->save();						// saveメソッドで保存
 
        return view('article.update');
    }
    
    
    #CRUDのdelete***************************************************************
     public function show(Request $request, $id) {		#上のeditメソッドとほぼ同じ
        $article = Article::find($id);							// URLパラメータからidを取得し、DBの情報を連想配列で取得
        return view('article.show', ['article' => $article]);	// 連想配列のデータをviewにわたす
    }
 
    public function delete(Request $request) {
        Article::destroy($request->id);		//URLパラメータからidを取得し、destroyメソッドでデータを削除
        return view('article.delete');
    }
}
