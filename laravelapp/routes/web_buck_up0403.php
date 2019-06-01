<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

#age122 バリデーションを利用する
Route::get('hello','HelloController@index');
Route::post('hello','HelloController@post');


#page120 グローバルミドルウェア
// use App\Http\Middleware\HelloMiddleware;

// Route::get('hello','HelloController@index')
// 	->middleware('helo');


#page118 グローバルミドルウェア
// use App\Http\Middleware\HelloMiddleware;

// Route::get('hello','HelloController@index');


#page112
// use App\Http\Middleware\HelloMiddleware;

// Route::get('hello','HelloController@index')
// 	->middleware(HelloMiddleware::class);

#page97 ＠echoによるコレクションビュー
#変更なし

#page84 ディレクティブphp
#変更なし

#page83 ＄loopによる変数
#変更なし

#page81ディレクティブbrakeとディレクティブcontinue
#変更なし

#page80(繰り返しディレクティブを利用する)
//アクションpostを削除
//Route::get('hello','HelloController@index');

#page77(Bladeディレクティブissetで変数定義をチェックする)
#変更なし

#page69(フォームを利用する)
// Route::get('hello','HelloController@index');
// Route::post('hello','HelloController@post');

#page68(Bladeテンプレートを使う)→変更なし
#Laravelでは「〇〇blade.php」があれば優先的に読み込まれる

#page66(コントローラでテンプレートを使う)
// Route::get('hello','HelloController@index');

#page65(ルートパラメータをテンプレートに渡す)
// Route::get('hello/{id?}','HelloController@index');
#page62(コントローラでテンプレートを使う)
// Route::get('hello','HelloController@index');

#page60(ルートの設定でテンプレートを表示する)
/*
Route::get('hello', function(){
	return view('hello.index');
});
*/

#page51追記（リクエストとレスポンス）
//Route::get('hello', 'HelloController@index');

#page49追記（シングルアクションコントローラ）
//Route::get('hello', 'HelloController');



#page47追記（複数アクションの利用）
/*
Route::get('hello', 'HelloController@index');
Route::get('hello/other', 'HelloController@other');
*/

#page45追記(ルートパラメータ)
//Route::get('hello/{id?}/{pass?}', 'HelloController@index');

#page43追記（アクションを追加する / ルート情報の用意）
//Route::get('hello', 'HelloController@index');

#page36追記（パラメータを利用する）
/*
Route::get('hello/{msg?}', function($message='no message.') {

$html = <<<EOF
<html>
<head>
<title>Hello</title>
<style>
body {font-size: 16pt; color:#999;}
h1 {font-size:100pt; text-align:right; color:#eee; margin:-40px 0 -50px 0; }
</style>
</head>
<body>
	<h1>Hello</h1>
	<p>{$message}</p>
	<p>これは、サンプルで作ったメッセージです。</p>
</body>
</html>
EOF;
return $html;
});
*/

#page32（ルート情報を追加する）
//Route::get('hello',function () {
//    return '<html><body><h1>Hello</h1><p>this is sample page.
//          </p></body></html>
//});
