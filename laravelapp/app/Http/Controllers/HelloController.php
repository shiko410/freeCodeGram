<?php
namespace App\Http\Controllers; #名前空間に設定できるのは、関数、クラス

use Illuminate\Http\Request; #useは名前空間のエイリアス

#page323 オリジナルログインページ

use App\Http\Requests\HelloRequest;
use Validator;
use App\Person;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class HelloController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $sort = $request->sort;
        $items = Person::orderBy($sort, 'asc')
            ->simplePaginate(5);
        $param = ['items' => $items, 'sort' => $sort, 'user' => $user];
        return view('hello.index', $param);
    }
    
    public function post(Request $request){
        $items = DB::select('select * from people');
        return view('hello.index', ['items' => $items]);
    }
    
    public function add(Request $request){
        return view('hello.add');
    }
    
    public function create(Request $request){
        $param = [
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        // DB::insert('insert into people (name, mail, age) values (:name, :mail, :age)', $param);
        // return redirect('/hello');
        DB::table('people')->insert($param);
        return redirect('/hello');
    }
    
    public function edit(Request $request){
        $item = DB::table('people')
            ->where('id', $request->id)
            ->first();
        // $param = ['id' => $request->id];
        // $item = DB::select('select * from people where id = :id', $param);
        return view('hello.edit', ['form' => $item]);
    }
    
    public function update(Request $request){
        $param = [
            // 'id' => $request->id,
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        // DB::update('update people set name =:name, mail = :mail, age = :age where id = :id', $param);
        DB::table('people')
            ->where('id',$request->id)
            ->update($param);
        return redirect('/hello');
    }
    
    public function del(Request $request){
        // $param = ['id' => $request->id];
        // $item = DB::select('select * from people where id = :id', $param);
        $item = DB::table('people')
            ->where('id', $request->id)->first();
        // return view('hello.del', ['form' => $item[0]]);
        return view('hello.del', ['form' => $item]);
    }
    
    public function remove(Request $request){
        // $param = ['id' => $request->id];
        // DB::delete('delete from people where id = :id', $param);
        DB::table('people')
        ->where('id', $request->id)->delete();
        return redirect('/hello');
    }
    
    public function show (Request $request){
        $page = $request->page;
        $items = DB::table('people')
            ->offset($page * 3)
            ->limit(3)
            ->get();
        return view('hello.show', ['items' => $items]);
    }
    
    public function rest(Request $request){
        return view('hello.rest');
    }
    
    public function ses_get(Request $request){
        $sesdata = $request->session()->get('msg');
        return view('hello.session', ['session_data' => $sesdata]);
    }
    
    public function ses_put(Request $request){
        $msg = $request->input;
        $request->session()->put('msg', $msg);
        return redirect('hello/session');
    }
    
    #page324
    public function getAuth(Request $request)
    {
        $param = ['message' => 'ログインしてください。'];
        return view('hello.auth', $param);
    }
    
    public function postAuth(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $msg = 'ログインしました。(' . Auth::user()->name . ')';
        } else {
            $msg = 'ログインに失敗しました。';
        }
        return view('hello.auth', ['message' => $msg]);
    }
}

#page318 ログインをチェックする
/*
use App\Http\Requests\HelloRequest;
use Validator;
use App\Person;
#page303
use Illuminate\Support\Facades\Auth; //追記

use Illuminate\Support\Facades\DB;

class HelloController extends Controller
{
    public function index(Request $request) // 修正
    {
        $user = Auth::user();
        $sort = $request->sort;
        $items = Person::orderBy($sort, 'asc')
            ->simplePaginate(5);
        $param = ['items' => $items, 'sort' => $sort, 'user' => $user];
        return view('hello.index', $param);
    }
    
    public function post(Request $request){
        $items = DB::select('select * from people');
        return view('hello.index', ['items' => $items]);
    }
    
    public function add(Request $request){
        return view('hello.add');
    }
    
    public function create(Request $request){
        $param = [
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        // DB::insert('insert into people (name, mail, age) values (:name, :mail, :age)', $param);
        // return redirect('/hello');
        DB::table('people')->insert($param);
        return redirect('/hello');
    }
    
    public function edit(Request $request){
        $item = DB::table('people')
            ->where('id', $request->id)
            ->first();
        // $param = ['id' => $request->id];
        // $item = DB::select('select * from people where id = :id', $param);
        return view('hello.edit', ['form' => $item]);
    }
    
    public function update(Request $request){
        $param = [
            // 'id' => $request->id,
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        // DB::update('update people set name =:name, mail = :mail, age = :age where id = :id', $param);
        DB::table('people')
            ->where('id',$request->id)
            ->update($param);
        return redirect('/hello');
    }
    
    public function del(Request $request){
        // $param = ['id' => $request->id];
        // $item = DB::select('select * from people where id = :id', $param);
        $item = DB::table('people')
            ->where('id', $request->id)->first();
        // return view('hello.del', ['form' => $item[0]]);
        return view('hello.del', ['form' => $item]);
    }
    
    public function remove(Request $request){
        // $param = ['id' => $request->id];
        // DB::delete('delete from people where id = :id', $param);
        DB::table('people')
        ->where('id', $request->id)->delete();
        return redirect('/hello');
    }
    
    public function show (Request $request){
        $page = $request->page;
        $items = DB::table('people')
            ->offset($page * 3)
            ->limit(3)
            ->get();
        return view('hello.show', ['items' => $items]);
    }
    
    public function rest(Request $request){
        return view('hello.rest');
    }
    
    #page298
    public function ses_get(Request $request){
        $sesdata = $request->session()->get('msg');
        return view('hello.session', ['session_data' => $sesdata]);
    }
    
    public function ses_put(Request $request){
        $msg = $request->input;
        $request->session()->put('msg', $msg);
        return redirect('hello/session');
    }
}
*/

