@php
  use Carbon\Carbon;
@endphp
@extends('layouts.app')
@section('heading')
    {{-- expr --}}
    <h1 class="text-primary">welcome to Laratask</h1>
    <p>The time is {{ Carbon::now()->format('h:i:s') }}</p>
@endsection
@section('content')
  <div class="col-md-8 col-md-offset-2">

      <h3>

      
          what is Laratask?
      </h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
      proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
 
</div>



  
@endsection
         