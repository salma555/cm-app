@extends('layouts.app')
@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

@endsection
@section('content')
<div class="card card-default">
    <div class="card card-header">
     {{ isset ($post)? "edit post" :"add a new post"}}
    </div>
    <div class="card card-body">
        <form action="{{ isset($post)? route('posts.update',$post->id): route('posts.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset ($post))
            @method('PUT') 
            @endif
           
            <div class="form-group">
                <label for="post title">  title:</label>
            <input type="text"  name="title" placeholder="add new post" class="form-control" value="{{isset($post)? $post->title : ""}}">
               
            </div>
            <div class="form-group">
                <label for=" post description">  description:</label>
                <textarea   rows="2" name="description" placeholder="add new description" class="form-control"  >{{isset($post)? $post->description: ""}}
                </textarea>
               
            </div>
            <div class="form-group">
                <label for="post content">  content:</label>
              <!--  <textarea rows="3"  name="content" placeholder="add new content" class="form-control">
                </textarea> -->
                <input id="x" type="hidden" name="content"   value="{{isset($post)? $post->content: ""}}" >
                <trix-editor input="x"></trix-editor>
            </div>
           @if (isset($post))
           <div class="form-group">
            <img src="{{asset('storage/' . $post->image)}}" style="width: 100%;" alt="">
            </div>
           @endif
            <div class="form-group">
                <label for="post image"> image:</label>
                <input type="file" class="form-control" name="image"   value="{{isset($post)? $post->image: ""}}">
               
            </div>
            
             <div class="form-group">
    <label for="selectcategory">select category</label>
    <select class="form-control" name="categoryid">
    
     @foreach ($categories as $category)
    <option value="{{$category->id}}">{{$category->name}}</option>
     @endforeach
    </select>
  </div>
   
  @if (!$tags->count() <= 0)
  <div class="form-group">
    <label for="selecttag">select tag</label>
    <select class="form-control js-example-basic-multiple" name="tags[]" multiple>
    
     @foreach ($tags as $tag)
    <option value="{{$tag->id}}"
         @if ($post->hastag($tag->id))
        selected
    @endif
        >{{$tag->name}}</option>
     @endforeach
    </select>
  </div>
      
  @endif

            
            <div class="form-group">
                <button typ="submit" class="btn btn-success">
                    {{ isset ($post)? "update" :"add"}}
                </button>
            </div>
        </form>
    </div>
</div>



    
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script>
 $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>
@endsection