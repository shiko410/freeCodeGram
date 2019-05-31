@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="https://s3.amazonaws.com/freecodecamp/curriculum-diagram-full.jpg" style="height:80px;" class="rounded-circle">
        </div>
        <div class="col-9 pt-5">
            <div><h1>{{ $info->username }}</h1></div>
            <div class="d-flex">
                <div class="pr-4"><strong>1234</strong> posts</div>
                <div class="pr-4"><strong>1234</strong> followers</div>
                <div class="pr-4"><strong>1324</strong> following</div>
            </div>
            <div class="pt-4 font-weight-bold">{{ $info->profile->title }}</div>
            <div>{{ $info->profile->description }}</div>
            <div><a href="#">{{ $info->profile->url ?? 'N/A'}}</a></div>
        </div>
    </div>
    
    <div class="row ">
        <div class="col-4 pt-4">
            <img src="https://s3.amazonaws.com/freecodecamp/curriculum-diagram-full.jpg" class="w-100">
        </div>
        <div class="col-4 pt-4">
            <img src="https://s3.amazonaws.com/freecodecamp/curriculum-diagram-full.jpg" class="w-100">
        </div>
        <div class="col-4 pt-4">
            <img src="https://s3.amazonaws.com/freecodecamp/curriculum-diagram-full.jpg" class="w-100">
        </div>
    </div>
</div>
@endsection
