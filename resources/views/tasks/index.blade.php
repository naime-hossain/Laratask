  @php
  use Carbon\Carbon;
@endphp
@extends('layouts.app')
@section('heading')
    {{-- expr --}}
    <h1>welcome {{ $user->name }}</h1>
@endsection
@section('content')
  <div class="col-md-12 ">
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
  </div>
   <div class="panel">
     <div class="panel-heading">
       <h3 class="text-primary">All tasks</h3>
     </div>
     <ul class="list-group">
      @if (count($tasks)>0)
        {{-- expr --}}
        @foreach ($tasks as $task)
          {{-- expr --}}
           <li class="list-group-item bg-success">
                      <span>
                        <a class="btn  btn-simple text-danger" class="" role="button" data-toggle="collapse" href="#body{{ $task->id }}" aria-expanded="false" aria-controls="collapseExample" title="Show The Description">{{ $task->title }}</a>
                      </span>
                 

              @php
               $now=trim(Carbon::now()->format('m-d-y'));
                $end_date=trim(Carbon::parse($task->end_date)->format('m-d-y'));
                if ($now==$end_date) {
                  # code...
                  $task->is_late=1;
                  $task->save();
                }
              @endphp
             
        <div class="pull-right">
        {{-- Check if it is complete or not --}}
         @if (!$task->is_complete)
                  @if ($task->end_date)
                  <span class="btn {{$task->is_late?'btn-danger':'' }}" 
                    title="deadline">{{ $task->is_late?'Task Delayed':$end_date }}</span>
                 {{--    {{Carbon::now()->format('m-d-y')}} --}}
                  @endif
            {{-- done button --}}
                    <a href="" data-toggle="modal" data-target="#donetask{{ $task->id }}" class="btn btn-info" title="">done</a>
                    <a href="" data-toggle="modal" data-target="#editTask{{ $task->id }}" class="btn btn-success" title=""><i class="fa fa-edit"></i></a>
               @else
               <span class="btn btn-success text-center">Task Completed</span>
         @endif
           
      <a href="" data-toggle="modal" data-target="#deletetask{{ $task->id }}" class="btn btn-info" title="">Remove</a>
    
        </div>
               <div class="collapse" id="body{{ $task->id }}">
                          @if ($task->body)
                            <p>{{$task->body}}</p>
                            @else
                            <p  class="text-alert">There is no description</p>
                          @endif
                            
              </div>
           </li>










          {{-- All Modals are here --}}

            <!-- deletetask Modal Core -->
      <div class="modal fade" id="deletetask{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="deletetask{{ $task->id }}Label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
            
              <h4 class="modal-title text-center" id="deletetask{{ $task->id }}Label">Want to remove The task?</h4>
            <div class="modal-body">
                <button type="button" class="btn btn-primary pull-right 3x" data-dismiss="modal" aria-hidden="true">cancel</button>
              {!! Form::open(['action'=>['TaskController@destroy',$task->id],'method'=>'delete','class'=>'sm-form']) !!}
                {!! Form::button("<i class='fa fa-trash-o'></i>",
                 [
                 'class'=>'btn btn-danger',
               
                 'type'=>'submit'
                 ]) !!}
                

          {!! Form::close() !!}
                    

              {!! Form::close() !!}
          </div>
            </div>
        
          </div>
        </div>
      </div>
{{-- model end --}}
           <!-- donetask Modal Core -->
      <div class="modal fade" id="donetask{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="donetask{{ $task->id }}Label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
            
              <h4 class="modal-title text-center" id="donetask{{ $task->id }}Label">Is It complete?</h4>
            <div class="modal-body">
                <button type="button" class="btn btn-primary pull-right 3x" data-dismiss="modal" aria-hidden="true">cancel</button>
                {!! Form::open(['action'=>['TaskController@done',$task->id],'method'=>'put','class'=>'sm-form pull-right']) !!}
                    {!! Form::button("done",
                     [
                     'class'=>'btn btn-info',
                     
                     'type'=>'submit'
                     ]) !!}
                    

              {!! Form::close() !!}
          </div>
            </div>
        
          </div>
        </div>
      </div>
{{-- model end --}}
                <!-- editTask Modal Core -->
      <div class="modal fade" id="editTask{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="editTask{{ $task->id }}Label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="btn btn-primary pull-right 3x" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="editTask{{ $task->id }}Label">edit task </h4>
            </div>
            {!! Form::model($task,['action'=>['TaskController@update',$task->id],'method'=>'put']) !!}
                <div class="modal-body">
                      <div class="form-group col-md-6 {{ $errors->has('title') ? ' has-error' : '' }}">
                     {!! Form::label('title','task title', []) !!}
                      {!! Form::text('title',null, ['class'=>"form-control"]) !!}
                     </div>
                      <div class="form-group col-md-6 {{ $errors->has('title') ? ' has-error' : '' }}">
                     {!! Form::label('end date','task end date', []) !!}
                      {!! Form::text('end_date',null, ['class'=>"form-control datepicker"]) !!}
                     </div>

                    <div class="form-group col-md-12 {{ $errors->has('body') ? ' has-error' : '' }}">
                       {!! Form::label('body','task body', []) !!}
                     {!! Form::textarea('body',null,['class'=>'form-control','rows'=>5]) !!}
                   </div>
                </div>
                <div class="modal-footer">
                  <div class="form-group col-md-12">
                   {!! Form::submit('update', ['class'=>'btn btn-primary']) !!}
                  {{--  <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Close</button> --}}
                 </div>

                </div>
        
         

       {!! Form::close() !!}
        
          </div>
        </div>
      </div>
{{-- model end --}}
        @endforeach
      @else
      
       <li class="list-group-item">No task available! Add one now
      
       </li>
        @endif
                      
            
     </ul>
   </div>
  </div>

{{-- add new modal --}}

<!-- addNewTask Modal Core -->
<div class="modal fade" id="addNewTask" tabindex="-1" role="dialog" aria-labelledby="addNewTaskLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn btn-primary pull-right 3x" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="addNewTaskLabel">Add new task</h4>
      </div>
      {!! Form::open(['action'=>'TaskController@store','method'=>'post']) !!}
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
{{-- model end --}}


  </div>
@endsection
          