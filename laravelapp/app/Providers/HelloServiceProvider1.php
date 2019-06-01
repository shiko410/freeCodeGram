<?php
namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

#page150 オリジナル・バリデータの作成
// use Illuminate\Validation\Validator;　#正誤表 訂正前
use Validator; #正誤表 訂正後リスト4-31
use App\Http\Validators\HelloValidator1;

class HelloServiceProvider1 extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $validator = $this->app['validator'];
        $validator->resolver(function($translator, $data, $rules, $messages) {
            return new HelloValidator1($translator, $data, $rules, $messages);
        });
    }
}