#page311 ページネーション 項目毎の並び替え ページ番号表示
/*
use App\Http\Requests\HelloRequest;
use Validator;
#page303
use App\Person; //追記

use Illuminate\Support\Facades\DB;

class HelloController extends Controller
{
    public function index(Request $request) // 修正
    {
        $sort = $request->sort;
        $items = Person::orderBy($sort, 'asc')
            ->paginate(5);
        $param = ['items' => $items, 'sort' => $sort];
        return view('hello.index', $param);
    }
    
    public function post(Request $request){
        $items = DB::select('select * from people');
        return view('hello.index', ['items' => $items]);
    }
    
    public function add(Request $request){
        return view('hello.add');
    }
    
    public function create(Request $request){
        $param = [
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        // DB::insert('insert into people (name, mail, age) values (:name, :mail, :age)', $param);
        // return redirect('/hello');
        DB::table('people')->insert($param);
        return redirect('/hello');
    }
    
    public function edit(Request $request){
        $item = DB::table('people')
            ->where('id', $request->id)
            ->first();
        // $param = ['id' => $request->id];
        // $item = DB::select('select * from people where id = :id', $param);
        return view('hello.edit', ['form' => $item]);
    }
    
    public function update(Request $request){
        $param = [
            // 'id' => $request->id,
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        // DB::update('update people set name =:name, mail = :mail, age = :age where id = :id', $param);
        DB::table('people')
            ->where('id',$request->id)
            ->update($param);
        return redirect('/hello');
    }
    
    public function del(Request $request){
        // $param = ['id' => $request->id];
        // $item = DB::select('select * from people where id = :id', $param);
        $item = DB::table('people')
            ->where('id', $request->id)->first();
        // return view('hello.del', ['form' => $item[0]]);
        return view('hello.del', ['form' => $item]);
    }
    
    public function remove(Request $request){
        // $param = ['id' => $request->id];
        // DB::delete('delete from people where id = :id', $param);
        DB::table('people')
        ->where('id', $request->id)->delete();
        return redirect('/hello');
    }
    
    public function show (Request $request){
        $page = $request->page;
        $items = DB::table('people')
            ->offset($page * 3)
            ->limit(3)
            ->get();
        return view('hello.show', ['items' => $items]);
    }
    
    public function rest(Request $request){
        return view('hello.rest');
    }
    
    #page298
    public function ses_get(Request $request){
        $sesdata = $request->session()->get('msg');
        return view('hello.session', ['session_data' => $sesdata]);
    }
    
    public function ses_put(Request $request){
        $msg = $request->input;
        $request->session()->put('msg', $msg);
        return redirect('hello/session');
    }
}
*/

#page308 ページネーション 項目毎の並び替え
/*
use App\Http\Requests\HelloRequest;
use Validator;
#page303
use App\Person; //追記

use Illuminate\Support\Facades\DB;

class HelloController extends Controller
{
    public function index(Request $request) // 修正
    {
        $sort = $request->sort;
        //$items = DB::table('people')->simplePaginate(5) //コメント部分はDBクラス利用
        //      ->orderBy($sort, 'asc';
        $items = Person::orderBy($sort, 'asc')
            ->simplePaginate(5);
        $param = ['items' => $items, 'sort' => $sort];
        return view('hello.index', $param);
    }
    
    public function post(Request $request){
        $items = DB::select('select * from people');
        return view('hello.index', ['items' => $items]);
    }
    
    public function add(Request $request){
        return view('hello.add');
    }
    
    public function create(Request $request){
        $param = [
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        // DB::insert('insert into people (name, mail, age) values (:name, :mail, :age)', $param);
        // return redirect('/hello');
        DB::table('people')->insert($param);
        return redirect('/hello');
    }
    
    public function edit(Request $request){
        $item = DB::table('people')
            ->where('id', $request->id)
            ->first();
        // $param = ['id' => $request->id];
        // $item = DB::select('select * from people where id = :id', $param);
        return view('hello.edit', ['form' => $item]);
    }
    
    public function update(Request $request){
        $param = [
            // 'id' => $request->id,
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        // DB::update('update people set name =:name, mail = :mail, age = :age where id = :id', $param);
        DB::table('people')
            ->where('id',$request->id)
            ->update($param);
        return redirect('/hello');
    }
    
    public function del(Request $request){
        // $param = ['id' => $request->id];
        // $item = DB::select('select * from people where id = :id', $param);
        $item = DB::table('people')
            ->where('id', $request->id)->first();
        // return view('hello.del', ['form' => $item[0]]);
        return view('hello.del', ['form' => $item]);
    }
    
    public function remove(Request $request){
        // $param = ['id' => $request->id];
        // DB::delete('delete from people where id = :id', $param);
        DB::table('people')
        ->where('id', $request->id)->delete();
        return redirect('/hello');
    }
    
    public function show (Request $request){
        $page = $request->page;
        $items = DB::table('people')
            ->offset($page * 3)
            ->limit(3)
            ->get();
        return view('hello.show', ['items' => $items]);
    }
    
    public function rest(Request $request){
        return view('hello.rest');
    }
    
    #page298
    public function ses_get(Request $request){
        $sesdata = $request->session()->get('msg');
        return view('hello.session', ['session_data' => $sesdata]);
    }
    
    public function ses_put(Request $request){
        $msg = $request->input;
        $request->session()->put('msg', $msg);
        return redirect('hello/session');
    }
}
*/

#page303 ページネーション
/*
use App\Http\Requests\HelloRequest;
use Validator;
#page303
use App\Person; //追記

use Illuminate\Support\Facades\DB;

class HelloController extends Controller
{
    public function index(Request $request) // 修正
    {
        $sort = $request->sort;
        $items = DB::table('people')->simplePaginate(5);
        return view('hello.index', ['items' => $items]);
    }
    
    public function post(Request $request){
        $items = DB::select('select * from people');
        return view('hello.index', ['items' => $items]);
    }
    
    public function add(Request $request){
        return view('hello.add');
    }
    
    public function create(Request $request){
        $param = [
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        // DB::insert('insert into people (name, mail, age) values (:name, :mail, :age)', $param);
        // return redirect('/hello');
        DB::table('people')->insert($param);
        return redirect('/hello');
    }
    
    public function edit(Request $request){
        $item = DB::table('people')
            ->where('id', $request->id)
            ->first();
        // $param = ['id' => $request->id];
        // $item = DB::select('select * from people where id = :id', $param);
        return view('hello.edit', ['form' => $item]);
    }
    
    public function update(Request $request){
        $param = [
            // 'id' => $request->id,
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        // DB::update('update people set name =:name, mail = :mail, age = :age where id = :id', $param);
        DB::table('people')
            ->where('id',$request->id)
            ->update($param);
        return redirect('/hello');
    }
    
    public function del(Request $request){
        // $param = ['id' => $request->id];
        // $item = DB::select('select * from people where id = :id', $param);
        $item = DB::table('people')
            ->where('id', $request->id)->first();
        // return view('hello.del', ['form' => $item[0]]);
        return view('hello.del', ['form' => $item]);
    }
    
    public function remove(Request $request){
        // $param = ['id' => $request->id];
        // DB::delete('delete from people where id = :id', $param);
        DB::table('people')
        ->where('id', $request->id)->delete();
        return redirect('/hello');
    }
    
    public function show (Request $request){
        $page = $request->page;
        $items = DB::table('people')
            ->offset($page * 3)
            ->limit(3)
            ->get();
        return view('hello.show', ['items' => $items]);
    }
    
    public function rest(Request $request){
        return view('hello.rest');
    }
    
    #page298
    public function ses_get(Request $request){
        $sesdata = $request->session()->get('msg');
        return view('hello.session', ['session_data' => $sesdata]);
    }
    
    public function ses_put(Request $request){
        $msg = $request->input;
        $request->session()->put('msg', $msg);
        return redirect('hello/session');
    }
}
*/

