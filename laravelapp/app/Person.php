<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
#page270 hasMany結合
use Illuminate\Database\Eloquent\Builder;
use App\Scopes\ScopePerson;
use App\Board;

class Person extends Model
{
    public function getData(){
        return $this->id . ': ' . $this->name . ' (' . $this->age . ')';
    }
    
    protected $guarded= array('id');
    
    public static $rules = array(
        'name' => 'required',
        'mail' => 'email',
        'age' => 'integer|min:0|max:150'
    );
    
    #page270
    public function boards(){
        return $this->hasMany('App\Board');
    }
    
}

#page268 hasOne結合
/*
use Illuminate\Database\Eloquent\Builder;
use App\Scopes\ScopePerson;
use App\Board;

class Person extends Model
{
    public function getData(){
        return $this->id . ': ' . $this->name . ' (' . $this->age . ')';
    }
    
    protected $guarded= array('id');
    
    public static $rules = array(
        'name' => 'required',
        'mail' => 'email',
        'age' => 'integer|min:0|max:150'
    );
    
    #page268
    public function board(){
        return $this->hasOne('App\Board');
    }
    
}
*/

#page246 モデルを修正する
/*
use Illuminate\Database\Eloquent\Builder;
use App\Scopes\ScopePerson;

class Person extends Model
{
    public function getData(){
        return $this->id . ': ' . $this->name . ' (' . $this->age . ')';
    }
    
    protected $guarded= array('id');
    
    public static $rules = array(
        'name' => 'required',
        'mail' => 'email',
        'age' => 'integer|min:0|max:150'
    );
}
*/

#page245 Scopeクラスを作る
/*
use Illuminate\Database\Eloquent\Builder;
use App\Scopes\ScopePerson;
class Person extends Model
{
    public function getData(){
        return $this->id . ': ' . $this->name . ' (' . $this->age . ')';
    }
    public function scopeNameEqual($query, $str){
        return $query->where('name', $str);
    }
    public function scopeAgeGreaterThan($query , $n){
        return $query->where('age', '>=', $n);
    }
    
    public function scopeAgeLessThan($query, $n){
        return $query->where('age', '<=', $n);
    }
    
    #page245 Scopeクラスを作る
    protected static function boot(){
        parent::boot();
        
        static::addGlobalScope(new ScopePerson);
    }
}
*/

#page243 グローバルスコープ
/*
use Illuminate\Database\Eloquent\Builder;

class Person extends Model
{
    //page232
    public function getData(){
        return $this->id . ': ' . $this->name . ' (' . $this->age . ')';
    }
    //page239 nameをスコープにする。
    public function scopeNameEqual($query, $str){
        return $query->where('name', $str);
    }
    //page240 スコープを組み合わせる
    public function scopeAgeGreaterThan($query , $n){
        return $query->where('age', '>=', $n);
    }
    
    public function scopeAgeLessThan($query, $n){
        return $query->where('age', '<=', $n);
    }
    
    #page243 グローバルスコープ
    protected static function boot(){
        parent::boot();
        
        static::addGlobalScope('age', function(Builder $builder){
            $builder->where('age', '>', 20);
        });
    }
}
*/

/*
class Person extends Model
{
    //page232
    public function getData(){
        return $this->id . ': ' . $this->name . ' (' . $this->age . ')';
    }
    //page239 nameをスコープにする。
    public function scopeNameEqual($query, $str){
        return $query->where('name', $str);
    }
    //page240 スコープを組み合わせる
    public function scopeAgeGreaterThan($query , $n){
        return $query->where('age', '>=', $n);
    }
    
    public function scopeAgeLessThan($query, $n){
        return $query->where('age', '<=', $n);
    }
}
*/

/*
class Person extends Model
{
    //page232
    public function getData(){
        return $this->id . ': ' . $this->name . ' (' . $this->age . ')';
    }
    //page239 nameをスコープにする。
    public function scopeNameEqual($query, $str){
        return $query->where('name', $str);
    }
}
*/

/*
class Person extends Model
{
    //page232
    public function getData(){
        return $this->id . ': ' . $this->name . ' (' . $this->age . ')';
    }
}
*/