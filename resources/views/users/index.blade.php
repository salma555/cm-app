@extends('layouts.app')
@section('content')

<div class="card card-default">
    <div class="card card-header">
    all users
    </div>
    @if ($users->count()> 0)
    <table class="table  card-body">
        <thead >
            <th >image</th>
            <th>username</th>
            <th >role</th>
        </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td><img src="{{$user->getgravatar()}}" alt="" style="border-radius: 50%; width=100px; height=50px;  "></td>

          <td>{{$user->name}}</td>
          <td>
              @if (!$user->isadmin())
                <form action="{{route('users.make-admin',$user->id)}}" method="POST" >
                      @csrf
                <button class="btn btn-success" type="submit"> make admin</button>
                </form>  
              @else
              {{$user->role}}   
              @endif
          </td>
          
           
         
        </tr>
        @endforeach
    </tbody>

    </table> 
        
    @else
    <div class="card-body">
        <h1 class="text-center">no users yet</h1>
    </div>
        
    @endif
    
       
  

</div>
      
    
@endsection