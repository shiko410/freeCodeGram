<!-- page305 ページネーション -->
@extends('layouts.helloapp')
<style>
    .pagenation { font-size: 10pt; }
    .pagenation li { display:inline-block; }
    tr th a:link { color: white; }
    tr th a:visited { color: white; }
    tr th a:hover { color: white; }
    tr th a:active { color: white; }
</style>
@section('title', 'Index')

@section('menubar')
    @parent
    インデックスページ
@endsection

@section('content')
    <table>
       <tr>
           <th><a href="/hello?sort=name">name</a></th>
           <th><a href="/hello?sort=mail">mail</a></th>
           <th><a href="/hello?sort=age">age</a></th>
        </tr>
        @foreach ($items as $item)
           <tr>
               <td>{{$item->name}}</td>
               <td>{{$item->mail}}</td>
               <td>{{$item->age}}</td>
           </tr>
        @endforeach
    </table>
    {{ $items->appends(['sort' => $sort])->links() }}
@endsection

@section('footer')
copyright 2017 tuyano.
@endsection

<!-- page305 ページネーション -->
<? php /*
@extends('layouts.helloapp')
<style>
    .pagenation { font-size: 10pt; }
    .pagenation li { display:inline-block; }
</style>
@section('title', 'Index')

@section('menubar')
    @parent
    インデックスページ
@endsection

@section('content')
    <table>
       <tr><th>Name</th><th>Mail</th><th>Age</th></tr>
        @foreach ($items as $item)
           <tr>
               <td>{{$item->name}}</td>
               <td>{{$item->mail}}</td>
               <td>{{$item->age}}</td>
           </tr>
        @endforeach
    </table>
    {{ $items->links() }}
@endsection

@section('footer')
copyright 2017 tuyano.
@endsection
*/ ?>

<!-- page157 セッションを利用する -->
<? php /*
@extends('layouts.helloapp')

@section('title', 'Index')

@section('menubar')
    @parent
    インデックスページ
@endsection

@section('content')
    <table>
       <tr><th>Name</th><th>Mail</th><th>Age</th></tr>
        @foreach ($items as $item)
           <tr>
               <td>{{$item->name}}</td>
               <td>{{$item->mail}}</td>
               <td>{{$item->age}}</td>
           </tr>
        @endforeach
    </table>
@endsection

@section('footer')
copyright 2017 tuyano.
@endsection
*/ ?>


<!-- page157 セッションを利用する -->
<?php /*
@extends('layouts.helloapp')

@section('title', 'Index')

@section('menubar')
    @parent
    インデックスページ
@endsection

@section('content')
    <p>ここが本文のコンテンツです。</p>
    <p>{{$msg}}</p>
    @if (count($errors) > 0)
        <p>入力に問題があります。再入力してください。</p>
    @endif
    <table>
        <form action="/hello" method="post">
            {{ csrf_field() }}
            @if ($errors->has('msg'))
                <tr>
                    <th>ERROR</th>
                    <td>{{$errors->first('msg')}}</td>
                </tr>
            @endif
            <tr>
                <th>Message: </th>
                <td><input type="text" name="msg" value="{{old('msg')}}"/></td>
            </tr>
            <tr>
                <th></th>
                <td><input type="submit" value="send"/></td>
            </tr>
        </form>
    </table>
@endsection

@section('footer')
copyright 2017 tuyano.
@endsection

*/ ?>

