<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

#page150 オリジナル・バリデータの作成
class HelloRequest1 extends FormRequest
{
    public function authorize()
    {
        if ($this->path() == 'hello1'){
            return true;
        } else {
            return false;
        }
    }
    
    public function rules(){
        return [
            'name' => 'required',
            'mail' => 'email',
            'age' => 'numeric|hello',
        ];
    }
    
    public function messages(){
        return [
            'name.required' => '名前は必ず入力してください。',
            'mail.email' => 'メールアドレスが必要です。',
            'age.numeric' => '年齢を整数で記入ください。',
            'age.hello' => 'Hello!入力は偶数のみ受け付けます。',
        ];
    }
}