#page298 セッションを利用する
/*
use App\Http\Requests\HelloRequest;
use Validator;

use Illuminate\Support\Facades\DB;

class HelloController extends Controller
{
    public function index(Request $request){
        $items = DB::table('people')->orderBy('age', 'asc')->get();
        return view('hello.index', ['items' => $items]);
    }
    
    public function post(Request $request){
        $items = DB::select('select * from people');
        return view('hello.index', ['items' => $items]);
    }
    
    public function add(Request $request){
        return view('hello.add');
    }
    
    public function create(Request $request){
        $param = [
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        // DB::insert('insert into people (name, mail, age) values (:name, :mail, :age)', $param);
        // return redirect('/hello');
        DB::table('people')->insert($param);
        return redirect('/hello');
    }
    
    public function edit(Request $request){
        $item = DB::table('people')
            ->where('id', $request->id)
            ->first();
        // $param = ['id' => $request->id];
        // $item = DB::select('select * from people where id = :id', $param);
        return view('hello.edit', ['form' => $item]);
    }
    
    public function update(Request $request){
        $param = [
            // 'id' => $request->id,
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        // DB::update('update people set name =:name, mail = :mail, age = :age where id = :id', $param);
        DB::table('people')
            ->where('id',$request->id)
            ->update($param);
        return redirect('/hello');
    }
    
    public function del(Request $request){
        // $param = ['id' => $request->id];
        // $item = DB::select('select * from people where id = :id', $param);
        $item = DB::table('people')
            ->where('id', $request->id)->first();
        // return view('hello.del', ['form' => $item[0]]);
        return view('hello.del', ['form' => $item]);
    }
    
    public function remove(Request $request){
        // $param = ['id' => $request->id];
        // DB::delete('delete from people where id = :id', $param);
        DB::table('people')
        ->where('id', $request->id)->delete();
        return redirect('/hello');
    }
    
    public function show (Request $request){
        $page = $request->page;
        $items = DB::table('people')
            ->offset($page * 3)
            ->limit(3)
            ->get();
        return view('hello.show', ['items' => $items]);
    }
    
    public function rest(Request $request){
        return view('hello.rest');
    }
    
    #page298
    public function ses_get(Request $request){
        $sesdata = $request->session()->get('msg');
        return view('hello.session', ['session_data' => $sesdata]);
    }
    
    public function ses_put(Request $request){
        $msg = $request->input;
        $request->session()->put('msg', $msg);
        return redirect('hello/session');
    }
}
*/

#page211 クエリビルダによるdelete　（del/removeアクションの変更）
/*
use App\Http\Requests\HelloRequest;
use Validator;

use Illuminate\Support\Facades\DB;

class HelloController extends Controller
{
    public function index(Request $request){
        $items = DB::table('people')->orderBy('age', 'asc')->get();
        return view('hello.index', ['items' => $items]);
    }
    
    public function post(Request $request){
        $items = DB::select('select * from people');
        return view('hello.index', ['items' => $items]);
    }
    
    public function add(Request $request){
        return view('hello.add');
    }
    
    public function create(Request $request){
        $param = [
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        // DB::insert('insert into people (name, mail, age) values (:name, :mail, :age)', $param);
        // return redirect('/hello');
        DB::table('people')->insert($param);
        return redirect('/hello');
    }
    
    public function edit(Request $request){
        $item = DB::table('people')
            ->where('id', $request->id)
            ->first();
        // $param = ['id' => $request->id];
        // $item = DB::select('select * from people where id = :id', $param);
        return view('hello.edit', ['form' => $item]);
    }
    
    public function update(Request $request){
        $param = [
            // 'id' => $request->id,
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        // DB::update('update people set name =:name, mail = :mail, age = :age where id = :id', $param);
        DB::table('people')
            ->where('id',$request->id)
            ->update($param);
        return redirect('/hello');
    }
    
    public function del(Request $request){
        // $param = ['id' => $request->id];
        // $item = DB::select('select * from people where id = :id', $param);
        $item = DB::table('people')
            ->where('id', $request->id)->first();
        // return view('hello.del', ['form' => $item[0]]);
        return view('hello.del', ['form' => $item]);
    }
    
    public function remove(Request $request){
        // $param = ['id' => $request->id];
        // DB::delete('delete from people where id = :id', $param);
        DB::table('people')
        ->where('id', $request->id)->delete();
        return redirect('/hello');
    }
    
    public function show (Request $request){
        $page = $request->page;
        $items = DB::table('people')
            ->offset($page * 3)
            ->limit(3)
            ->get();
        return view('hello.show', ['items' => $items]);
    }
    
    #page293
    public function rest(Request $request){
        return view('hello.rest');
    }
}
*/

