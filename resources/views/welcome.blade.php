  @php
  use Carbon\Carbon;
@endphp
@extends('layouts.app')
@section('heading')
    {{-- expr --}}
    <h1 class="text-primary">welcome to Laratask</h1>
     
      <div class="col-md-12" >
         <p class="text-info clock">
         {{-- {{ Carbon::now()->format('h:i:s') }} --}}
      </p>
      </div>
    
@endsection
@section('content')
  <div class="col-md-8 col-md-offset-2">

      <h3>

      
          What is Laratask?
      </h3>
      <p>Laratask is a simple todo App.Develop with Laravel.You can easily assign your task here</p>
   
 
</div>



  
@endsection
         