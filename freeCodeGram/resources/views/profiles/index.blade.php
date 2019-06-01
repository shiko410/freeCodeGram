@extends('layouts.app')

@section('content')
<div class="container">
    <!-- ユーザー情報 -->
    <div class="row">
        <div class="col-3 p-5">
            <img src="https://s3.amazonaws.com/freecodecamp/curriculum-diagram-full.jpg" style="height:80px;" class="rounded-circle">
        </div>
        <div class="col-9">
            <div class="d-flex justify-content-between align-items-baseline">
                <h1>{{ $user->username }}</h1>
                <a href="/p/create">Add New Post</a>
            </div>
                <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
            <div class="d-flex">
                <div class="pr-5"><strong>{{$user->posts->count() }}</strong> posts</div>
                <div class="pr-5"><strong>222</strong> followers</div>
                <div class="pr-5"><strong>333</strong> following</div>
            </div>
            <div class="pt-4 font-weight-bold">{{ $user->profile->title }}</div>
            <div class="">{{ $user->profile->description }}</div>
            <div class=""><a href="#">{{ $user->profile->url }}</a></div>
        </div>
    </div>
    
    <!-- 投稿部分 -->
    <div class="row pt-5">
        @foreach($user->posts as $post)
        
            <div class="col-4 pb-4">
                <a href="/p/{{ $post->id }}">
                    <img 
                    src="/storage/{{ $post->image }}" class="w-100"
                    alt="pic{{ $post->id }}"
                    >
                </a>
            </div>        
        
        @endforeach
        
       
    </div>
    
</div>
@endsection