#page211 クエリビルダによるdelete　（del/removeアクションの変更）
/*
use App\Http\Requests\HelloRequest;
use Validator;

use Illuminate\Support\Facades\DB;

class HelloController extends Controller
{
    public function index(Request $request){
        $items = DB::table('people')->orderBy('age', 'asc')->get();
        return view('hello.index', ['items' => $items]);
    }
    
    public function post(Request $request){
        $items = DB::select('select * from people');
        return view('hello.index', ['items' => $items]);
    }
    
    public function add(Request $request){
        return view('hello.add');
    }
    
    public function create(Request $request){
        $param = [
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        // DB::insert('insert into people (name, mail, age) values (:name, :mail, :age)', $param);
        // return redirect('/hello');
        DB::table('people')->insert($param);
        return redirect('/hello');
    }
    
    public function edit(Request $request){
        $item = DB::table('people')
            ->where('id', $request->id)
            ->first();
        // $param = ['id' => $request->id];
        // $item = DB::select('select * from people where id = :id', $param);
        return view('hello.edit', ['form' => $item]);
    }
    
    public function update(Request $request){
        $param = [
            // 'id' => $request->id,
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        // DB::update('update people set name =:name, mail = :mail, age = :age where id = :id', $param);
        DB::table('people')
            ->where('id',$request->id)
            ->update($param);
        return redirect('/hello');
    }
    
    public function del(Request $request){
        // $param = ['id' => $request->id];
        // $item = DB::select('select * from people where id = :id', $param);
        $item = DB::table('people')
            ->where('id', $request->id)->first();
        // return view('hello.del', ['form' => $item[0]]);
        return view('hello.del', ['form' => $item]);
    }
    
    public function remove(Request $request){
        // $param = ['id' => $request->id];
        // DB::delete('delete from people where id = :id', $param);
        DB::table('people')
        ->where('id', $request->id)->delete();
        return redirect('/hello');
    }
    
    public function show (Request $request){
        $page = $request->page;
        $items = DB::table('people')
            ->offset($page * 3)
            ->limit(3)
            ->get();
        return view('hello.show', ['items' => $items]);
    }
}
*/

#page209 クエリビルダによるupdate　（edit/updateアクションの変更）
/*
use App\Http\Requests\HelloRequest;
use Validator;

use Illuminate\Support\Facades\DB;

class HelloController extends Controller
{
    public function index(Request $request){
        $items = DB::table('people')->orderBy('age', 'asc')->get();
        return view('hello.index', ['items' => $items]);
    }
    
    public function post(Request $request){
        $items = DB::select('select * from people');
        return view('hello.index', ['items' => $items]);
    }
    
    public function add(Request $request){
        return view('hello.add');
    }
    
    public function create(Request $request){
        $param = [
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        // DB::insert('insert into people (name, mail, age) values (:name, :mail, :age)', $param);
        // return redirect('/hello');
        DB::table('people')->insert($param);
        return redirect('/hello');
    }
    
    public function edit(Request $request){
        $item = DB::table('people')
            ->where('id', $request->id)
            ->first();
        // $param = ['id' => $request->id];
        // $item = DB::select('select * from people where id = :id', $param);
        return view('hello.edit', ['form' => $item]);
    }
    
    public function update(Request $request){
        $param = [
            // 'id' => $request->id,
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        // DB::update('update people set name =:name, mail = :mail, age = :age where id = :id', $param);
        DB::table('people')
            ->where('id',$request->id)
            ->update($param);
        return redirect('/hello');
    }
    
    public function del(Request $request){
        $param = ['id' => $request->id];
        $item = DB::select('select * from people where id = :id', $param);
        return view('hello.del', ['form' => $item[0]]);
    }
    
    public function remove(Request $request){
        $param = ['id' => $request->id];
        DB::delete('delete from people where id = :id', $param);
        return redirect('/hello');
    }
    
    public function show (Request $request){
        $page = $request->page;
        $items = DB::table('people')
            ->offset($page * 3)
            ->limit(3)
            ->get();
        return view('hello.show', ['items' => $items]);
    }
}
*/

#page208 クエリビルダによるinsert　（createアクションの変更）
/*
use App\Http\Requests\HelloRequest;
use Validator;

use Illuminate\Support\Facades\DB;

class HelloController extends Controller
{
    public function index(Request $request){
        $items = DB::table('people')->orderBy('age', 'asc')->get();
        return view('hello.index', ['items' => $items]);
    }
    
    public function post(Request $request){
        $items = DB::select('select * from people');
        return view('hello.index', ['items' => $items]);
    }
    
    public function add(Request $request){
        return view('hello.add');
    }
    
    public function create(Request $request){
        $param = [
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        // DB::insert('insert into people (name, mail, age) values (:name, :mail, :age)', $param);
        // return redirect('/hello');
        DB::table('people')->insert($param);
        return redirect('/hello');
    }
    
    public function edit(Request $request){
        $param = ['id' => $request->id];
        $item = DB::select('select * from people where id = :id', $param);
        return view('hello.edit', ['form' => $item[0]]);
    }
    
    public function update(Request $request){
        $param = [
            'id' => $request->id,
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        DB::update('update people set name =:name, mail = :mail, age = :age where id = :id', $param);
        return redirect('/hello');
    }
    
    public function del(Request $request){
        $param = ['id' => $request->id];
        $item = DB::select('select * from people where id = :id', $param);
        return view('hello.del', ['form' => $item[0]]);
    }
    
    public function remove(Request $request){
        $param = ['id' => $request->id];
        DB::delete('delete from people where id = :id', $param);
        return redirect('/hello');
    }
    
    public function show (Request $request){
        $page = $request->page;
        $items = DB::table('people')
            ->offset($page * 3)
            ->limit(3)
            ->get();
        return view('hello.show', ['items' => $items]);
    }
}
*/

#page205 orderBy　（indexアクションの変更）
/*
use App\Http\Requests\HelloRequest;
use Validator;

use Illuminate\Support\Facades\DB;

class HelloController extends Controller
{
    public function index(Request $request){
        $items = DB::table('people')->orderBy('age', 'asc')->get();
        return view('hello.index', ['items' => $items]);
    }
    
    public function post(Request $request){
        $items = DB::select('select * from people');
        return view('hello.index', ['items' => $items]);
    }
    
    public function add(Request $request){
        return view('hello.add');
    }
    
    public function create(Request $request){
        $param = [
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        DB::insert('insert into people (name, mail, age) values (:name, :mail, :age)', $param);
        return redirect('/hello');
    }
    
    public function edit(Request $request){
        $param = ['id' => $request->id];
        $item = DB::select('select * from people where id = :id', $param);
        return view('hello.edit', ['form' => $item[0]]);
    }
    
    public function update(Request $request){
        $param = [
            'id' => $request->id,
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        DB::update('update people set name =:name, mail = :mail, age = :age where id = :id', $param);
        return redirect('/hello');
    }
    
    public function del(Request $request){
        $param = ['id' => $request->id];
        $item = DB::select('select * from people where id = :id', $param);
        return view('hello.del', ['form' => $item[0]]);
    }
    
    public function remove(Request $request){
        $param = ['id' => $request->id];
        DB::delete('delete from people where id = :id', $param);
        return redirect('/hello');
    }
    
    public function show (Request $request){
        $page = $request->page;
        $items = DB::table('people')
            ->offset($page * 3)
            ->limit(3)
            ->get();
        return view('hello.show', ['items' => $items]);
    }
}
*/

