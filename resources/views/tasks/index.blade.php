
@extends('layouts.app')
@section('heading')
    {{-- expr --}}
    <h1>welcome {{ $user->name }}</h1>
@endsection
@section('content')
  <div class="col-md-8 col-md-offset-2">
   <div class="panel">
     <div class="panel-heading">
       <h3>All tasks</h3>
     </div>
     <ul class="list-group">
      @if (count($tasks)>0)
        {{-- expr --}}
        @foreach ($tasks as $task)
          {{-- expr --}}
           <li class="list-group-item">{{ $task->title }}</li>
        @endforeach
      @else
      
       <li class="list-group-item">No task available! Add one now</li>
        @endif
      
     </ul>
   </div>
  </div>




  </div>
@endsection
          