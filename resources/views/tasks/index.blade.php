
@extends('layouts.app')
@section('heading')
    {{-- expr --}}
    <h1>welcome {{ $user->name }}</h1>
@endsection
@section('content')
  <div class="col-md-8 col-md-offset-2">
  <div class="alert_wrap">
     @if ($errors->count()>0)
  @include('alert.error')
@endif
   @if(Session::has('message'))
        @include('alert.success')
    @endif
  </div>


  <div class="pull-right">
          <!-- Button trigger modal -->
<a class="btn btn-primary" data-toggle="modal" data-target="#addNewTask">
  add new task
</a>

<!-- Modal Core -->
<div class="modal fade" id="addNewTask" tabindex="-1" role="dialog" aria-labelledby="addNewTaskLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn btn-primary pull-right 3x" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="addNewTaskLabel">Add new task</h4>
      </div>
      {!! Form::open(['action'=>'TaskController@store','method'=>'post','files' => true]) !!}
          <div class="modal-body">
                <div class="form-group col-md-6 {{ $errors->has('title') ? ' has-error' : '' }}">
               {!! Form::label('title','task title', []) !!}
                {!! Form::text('title',null, ['class'=>"form-control",'value'=>old('title')]) !!}
               </div>
                <div class="form-group col-md-6 {{ $errors->has('title') ? ' has-error' : '' }}">
               {!! Form::label('end date','task end date', []) !!}
                {!! Form::text('end_date',null, ['class'=>"form-control datepicker",'value'=>old('title')]) !!}
               </div>

              <div class="form-group col-md-12 {{ $errors->has('body') ? ' has-error' : '' }}">
                 {!! Form::label('body','task body', []) !!}
               {!! Form::textarea('body',null,['class'=>'form-control','value'=>old('body'),'rows'=>5]) !!}
             </div>
          </div>
          <div class="modal-footer">
            <div class="form-group col-md-12">
             {!! Form::submit('create', ['class'=>'btn btn-primary']) !!}
            {{--  <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Close</button> --}}
           </div>

          </div>
  


   
   

 {!! Form::close() !!}
  
    </div>
  </div>
</div>
  </div>
   <div class="panel">
     <div class="panel-heading">
       <h3>All tasks</h3>
     </div>
     <ul class="list-group">
      @if (count($tasks)>0)
        {{-- expr --}}
        @foreach ($tasks as $task)
          {{-- expr --}}
           <li class="list-group-item">
                      <span>
                        <a class="btn  btn-simple text-danger" class="" role="button" data-toggle="collapse" href="#body{{ $task->id }}" aria-expanded="false" aria-controls="collapseExample" title="Show The Description">{{ $task->title }}</a>
                      </span>
                        <div class="collapse" id="body{{ $task->id }}">
                          @if ($task->body)
                            <p>{{$task->body}}</p>
                            @else
                            <p  class="text-alert">There is no description</p>
                          @endif
                            
                        </div>


        <div class="pull-right">
          <a href="" class="btn btn-success" title=""><i class="fa fa-edit"></i></a>
          <a href="" class="btn btn-danger" title=""><i class="fa fa-trash-o"></i></a>
        </div>
           </li>
        @endforeach
      @else
      
       <li class="list-group-item">No task available! Add one now
      
       </li>
        @endif
                      
            
     </ul>
   </div>
  </div>




  </div>
@endsection
          