#page205 orderBy　（indexアクションの変更）
/*
use App\Http\Requests\HelloRequest;
use Validator;

use Illuminate\Support\Facades\DB;

class HelloController extends Controller
{
    public function index(Request $request){
        $items = DB::table('people')->orderBy('age', 'asc')->get();
        return view('hello.index', ['items' => $items]);
    }
    
    public function post(Request $request){
        $items = DB::select('select * from people');
        return view('hello.index', ['items' => $items]);
    }
    
    public function add(Request $request){
        return view('hello.add');
    }
    
    public function create(Request $request){
        $param = [
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        DB::insert('insert into people (name, mail, age) values (:name, :mail, :age)', $param);
        return redirect('/hello');
    }
    
    public function edit(Request $request){
        $param = ['id' => $request->id];
        $item = DB::select('select * from people where id = :id', $param);
        return view('hello.edit', ['form' => $item[0]]);
    }
    
    public function update(Request $request){
        $param = [
            'id' => $request->id,
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        DB::update('update people set name =:name, mail = :mail, age = :age where id = :id', $param);
        return redirect('/hello');
    }
    
    public function del(Request $request){
        $param = ['id' => $request->id];
        $item = DB::select('select * from people where id = :id', $param);
        return view('hello.del', ['form' => $item[0]]);
    }
    
    public function remove(Request $request){
        $param = ['id' => $request->id];
        DB::delete('delete from people where id = :id', $param);
        return redirect('/hello');
    }
    
    public function show (Request $request){
        $min = $request->min;
        $max = $request->max;
        $items = DB::table('people')
            ->whereRaw('age >= ? and age <=?', [$min, $max])
            ->get();
        return view('hello.show', ['items' => $items]);
    }
}
*/

#page202 where と orWhere　（showアクションの変更）
/*
use App\Http\Requests\HelloRequest;
use Validator;

use Illuminate\Support\Facades\DB;

class HelloController extends Controller
{
    public function index(Request $request){
        $items = DB::select('select * from people');
        return view('hello.index', ['items' => $items]);
    }
    
    public function post(Request $request){
        $items = DB::select('select * from people');
        return view('hello.index', ['items' => $items]);
    }
    
    public function add(Request $request){
        return view('hello.add');
    }
    
    public function create(Request $request){
        $param = [
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        DB::insert('insert into people (name, mail, age) values (:name, :mail, :age)', $param);
        return redirect('/hello');
    }
    
    public function edit(Request $request){
        $param = ['id' => $request->id];
        $item = DB::select('select * from people where id = :id', $param);
        return view('hello.edit', ['form' => $item[0]]);
    }
    
    public function update(Request $request){
        $param = [
            'id' => $request->id,
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        DB::update('update people set name =:name, mail = :mail, age = :age where id = :id', $param);
        return redirect('/hello');
    }
    
    public function del(Request $request){
        $param = ['id' => $request->id];
        $item = DB::select('select * from people where id = :id', $param);
        return view('hello.del', ['form' => $item[0]]);
    }
    
    public function remove(Request $request){
        $param = ['id' => $request->id];
        DB::delete('delete from people where id = :id', $param);
        return redirect('/hello');
    }
    
    public function show (Request $request){
        $min = $request->min;
        $max = $request->max;
        $items = DB::table('people')
            ->whereRaw('age >= ? and age <=?', [$min, $max])
            ->get();
        return view('hello.show', ['items' => $items]);
    }
}
*/

#page202 where と orWhere　（showアクションの変更）
/*
use App\Http\Requests\HelloRequest;
use Validator;

use Illuminate\Support\Facades\DB;

class HelloController extends Controller
{
    public function index(Request $request){
        $items = DB::select('select * from people');
        return view('hello.index', ['items' => $items]);
    }
    
    public function post(Request $request){
        $items = DB::select('select * from people');
        return view('hello.index', ['items' => $items]);
    }
    
    public function add(Request $request){
        return view('hello.add');
    }
    
    public function create(Request $request){
        $param = [
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        DB::insert('insert into people (name, mail, age) values (:name, :mail, :age)', $param);
        return redirect('/hello');
    }
    
    public function edit(Request $request){
        $param = ['id' => $request->id];
        $item = DB::select('select * from people where id = :id', $param);
        return view('hello.edit', ['form' => $item[0]]);
    }
    
    public function update(Request $request){
        $param = [
            'id' => $request->id,
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        DB::update('update people set name =:name, mail = :mail, age = :age where id = :id', $param);
        return redirect('/hello');
    }
    
    public function del(Request $request){
        $param = ['id' => $request->id];
        $item = DB::select('select * from people where id = :id', $param);
        return view('hello.del', ['form' => $item[0]]);
    }
    
    public function remove(Request $request){
        $param = ['id' => $request->id];
        DB::delete('delete from people where id = :id', $param);
        return redirect('/hello');
    }
    
    public function show (Request $request){
        $name = $request->name;
        $items = DB::table('people')
            ->where('name', 'like', '%' . $name . '%')
            ->orWhere('mail', 'like', '%' . $name . '%')
            ->get();
        return view('hello.show', ['items' => $items]);
    }
}
*/