<?php /*
<!-- page128 フィールド毎にエラーメッセージを表示 -->
@extends('layouts.helloapp')

@section('title', 'Index')

@section('menubar')
    @parent
    インデックスページ
@endsection

@section('content')
    <p>ここが本文のコンテンツです。</p>
    <p>{{$msg}}</p>
    @if (count($errors) > 0)
        <p>入力に問題があります。再入力してください。</p>
    @endif
    <table>
        <form action="/hello" method="post">
            {{ csrf_field() }}
            @if ($errors->has('name'))
                <tr>
                    <th>ERROR</th>
                    <td>{{$errors->first('name')}}</td>
                </tr>
            @endif
            <tr>
                <th>name: </th>
                <td><input type="text" name="name" value="{{old('name')}}"/></td>
            </tr>
            
            @if ($errors->has('mail'))
                <tr>
                    <th>ERROR</th>
                    <td>{{$errors->first('mail')}}</td>
                </tr>
            @endif
            <tr>
                <th>mail: </th>
                <td><input type="text" name="mail"value="{{old('mail')}}"/></td>
            </tr>
            
            @if ($errors->has('age'))
                <tr>
                    <th>ERROR</th>
                    <td>{{$errors->first('age')}}</td>
                </tr>
            @endif
            <tr>
                <th>age: </th>
                <td><input type="text" name="age" value="{{old('age')}}"/></td>
            </tr>
            <tr>
                <th></th>
                <td><input type="submit" name="send"/></td>
            </tr>
        </form>
    </table>
@endsection

@section('footer')
copyright 2017 tuyano.
@endsection
*/ ?>

<!-- page125 バリデーションのエラーメッセージと値の保持 -->
<?php /*
@extends('layouts.helloapp')

@section('title', 'Index')

@section('menubar')
    @parent
    インデックスページ
@endsection

@section('content')
    <p>ここが本文のコンテンツです。</p>
    <p>{{$msg}}</p>
    @if (count($errors) > 0)
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <table>
        <form action="/hello" method="post">
            {{ csrf_field() }}
            <tr>
                <th>name: </th>
                <td><input type="text" name="name" value="{{old('name')}}"/></td>
            </tr>
            <tr>
                <th>mail: </th>
                <td><input type="text" name="mail"value="{{old('mail')}}"/></td>
            </tr>
            <tr>
                <th>age: </th>
                <td><input type="text" name="age" value="{{old('age')}}"/></td>
            </tr>
            <tr>
                <th></th>
                <td><input type="submit" name="send"/></td>
            </tr>
        </form>
    </table>
@endsection

@section('footer')
copyright 2017 tuyano.
@endsection
*/ ?>

<!-- page122 バリデーションも利用する -->
<?php /*
@extends('layouts.helloapp')

@section('title', 'Index')

@section('menubar')
    @parent
    インデックスページ
@endsection

@section('content')
    <p>ここが本文のコンテンツです。</p>
    <p>{{$msg}}</p>
    <table>
        <form action="/hello" method="post">
            {{ csrf_field() }}
            <tr>
                <th>name: </th>
                <td><input type="text" name="name"/></td>
            </tr>
            <tr>
                <th>mail: </th>
                <td><input type="text" name="mail"/></td>
            </tr>
            <tr>
                <th>age: </th>
                <td><input type="text" name="age"/></td>
            </tr>
            <tr>
                <th></th>
                <td><input type="submit" name="send"/></td>
            </tr>
        </form>
    </table>
@endsection

@section('footer')
copyright 2017 tuyano.
@endsection
*/ ?>

<!-- page117 レスポンスを操作する -->
<?php /*
@extends('layouts.helloapp')

@section('title', 'Index')

@section('menubar')
    @parent
    インデックスページ
@endsection

@section('content')
    <p>ここが本文のコンテンツです。</p>
    <p>これは、<middleware>google.com</middleware>へのリンクです。</p>
    <p>これは、<middleware>yahoo.co.jp</middleware>へのリンクです。</p>
    
@endsection

@section('footer')
copyright 2017 tuyano.
@endsection
*/ ?>

<?php /*
<!-- page112 ミドルウェアの実行 -->
@extends('layouts.helloapp')

@section('title', 'Index')

@section('menubar')
    @parent
    インデックスページ
@endsection

@section('content')
    <p>ここが本文のコンテンツです。</p>
    <table>
        @foreach($data as $item)
        <tr>
            <th>{{$item['name']}}</th>
            <td>{{$item['mail']}}</td>
        </tr>
        @endforeach
    </table>
    
@endsection

@section('footer')
copyright 2017 tuyano.
@endsection
*/ ?>

