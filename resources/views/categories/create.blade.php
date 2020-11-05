@extends('layouts.app')
@section('content')
<div class="card card-default">
    <div class="card card-header">
    {{isset($category)? "update category":"add new category"}}
    </div>
    <div class="card card-body">
        <form action="{{isset($category) ? route('categories.update',$category->id): route('categories.store')}}" method="POST">
            @csrf
           @if (isset ($category))
           @method('PUT')               
           @endif
            <div class="form-group">
                <label for="category"> create new category:</label>
                <input type="text" class="form-control @error('name')is-invalid @enderror" name="name" placeholder="add new category" value="{{isset($category)? $category->name: ""}}">
                @error('name')
                <div class="alert alert-danger">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <button class="btn btn-success">
                    {{isset($category)? "update":"add"}}
                </button>
            </div>
        </form>
    </div>
</div>



    
@endsection