#page200 演算記号を指定した検索　（showアクションの変更）
/*
use App\Http\Requests\HelloRequest;
use Validator;

use Illuminate\Support\Facades\DB;

class HelloController extends Controller
{
    public function index(Request $request){
        $items = DB::select('select * from people');
        return view('hello.index', ['items' => $items]);
    }
    
    public function post(Request $request){
        $items = DB::select('select * from people');
        return view('hello.index', ['items' => $items]);
    }
    
    public function add(Request $request){
        return view('hello.add');
    }
    
    public function create(Request $request){
        $param = [
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        DB::insert('insert into people (name, mail, age) values (:name, :mail, :age)', $param);
        return redirect('/hello');
    }
    
    public function edit(Request $request){
        $param = ['id' => $request->id];
        $item = DB::select('select * from people where id = :id', $param);
        return view('hello.edit', ['form' => $item[0]]);
    }
    
    public function update(Request $request){
        $param = [
            'id' => $request->id,
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        DB::update('update people set name =:name, mail = :mail, age = :age where id = :id', $param);
        return redirect('/hello');
    }
    
    public function del(Request $request){
        $param = ['id' => $request->id];
        $item = DB::select('select * from people where id = :id', $param);
        return view('hello.del', ['form' => $item[0]]);
    }
    
    public function remove(Request $request){
        $param = ['id' => $request->id];
        DB::delete('delete from people where id = :id', $param);
        return redirect('/hello');
    }
    
    public function show (Request $request){
        $id = $request->id;
        $items = DB::table('people')->where('id','<=', $id)->get();
        return view('hello.show', ['items' => $items]);
    }
}
*/

#page198 クエリビルダ
/*
use App\Http\Requests\HelloRequest;
use Validator;

use Illuminate\Support\Facades\DB;

class HelloController extends Controller
{
    public function index(Request $request){
        $items = DB::select('select * from people');
        return view('hello.index', ['items' => $items]);
    }
    
    public function post(Request $request){
        $items = DB::select('select * from people');
        return view('hello.index', ['items' => $items]);
    }
    
    public function add(Request $request){
        return view('hello.add');
    }
    
    public function create(Request $request){
        $param = [
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        DB::insert('insert into people (name, mail, age) values (:name, :mail, :age)', $param);
        return redirect('/hello');
    }
    
    public function edit(Request $request){
        $param = ['id' => $request->id];
        $item = DB::select('select * from people where id = :id', $param);
        return view('hello.edit', ['form' => $item[0]]);
    }
    
    public function update(Request $request){
        $param = [
            'id' => $request->id,
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        DB::update('update people set name =:name, mail = :mail, age = :age where id = :id', $param);
        return redirect('/hello');
    }
    
    public function del(Request $request){
        $param = ['id' => $request->id];
        $item = DB::select('select * from people where id = :id', $param);
        return view('hello.del', ['form' => $item[0]]);
    }
    
    public function remove(Request $request){
        $param = ['id' => $request->id];
        DB::delete('delete from people where id = :id', $param);
        return redirect('/hello');
    }
    
    public function show (Request $request){
        $id = $request->id;
        $item = DB::table('people')->where('id', $id)->first();
        return view('hello.show', ['item' => $item]);
    }
}
*/

#page191 DB::updateによるレコード編集
/*
use App\Http\Requests\HelloRequest;
use Validator;

use Illuminate\Support\Facades\DB;

class HelloController extends Controller
{
    public function index(Request $request){
        $items = DB::select('select * from people');
        return view('hello.index', ['items' => $items]);
    }
    
    public function post(Request $request){
        $items = DB::select('select * from people');
        return view('hello.index', ['items' => $items]);
    }
    
    public function add(Request $request){
        return view('hello.add');
    }
    
    public function create(Request $request){
        $param = [
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        DB::insert('insert into people (name, mail, age) values (:name, :mail, :age)', $param);
        return redirect('/hello');
    }
    
    public function edit(Request $request){
        $param = ['id' => $request->id];
        $item = DB::select('select * from people where id = :id', $param);
        return view('hello.edit', ['form' => $item[0]]);
    }
    
    public function update(Request $request){
        $param = [
            'id' => $request->id,
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        DB::update('update people set name =:name, mail = :mail, age = :age where id = :id', $param);
        return redirect('/hello');
    }
    
    public function del(Request $request){
        $param = ['id' => $request->id];
        $item = DB::select('select * from people where id = :id', $param);
        return view('hello.del', ['form' => $item[0]]);
    }
    
    public function remove(Request $request){
        $param = ['id' => $request->id];
        DB::delete('delete from people where id = :id', $param);
        return redirect('/hello');
    }
}
*/

#page187 DB::insertによるレコード作成
/*
use App\Http\Requests\HelloRequest;
use Validator;

use Illuminate\Support\Facades\DB;

class HelloController extends Controller
{
    public function index(Request $request){
        $items = DB::select('select * from people');
        return view('hello.index', ['items' => $items]);
    }
    
    public function post(Request $request){
        $items = DB::select('select * from people');
        return view('hello.index', ['items' => $items]);
    }
    
    public function add(Request $request){
        return view('hello.add');
    }
    
    public function create(Request $request){
        $param = [
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        DB::insert('insert into people (name, mail, age) values (:name, :mail, :age)', $param);
        return redirect('/hello');
    }
}
*/

#page183 DBクラスの利用
/*
use App\Http\Requests\HelloRequest;
use Validator;

use Illuminate\Support\Facades\DB;

class HelloController extends Controller
{
    public function index(Request $request){
        if (isset($request->id)){
            $param = ['id' => $request->id];
            $items = DB::select('select * from people where id = :id', $param);
        } else {
            $items = DB::select('select * from people');
        }
        return view('hello.index', ['items' => $items]);
    }
}
*/

#page183 DBクラスの利用
/*
use App\Http\Requests\HelloRequest;
use Validator;

use Illuminate\Support\Facades\DB;

class HelloController extends Controller
{
    public function index(Request $request){
        $items = DB::select('select * from people');
        return view('hello.index', ['items' => $items]);
    }
}
*/

#page157 セッションを利用す
/*
use App\Http\Requests\HelloRequest;

use Validator;

class HelloController extends Controller
{
    public function index(Request $request){
        if ($request->hasCookie('msg')){
            $msg = 'Cookie: ' . $request->cookie('msg');
        } else {
            $msg = '※クッキーはありません。';
        }
        return view('hello.index', ['msg'=> $msg ]);
    }
    
    public function post(Request $request){
        $validate_rule = [
            'msg' => 'required',
        ];
        $this->validate($request, $validate_rule);
        $msg = $request->msg;
        $response = new Response(view('hello.index', ['msg' => 
            '「' . $msg . '」をクッキーに保存しました。']));
        $response->cookie('msg', $msg, 100);
        return $response;
    }
}
*/

