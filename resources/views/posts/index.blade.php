@extends('layouts.app')
@section('content')
<div class="clearfix">
    <a href="{{route('posts.create')}}" class="btn btn-success float-right" style="margin-bottom:10px ">add posts</a>
</div>
<div class="card card-default">
    <div class="card card-header">
    all posts
    </div>
    @if ($posts->count()> 0)
    <table class="table  card-body">
        <thead >
            <th >image</th>
            <th>title</th>
            <th >action</th>
        </thead>
    <tbody>
        @foreach ($posts as $post)
        <tr>
        <td><img src="{{asset('storage/'.$post->image)}}" alt="" width="100px" height="50px"></td>

          <td>{{$post->title}}</td>
          
          <td>
              <form action="{{route('posts.destroy',$post->id)}}" class="float-right" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm ml-2">
                    {{$post->trashed()?'delete': 'trash'}}
                </button>
            </form>
           @if (!$post->trashed())
           <a href="{{route('posts.edit',$post->id)}}" class="btn btn-primary btn-sm float-right">Edit</a>
           @else 
           <a href="{{route('trushed.restore',$post->id)}}" class="btn btn-primary btn-sm float-right">restore</a>
          
           @endif
        </td>
         
        </tr>
        @endforeach
    </tbody>

    </table> 
        
    @else
    <div class="card-body">
        <h1 class="text-center">no posts yet</h1>
    </div>
        
    @endif
    
       
  

</div>
      
    
@endsection