<?php /*
<!-- page103 ビューコンポーザを利用する -->
@extends('layouts.helloapp')

@section('title', 'Index')

@section('menubar')
    @parent
    インデックスページ
@endsection

@section('content')
    <p>ここが本文のコンテンツです。</p>
    <p>Controller value<br>'message' = {{$message}}</p>
    <p>VireComposer value<br>'view_message' = {{$view_message}}</p>
    
@endsection

@section('footer')
copyright 2017 tuyano.
@endsection
*/ ?>

<?php /*
<!-- page97 ＠echoによるコレクションビュー -->
@extends('layouts.helloapp')

@section('title', 'Index')

@section('menubar')
    @parent
    インデックスページ
@endsection

@section('content')
    <p>ここが本文のコンテンツです。</p>
    
    @each('components.item', $data, 'item')
    
@endsection

@section('footer')
copyright 2017 tuyano.
@endsection
*/ ?>

<!-- page95 サブビューで読み込む -->
<?php /*
@extends('layouts.helloapp')

@section('title', 'Index')

@section('menubar')
    @parent    <!-- @parentをコメントアウトすることでpage91の表示になる-->
    インデックスページ
@endsection

@section('content')
    <p>ここが本文のコンテンツです。</p>
    <p>必要なだけ記述できます。</p>
    
    @include('components.message', ['msg_title'=>'OK' , 
        'msg_content'=>'サブビューです。'])
    
@endsection

@section('footer')
copyright 2017 tuyano.
@endsection
*/ ?>

<!-- page93 コンポーネントを組み込む -->
<?php /*
@extends('layouts.helloapp')

@section('title', 'Index')

@section('menubar')
    @parent    <!-- @parentをコメントアウトすることでpage91の表示になる-->
    インデックスページ
@endsection

@section('content')
    <p>ここが本文のコンテンツです。</p>
    <p>必要なだけ記述できます。</p>
    
    @component('components.message')
        @slot('msg_title')
        CAUTION!
        @endslot
        
        @slot('msg_content')
        これはメッセージの表示です。
        @endslot
    @endcomponent
    
@endsection

@section('footer')
copyright 2017 tuyano.
@endsection
*/ ?>

<!-- page89 継承レイアウトの作成 -->
<?php /*
@extends('layouts.helloapp')

@section('title', 'Index')

@section('menubar')
    @parent    <!-- @parentをコメントアウトすることでpage91の表示になる-->
    インデックスページ
@endsection

@section('content')
    <p>ここが本文のコンテンツです。</p>
    <p>必要なだけ記述できます。</p>
@endsection

@section('footer')
copyright 2017 tuyano.
@endsection
*/ ?>

<!-- page84 ディレクティブphp -->
<?php /*
<html>
<head>
    <title>Hello/Index</title>
    <style>
    body {font-size:16pt; color: #999; }
    h1 {font-size:50pt; text-align:right; color: #f6f6f6; margin: -20px 0 -30px 0; letter-spacing: -4pt; }
    </style>
</head>
<body>
    <h1>Blade/Index</h1>
    <p>&#064;whileディレクティブの例</p>
    <ol>
        @php
        $counter = 0;
        @endphp
        @while ($counter < count($data))
        <li>{{$data[$counter]}}</li>
        @php
        $counter++;
        @endphp
        @endwhile
    </ol>
</body>
</html>
*/ ?>

<!-- page83 ＄loopによる変数-->
<?php /*
<html>
<head>
    <title>Hello/Index</title>
    <style>
    body {font-size:16pt; color: #999; }
    h1 {font-size:50pt; text-align:right; color: #f6f6f6; margin: -20px 0 -30px 0; letter-spacing: -4pt; }
    </style>
</head>
<body>
    <h1>Blade/Index</h1>
    <p>&#064;forディレクティブの例</p>
    <ol>
        @foreach($data as $item)
        @if ($loop->first)
        <p>※データ一覧</p>
        <ul>
        @endif
        <li>No, {{$loop->iteration}}. {{$item}}</li>
        @if ($loop->last)
        </ul>
        <p>----ここまで</p>
        @endif
        @endforeach
    </ol>
</body>
</html>
*/ ?>