#page150 オリジナル・バリデータの作成
/*
use App\Http\Requests\HelloRequest;

use Validator;

class HelloController extends Controller
{
    public function index(Request $request){
        return view('hello.index', ['msg'=>'フォームを入力してください。']);
    }
    
    public function post(HelloRequest $request){
        return view('hello.index', ['msg'=>'正しく入力されました！']);
    }
}
*/

/*
#page147 条件に応じてルールを追加する
use Validator;

class HelloController extends Controller
{
    public function index(Request $request){
        $validator = Validator::make($request->query(),[
            'id' => 'required',
            'pass' => 'required',
        ]);
        if ($validator->fails()) {
            $msg = 'クエリーに問題があります。';
        } else {
            $msg = 'ID/PASSを受け付けました。フォームを入力してください。';
            
        }
        return view('hello.index', ['msg'=>$msg]);
    }
    
    public function post(Request $request){
        $rules = [
            'name' => 'required',
            'mail' => 'email',
            'age' => 'numeric',
        ];
        
        $messages = [
            'name.required' => '名前は必ず入力してください。',
            'mail.email' => 'メールアドレスが必要です。',
            'age.numeric' => '年齢を整数で記入ください。',
            'age.min' => '年齢はゼロ歳以上で記入ください。',
            'age.max' => '年齢は200歳以下で記入ください。',
        ];
        
        $validator = Validator::make($request->all(), $rules, $messages);
        
        $validator->sometimes('age', 'min:0', function($input){
            return !is_int($input->age);
        });
        $validator->sometimes('age', 'max:200', function($input){
            return !is_int($input->age);
        });
        
        if ($validator->fails()) {
            return redirect('/hello')
                    ->withErrors($validator)
                    ->withInput();
        }
        return view('hello.index', ['msg'=>'正しく入力されました！']);
    }
}
*/

#page144 バリデータのエラーメッセージをカスタマイズ
/*
use Validator;

class HelloController extends Controller
{
    public function index(Request $request){
        $validator = Validator::make($request->query(),[
            'id' => 'required',
            'pass' => 'required',
        ]);
        if ($validator->fails()) {
            $msg = 'クエリーに問題があります。';
        } else {
            $msg = 'ID/PASSを受け付けました。フォームを入力してください。';
            
        }
        return view('hello.index', ['msg'=>$msg]);
    }
    
    public function post(Request $request){
        $rules = [
            'name' => 'required',
            'mail' => 'email',
            'age' => 'numeric|between:0,150',
        ];
        
        $messages = [
            'name.required' => '名前は必ず入力してください。',
            'mail.email' => 'メールアドレスが必要です。',
            'age.numeric' => '年齢を整数で記入ください。',
            'age.between' => '年齢は0〜150の間で入力ください。',
        ];
        
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect('/hello')
                    ->withErrors($validator)
                    ->withInput();
        }
        return view('hello.index', ['msg'=>'正しく入力されました！']);
    }
}
*/

/*
#page143 クエリ文字列にバリデータを適用する
use Validator;

class HelloController extends Controller
{
    public function index(Request $request){
        $validator = Validator::make($request->query(),[
            'id' => 'required',
            'pass' => 'required',
        ]);
        if ($validator->fails()) {
            $msg = 'クエリーに問題があります。';
        } else {
            $msg = 'ID/PASSを受け付けました。フォームを入力してください。';
            
        }
        return view('hello.index', ['msg'=>$msg]);
    }
    
    public function post(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'mail' => 'email',
            'age' => 'numeric|between:0,150',
        ]);
        if ($validator->fails()) {
            return redirect('/hello')
                    ->withErrors($validator)
                    ->withInput();
        }
        return view('hello.index', ['msg'=>'正しく入力されました！']);
    }
}
*/

/*
use Validator;

class HelloController extends Controller
{
    public function index(Request $request){
        return view('hello.index', ['msg'=>'フォームを入力:']);
    }
    
    public function post(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'mail' => 'email',
            'age' => 'numeric|between:0,150',
        ]);
        if ($validator->fails()) {
            return redirect('/hello')
                    ->withErrors($validator)
                    ->withInput();
        }
        return view('hello.index', ['msg'=>'正しく入力されました！']);
    }
}
*/

#page138 フォームリクエストを利用する(バリデーション部分を削除)
/*
use App\Http\Requests\HelloRequest;

class HelloController extends Controller
{
    public function index(Request $request){
        return view('hello.index', ['msg'=>'フォームを入力:']);
    }
    
    public function post(HelloRequest $request){
        return view('hello.index', ['msg'=>'正しく入力されました！']);
    }
}
*/

#page122 バリデーションを利用する
/*
class HelloController extends Controller
{
    public function index(Request $request){
        return view('hello.index', ['msg'=>'フォームを入力:']);
    }
    
    public function post(Request $request){
        $validate_rule = [
            'name' => 'required',
            'mail' => 'email',
            'age' => 'numeric|between:0,150',
        ];
        $this->validate($request, $validate_rule);
        return view('hello.index', ['msg'=>'正しく入力されました！']);
    }
}
*/

#page117 レスポンスを操作する
/*
class HelloController extends Controller
{
    public function index(Request $request){
        return view('hello.index');
    }
}
*/

#page112
/*
class HelloController extends Controller
{
    public function index(Request $request){
        return view('hello.index', ['data'=>$request->data]);
    }
}
*/

#page103 ビューコンポーザを利用する
/*
class HelloController extends Controller
{
    public function index(){
        return view('hello.index', ['message'=>'Hello!']);
    }
}
*/

#page97 ＠echoによるコレクションビュー
/*
class HelloController extends Controller
{
    public function index(){
        $data = [
            ['name'=>'山田たろう', 'mail'=>'taro@yamada'],
            ['name'=>'田中はなこ', 'mail'=>'hanako@flower'],
            ['name'=>'鈴木さちこ', 'mail'=>'sachico@happy'],
        ];
        return view('hello.index', ['data'=>$data]);
    }
}
*/

#page84 ディレクティブphp
#変更なし

#page83 ＄loopによる変数
#変更なし

