<?php
namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

#page153 Validator::extendを利用する 【OK：正常に動作】
// use Illuminate\Validation\Validator;　#正誤表 訂正前
use Validator; #正誤表 訂正後リスト4-31
use App\Http\Validators\HelloValidator;

class HelloServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
      Validator::extend('hello', function($attribute, $value, $parameters, $validator) {
          return $value % 2 == 0;
      });
    }
}

// #page150 オリジナル・バリデータの作成 【エラー質問】
// // use Illuminate\Validation\Validator;　#正誤表 訂正前
// use Validator; #正誤表 訂正後リスト4-31
// use App\Http\Validators\HelloValidator;

// class HelloServiceProvider extends ServiceProvider
// {
//     public function register()
//     {
//         //
//     }

//     public function boot()
//     {
//         $validator = $this->app['validator'];
//         $validator->resolver(function($translator, $data, $rules, $messages) {
//             return new HelloValidator($translator, $data, $rules, $messages);
//         });
//     }
// }

// namespace App\Providers;

// use Illuminate\Support\Facades\View;
// use Illuminate\Support\ServiceProvider;

// class HelloServiceProvider extends ServiceProvider
// {
//     /**
//      * Register services.
//      *
//      * @return void
//      */
//     public function register()
//     {
//         //
//     }

//     /**
//      * Bootstrap services.
//      *
//      * @return void
//      */
//      #page105 ビューコンポーザクラスの作成
//     public function boot()
//     {
// 	    View::composer(
// 		    'hello.index', 'App\Http\Composers\HelloComposer'
// 	    );
//     }
//     /*
//     public function boot()
//     {
// 	    View::composer(
// 		    'hello.index', function($view){
// 			    $view->with('view_message', 'composer message!');
// 		    }
// 	    );
//     }
//     */
// }
