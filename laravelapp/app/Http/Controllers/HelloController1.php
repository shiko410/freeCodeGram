<?php
namespace App\Http\Controllers; #名前空間に設定できるのは、関数、クラス

use Illuminate\Http\Request; #useは名前空間のエイリアス
#page150 オリジナル・バリデータの作成
use App\Http\Requests\HelloRequest1;

use Validator;

class HelloController1 extends Controller
{
    public function index(Request $request){
        return view('hello.index1', ['msg'=>'フォームを入力してください。']); #index1.blade.phpへ
    }
    
    public function post(HelloRequest1 $request){
        return view('hello.index1', ['msg'=>'正しく入力されました！']);
    }
}