#page81ディレクティブbrakeとディレクティブcontinue
#変更なし

#page80(繰り返しディレクティブを利用する)
/*
class HelloController extends Controller
{
    public function index(){
        $data = ['one', 'two', 'three', 'four', 'five'];
        return view('hello.index', ['data'=>$data]);
        //『return view( ‘テンプレート’ , 連想配列); 』
        //bladeテンプレートでは$キーで呼び出し
    }
}
*/

#page77(Bladeディレクティブissetで変数定義をチェックする)
/*
class HelloController extends Controller
{
    public function index(){
        return view('hello.index');
    }
    
    public function post(Request $request)
    {
        return view('hello.index', ['msg'=>$request->msg]);
    }
}
*/

#page69(Blade構文のディレクティブを利用する)
/*
class HelloController extends Controller
{
    public function index(){
        $data = [
            'msg'=>'お名前を入力してください。',
            ];
        return view('hello.index', $data);
    }
    public function post(Request $request)
    {
        return view('hello.index', ['msg'=>$request->msg]);
    }
}
*/
#page69(フォームを利用する)
/*
class HelloController extends Controller
{
    public function index(){
        $data = [
            'msg'=>'お名前を入力してください。',
            ];
        return view('hello.index', $data);
    }
    public function post(Request $request){
        $msg = $request->msg;
        $data = [
            'msg'=>'こんにちは、' .$msg . 'さん！',
        ];
        return view('hello.index', $data);
    }
}
*/

#page68(Bladeテンプレートを使う)
/*
class HelloController extends Controller
{
    public function index(Request $request){
        $data = [
            'msg'=>'これはBladeを利用したサンプルです。',
            'id' =>$request->id
            ];
        return view('hello.index', $data);
        #viewメソッドの引数を'hello.index.blade'とするとエラー
    }
}
*/

#page66クエリー文字の利用
/*
class HelloController extends Controller
{
    public function index(Request $request){
        $data = [
            'msg'=>'これはコントローラから渡されたメッセージです。',
            'id' =>$request->id
            ];
        return view('hello.index', $data);
    }
} 
*/

#page65(ルートパラメータをテンプレートに渡す)
/*
class HelloController extends Controller
{
    public function index($id='zero'){
        $data = [
            'msg'=>'これはコントローラから渡されたメッセージです。',
            'id' => $id
            ];
        return view('hello.index', $data);
    }
} 
*/

#page63(値をテンプレートに渡す)
/*
class HelloController extends Controller
{
    public function index(){
        $data = ['msg'=>'これはコントローラから渡されたメッセージです。'];
        return view('hello.index', $data);
    }
} 
*/

#page62(コントローラでテンプレートを使う)
/*
class HelloController extends Controller
{
    public function index(){
        return view('hello.index');
    }
} 
*/

#page51追記（リクエストとレスポンス）
/*
use Illuminate\Http\Response;

class HelloController extends Controller 
{
    public function index(Request $request, Response $response){
        $html = <<<EOF
<html>
<head>
<title>Hello/Index</title>
<style>
body {font-size:16pt; color:#999;}
h1 {font-size: 120pt; text-align: right; color: #eee; margin: -50px 0 -120px 0; }
</style>
</head>
<body>
    <h1>Hello<h1>
    <h3>Request</h3>
    <pre>{$request}</pre>
        <pre>{$request->url()}</pre>
        <pre>{$request->fullUrl()}</pre>
        <pre>{$request->path()}</pre>
    
    <h3>Response</h3>
    <pre>{$response}</pre>
        <pre>{$response->status()}</pre>
</body>
</html>
EOF;
       $response->setContent($html);
       return $response;
    }
}
*/

#page49追記（シングルアクションコントローラ）
/*
class HelloController extends Controller
{
    public function __invoke(){

        return <<<EOF
<html>
<head>
<title>Hello</title>
<style>
body {font-size:16pt; color:#999;}
h1 {font-size: 30pt; text-align: right; color: #eee; margin: -15px 0 0 0; }
</style>
</head>
<body>
    <h1>Single Action</h1>
    <p>これは、シングルアクションコントローラのアクションです。</p>
</body>
</html>
EOF;

    }
}
*/

#page47追記（複数アクションの利用）
/*
global $head, $style, $body, $end;
$head = '<html><head>';
$style = <<<EOF
<style>
body {font-size:16pt; color:#999; }
h1 {font-size: 100pt; text-align: right; color: #eee; margin: -40px 0 -50px 0; }
</style>
EOF;
$body = '</head><body>';
$end = '</body></html>';

function tag($tag, $txt) {
    return "<{$tag}>" . $txt. "</{$tag}>";
}

class HelloController extends Controller
{
    public function index(){
        global $head, $style, $body, $end;
        
        $html = $head . tag('title','Hello/Index'). $style. $body. tag('h1', 'Index') . tag('p', 'this is Index page') . '<a href="/hello/other">go to Other page</a>' . $end;
        return $html;
    }    
    
    public function other(){
        global $head, $style, $body, $end;
        
        $html = $head . tag('title', 'Hello/Other') . $style . $body . tag('h1', 'Other') . tag('p', 'this is Other page') . $end;
        return $html;
    }
}
*/

#page45追記(ルートパラメータの利用)
/*
class HelloController extends Controller
{
	public function index($id='noname', $pass='unknown'){
	  
	  return <<<EOF
<html>
<head>
<title>Hello/Index</title>
<style>
body {font-size:16pt; color:#999;}
h1 {font-size: 100pt; text-align: right; color: #eee; margin: -40px 0 -50px 0; }
</style>
</head>
<body>
	<h1>Index</h1>
	<p>これは、Helloコントローラのindexアクションです。</p>
	<ul>
		<li>ID: {$id}</li>
		<li>PASS:{$pass}</li>
	</ul>
</body>
</html>
EOF;
	}
}
*/

#page43追記（アクションを追加する）
/*
class HelloController extends Controller
{
    //
	public function index() {
	
	return <<<EOF
<html>
<head>
<style>
body {font-size: 16pt; color:#999; }
h1{font-size: 100pt; text-align: right; color: #eee; margin: -40px 0 -50px 0; }
</style>
</head>
<body>
	<h1>Index</h1>
	<p>これは、Helloコントローラのindexアクションです。</p>
</body>
</html>
EOF;

	}
}
*/