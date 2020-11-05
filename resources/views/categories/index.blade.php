@extends('layouts.app')
@section('content')
@if (session()->has('error'))
<div class="alert alert-danger">
    {{session()->get('error')}}
</div>
    
@endif
<div class="clearfix">
    <a href="{{route('categories.create')}}" class="btn btn-success float-right" style="margin-bottom:10px ">add category</a>
</div>
<div class="card card-default">
    <div class="card card-header">
    all categories
    </div>
    
    <table class="  card-body"> 
       
    <table class="table">
    <tbody>
        @foreach ($categories as $category)
        <tr>
           
          <td>{{$category->name}}</td>
          <td>
              <form action="{{route('categories.destroy',$category->id)}}" class="float-right" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm ml-2">delete</button>
            </form>
            <a href="{{route('categories.edit',$category->id)}}" class="btn btn-primary btn-sm float-right">Edit</a></td>
         
        </tr>
        @endforeach
    </tbody>

    </table> 
</table>
</div>
      
    
@endsection