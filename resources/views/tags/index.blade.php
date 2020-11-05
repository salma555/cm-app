@extends('layouts.app')
@section('content')
@if (session()->has('error'))
<div class="alert alert-danger">
    {{session()->get('error')}}
</div>
    
@endif
<div class="clearfix">
    <a href="{{route('tags.create')}}" class="btn btn-success float-right" style="margin-bottom:10px ">add tag</a>
</div>
<div class="card card-default">
    <div class="card card-header">
    all tags
    </div>
    
    <table class="  card-body"> 
       
    <table class="table">
    <tbody>
        @foreach ($tags as $tag)
        <tr>
           
          <td>{{$tag->name}} <span class="badge badge-dark ml-2">{{$tag->posts->count()}} </td>
          <td>
              <form action="{{route('tags.destroy',$tag->id)}}" class="float-right" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm ml-2">delete</button>
            </form>
            <a href="{{route('tags.edit',$tag->id)}}" class="btn btn-primary btn-sm float-right">Edit</a></td>
         
        </tr>
        @endforeach
    </tbody>

    </table> 
</table>
</div>
      
    
@endsection