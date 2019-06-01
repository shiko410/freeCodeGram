@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/profile/{{ $user->id }}" enctype="multipart/form-data" method="post">
        @csrf
        @method('PATCH')
        
        <div class="row">
            <div class="col-8 offset-2">
                <div class="row">
                    <h1>Edie Profile</h1>
                </div>
                
                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label">Title</label>
        
                    <input 
                    id="title" 
                    type="caption" 
                    class="form-control @error('title') is-invalid @enderror" 
                    name="title" 
                    value="{{ old('title') }}" 
                    autocomplete="title"
                    >
        
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label">Description</label>
        
                    <input 
                    id="description" 
                    type="description" 
                    class="form-control @error('description') is-invalid @enderror" 
                    name="description" 
                    value="{{ old('description') }}" 
                    autocomplete="description"
                    >
        
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-group row">
                    <label for="url" class="col-md-4 col-form-label">url</label>
        
                    <input 
                    id="url" 
                    type="url" 
                    class="form-control @error('url') is-invalid @enderror" 
                    name="url" 
                    value="{{ old('url') }}" 
                    autocomplete="url"
                    >
        
                    @error('url')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="row">
                    <label for="image" class="col-md-4 col-form-label">Profile Image</label>
                    
                    <input type="file" class="form-control-file" id="image" name="image"/>
                    
                    @error('image')
                            <strong>{{ $message }}</strong>
                    @enderror
                </div>
                
                <div class="row pt-4">
                    <button class="btn btn-primary">Save Profile</button>
                </div>
            </div>
        </div>
    </form>

</div>
@endsection
