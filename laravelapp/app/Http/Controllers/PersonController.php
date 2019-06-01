<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

#page275 関連レコードの有無
use App\Person;

class PersonController extends Controller
{
    //page275 関連レコードの有無
    public function index(Request $request)
    {
        $hasItems = Person::has('boards')->get();
        $noItems = Person::doesntHave('boards')->get();
        $param = ['hasItems' => $hasItems, 'noItems' => $noItems];
        return view('person.index', $param);
    }
    
    public function find(Request $request){
        return view('person.find',['input' => '']);
    }
    
    public function search(Request $request){
        #送信した数字〜数字+10の範囲のレコードが検索される
        $min = $request->input * 1;
        $max = $min + 10;
        $item = Person::ageGreaterThan($min)->
            ageLessThan($max)->first();
        $param = ['input' => $request->input, 'item' => $item];
        return view('person.find', $param);
    }
    public function add(Request $request){
        return view('person.add');
    }
    public function create(Request $request){
        $this->validate($request, Person::$rules);
        $person = new Person;
        $form = $request->all();
        unset($form['_token']);
        $person->fill($form)->save();
        return redirect('/person');
    }
    public function edit(Request $request){
        $person = Person::find($request->id);
        return view('person.edit', ['form' => $person]);
    }
    public function update(Request $request)
    {
        $this->validate($request, Person::$rules);
        $person = Person::find($request->id);
        $form = $request->all();
        unset($form['_token']);
        $person->fill($form)->save();
        return redirect('/person');
    }
    public function delete(Request $request){
        $person = Person::find($request->id);
        return view('person.del', ['form' => $person]);
    }
    public function remove(Request $request){
        Person::find($request->id)->delete();
        return redirect('/person');
    }
    
}

#page255 モデルの削除
/*
use App\Person;

class PersonController extends Controller
{
    //
    public function index(Request $request)
    {
        $items = Person::all();
        return view('person.index', ['items' => $items]);
    }
    
    public function find(Request $request){
        return view('person.find',['input' => '']);
    }
    
    public function search(Request $request){
        #送信した数字〜数字+10の範囲のレコードが検索される
        $min = $request->input * 1;
        $max = $min + 10;
        $item = Person::ageGreaterThan($min)->
            ageLessThan($max)->first();
        $param = ['input' => $request->input, 'item' => $item];
        return view('person.find', $param);
    }
    public function add(Request $request){
        return view('person.add');
    }
    public function create(Request $request){
        $this->validate($request, Person::$rules);
        $person = new Person;
        $form = $request->all();
        unset($form['_token']);
        $person->fill($form)->save();
        return redirect('/person');
    }
    public function edit(Request $request){
        $person = Person::find($request->id);
        return view('person.edit', ['form' => $person]);
    }
    public function update(Request $request)
    {
        $this->validate($request, Person::$rules);
        $person = Person::find($request->id);
        $form = $request->all();
        unset($form['_token']);
        $person->fill($form)->save();
        return redirect('/person');
    }
    #255 モデルの削除
    public function delete(Request $request){
        $person = Person::find($request->id);
        return view('person.del', ['form' => $person]);
    }
    public function remove(Request $request){
        Person::find($request->id)->delete();
        return redirect('/person');
    }
}
*/

#page248 モデルの新規保存
/*
use App\Person;

class PersonController extends Controller
{
    //
    public function index(Request $request)
    {
        $items = Person::all();
        return view('person.index', ['items' => $items]);
    }
    
    public function find(Request $request){
        return view('person.find',['input' => '']);
    }
    
    public function search(Request $request){
        #送信した数字〜数字+10の範囲のレコードが検索される
        $min = $request->input * 1;
        $max = $min + 10;
        $item = Person::ageGreaterThan($min)->
            ageLessThan($max)->first();
        $param = ['input' => $request->input, 'item' => $item];
        return view('person.find', $param);
    }
    public function add(Request $request){
        return view('person.add');
    }
    public function create(Request $request){
        $this->validate($request, Person::$rules);
        $person = new Person;
        $form = $request->all();
        unset($form['_token']);
        $person->fill($form)->save();
        return redirect('/person');
    }
    #page252
    public function edit(Request $request){
        $person = Person::find($request->id);
        return view('person.edit', ['form' => $person]);
    }
    public function update(Request $request)
    {
        $this->validate($request, Person::$rules);
        $person = Person::find($request->id);
        $form = $request->all();
        unset($form['_token']);
        $person->fill($form)->save();
        return redirect('/person');
    }
    
}
*/

