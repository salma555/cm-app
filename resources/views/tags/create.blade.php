@extends('layouts.app')
@section('content')
<div class="card card-default">
    <div class="card card-header">
    {{isset($tag)? "update tag":"add new tag"}}
    </div>
    <div class="card card-body">
        <form action="{{isset($tag) ? route('tags.update',$tag->id): route('tags.store')}}" method="POST">
            @csrf
           @if (isset ($tag))
           @method('PUT')               
           @endif
            <div class="form-group">
                <label for="tag"> create new tag:</label>
                <input type="text" class="form-control @error('name')is-invalid @enderror" name="name" placeholder="add new tag" value="{{isset($tag)? $tag->name: ""}}">
                @error('name')
                <div class="alert alert-danger">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <button class="btn btn-success">
                    {{isset($tag)? "update":"add"}}
                </button>
            </div>
        </form>
    </div>
</div>



    
@endsection