<!-- page81ディレクティブbrakeとディレクティブcontinue-->
<?php /*
<html>
<head>
    <title>Hello/Index</title>
    <style>
    body {font-size:16pt; color: #999; }
    h1 {font-size:50pt; text-align:right; color: #f6f6f6; margin: -20px 0 -30px 0; letter-spacing: -4pt; }
    </style>
</head>
<body>
    <h1>Blade/Index</h1>
    <p>&#064;forディレクティブの例</p>
    <ol>
        @for($i = 1; $i < 100; $i++)
        @if ($i % 2 == 1)
            @continue
        @elseif ($i <= 10 )
        <li>No, {{$i}}
        @else
            @break
        @endif
        @endfor
    </ol>
</body>
</html>
*/ ?>

<!-- page80(繰り返しディレクティブを利用する) -->
<?php /*
<html>
<head>
    <title>Hello/Index</title>
    <style>
    body {font-size:16pt; color: #999; }
    h1 {font-size:50pt; text-align:right; color: #f6f6f6; margin: -20px 0 -30px 0; letter-spacing: -4pt; }
    </style>
</head>
<body>
    <h1>Blade/Index</h1>
    <p>&#064;foreachディレクティブの例</p>
    <ol>
        @foreach($data as $item)
        <li>{{$item}}</li>
        @endforeach
    </ol>
</body>
</html>
*/ ?>

<!-- page77(Bladeディレクティブissetで変数定義をチェックする) -->
<?php /*
<html>
<head>
    <title>Hello/Index</title>
    <style>
    body {font-size:16pt; color: #999; }
    h1 {font-size:50pt; text-align:right; color: #f6f6f6; margin: -20px 0 -30px 0; letter-spacing: -4pt; }
    </style>
</head>
<body>
    <h1>Blade/Index</h1>
    @isset($msg)
    <p>こんにちは、{{$msg}}さん。</p>
    @else
    <p>何か書いてください。</p>
    @endisset
    <form method="POST" action="/hello">
        {{ csrf_field() }}
        <input type="text" name="msg"/>
        <input type="submit"/>
    </form>
</body>
</html>
*/ ?>

<!-- page75(フォームを利用する) -->
<?php /*
<html>
<head>
    <title>Hello/Index</title>
    <style>
    body {font-size:16pt; color: #999; }
    h1 {font-size:50pt; text-align:right; color: #f6f6f6; margin: -20px 0 -30px 0; letter-spacing: -4pt; }
    </style>
</head>
<body>
    <h1>Blade/Index</h1>
    @if ($msg != '')
    <p>こんにちは、{{$msg}}さん。</p>
    @else
    <p>何か書いてください。</p>
    @endif
    <form method="POST" action="/hello">
        {{ csrf_field() }}
        <input type="text" name="msg"/>
        <input type="submit"/>
    </form>
</body>
</html>
*/ ?>
<!-- page69(フォームを利用する) -->
<?php /*
<html>
<head>
    <title>Hello/Index</title>
    <style>
    body {font-size:16pt; color: #999; }
    h1 {font-size:50pt; text-align:right; color: #f6f6f6; margin: -20px 0 -30px 0; letter-spacing: -4pt; }
    </style>
</head>
<body>
    <h1>Blade/Index</h1>
    <p>{{$msg}}</p>
    <form method="POST" action="/hello">
        {{ csrf_field() }}
        <input type="text" name="msg"/>
        <input type="submit"/>
    </form>
</body>
</html>
*/ ?>

<!-- page68(Bladeテンプレートを使う) -->
<?php /*
<html>
<head>
    <title>Hello/Index</title>
    <style>
    body {font-size:16pt; color: #999; }
    h1 {font-size:50pt; text-align:right; color: #f6f6f6; margin: -20px 0 -30px 0; letter-spacing: -4pt; }
    </style>
</head>
<body>
    <h1>Blade/Index</h1>
    <p>{{$msg}}</p>
</body>
</html>
*/ ?>