#page248 モデルの新規保存
/*
use App\Person;

class PersonController extends Controller
{
    //
    public function index(Request $request)
    {
        $items = Person::all();
        return view('person.index', ['items' => $items]);
    }
    
    public function find(Request $request){
        return view('person.find',['input' => '']);
    }
    
    public function search(Request $request){
        #送信した数字〜数字+10の範囲のレコードが検索される
        $min = $request->input * 1;
        $max = $min + 10;
        $item = Person::ageGreaterThan($min)->
            ageLessThan($max)->first();
        $param = ['input' => $request->input, 'item' => $item];
        return view('person.find', $param);
    }
    
    public function add(Request $request){
        return view('person.add');
    }
    
    public function create(Request $request){
        $this->validate($request, Person::$rules);
        $person = new Person;
        $form = $request->all();
        unset($form['_token']);
        $person->fill($form)->save();
        return redirect('/person');
    }
}
*/

#page240 スコープを組み合わせる(searchメソッドの編集)
/*
use App\Person;

class PersonController extends Controller
{
    //
    public function index(Request $request)
    {
        $items = Person::all();
        return view('person.index', ['items' => $items]);
    }
    
    public function find(Request $request){
        return view('person.find',['input' => '']);
    }
    
    public function search(Request $request){
        #送信した数字〜数字+10の範囲のレコードが検索される
        $min = $request->input * 1;
        $max = $min + 10;
        $item = Person::ageGreaterThan($min)->
            ageLessThan($max)->first();
        $param = ['input' => $request->input, 'item' => $item];
        return view('person.find', $param);
    }
}
*/

#page239 nameをスコープにする(searchメソッドの編集)
/*
use App\Person;

class PersonController extends Controller
{
    //
    public function index(Request $request)
    {
        $items = Person::all();
        return view('person.index', ['items' => $items]); #personフォルダのindexを読み込む
    }
    
    public function find(Request $request){
        return view('person.find',['input' => '']);
    }
    
    public function search(Request $request){
        $item = Person::nameEqual($request->input)->first();
        $param = ['input' => $request->input, 'item' => $item];
        return view('person.find', $param);
    }
}
*/

#page236 whereによる検索
/*
use App\Person;

class PersonController extends Controller
{
    //
    public function index(Request $request)
    {
        $items = Person::all();
        return view('person.index', ['items' => $items]); #personフォルダのindexを読み込む
    }
    
    public function find(Request $request){
        return view('person.find',['input' => '']);
    }
    
    public function search(Request $request){
        $item = Person::where('name', $request->input)->first();
        $param = ['input' => $request->input, 'item' => $item];
        return view('person.find', $param);
    }
}
*/

#page234 IDによる検索
/*
use App\Person;

class PersonController extends Controller
{
    //
    public function index(Request $request)
    {
        $items = Person::all();
        return view('person.index', ['items' => $items]); #personフォルダのindexを読み込む
    }
    
    public function find(Request $request){
        return view('person.find',['input' => '']);
    }
    
    public function search(Request $request){
        $item = Person::find($request->input);
        $param = ['input' => $request->input, 'item' => $item];
        return view('person.find', $param);
    }
}
*/

#page232 モデルのソースコード
/*
use App\Person;

class PersonController extends Controller
{
    //
    public function index(Request $request)
    {
        $items = Person::all();
        return view('person.index', ['items' => $items]); #personフォルダのindexを読み込む
    }
}
*/

// 追加
/*
use App\Person;

class PersonController extends Controller
{
    //
    public function index(Request $request)
    {
        $items = Person::all();
        return view('person.index', ['items' => $items]); #personフォルダのindexを読み込む
    }
}
*/