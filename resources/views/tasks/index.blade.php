  @php
  use Carbon\Carbon;
  $i=1;
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
         <div class="panel-body">
         <ul class="list-group">
          @if (count($tasks)>0)
            {{-- expr --}}
            @foreach ($tasks as $task)
               
              {{-- start of single list item --}}
               <li class="list-group-item bg-success"  title="Click the title to see the description">
                     {{--  <span>
                        <a class="btn  btn-simple text-danger" class="" role="button" data-toggle="collapse" href="#body{{ $task->id }}" aria-expanded="false" aria-controls="collapseExample" title="Show The Description">{{ $task->title }}</a>
                      </span> --}}
                      <span>
                        <a class="btn  btn-simple" class="" role="button" data-toggle="popover" data-placement="@php
                          
                        
                         switch ($i) {
                           case 1:
                            echo 'top';
                             break;
                             case 2:
                              echo 'left';
                             break;
                             case 3:
                              echo 'right';
                             break;
                             case 4:
                             echo 'left';
                             break;

                           
                           default:
                             # code...
                             break;
                         }


                         @endphp" title="" data-content="{{ $task->body }}" data-container="body" data-original-title="Task Description" aria-describedby="popover{{ $task->id }}">{{ $task->title }}<div class="ripple-container"></div></a>
                      </span>

                     
                         
                      {{-- check if the task deadline is over or not  --}}
                      @php

                      $i++;
                      if ($i==5) {
                        $i=2;
                      }
                        $now=trim(Carbon::now()->format('d-m-y'));
                        $end_date=trim(Carbon::parse($task->end_date)->format('d-m-y'));

                        if ($now==$end_date) {
                          # code...
                          $task->is_late=1;
                          $task->save();
                        }
                         
                        // find out the reamining day
                        $now_y=trim(Carbon::now()->format('y'));
                        $now_m=trim(Carbon::now()->format('m'));
                        $now_d=trim(Carbon::now()->format('d'));
                        $end_y=trim(Carbon::parse($task->end_date)->format('y'));
                        $end_m=trim(Carbon::parse($task->end_date)->format('m'));
                        $end_d=trim(Carbon::parse($task->end_date)->format('d'));

                        $remaining_time='Remaining ';
                        $timeToAlert=0;
                        if ($end_y>$now_y) {
                          $y=$end_y-$now_y;
                          switch ($y) {
                            // if remaining year is equal than 1
                            case '1':

                              $r_m=((12-$now_m)+$end_m);
                              //if remaining month is greater than 12
                              if ($r_m>=12) {
                                $remaining_time.='1 year '.($r_m-12).' months';
                              }
                            //if remaining month is less than 12
                              else{
                                $remaining_time.=$r_m.' months';
                              }
                              
                              break;
                            // if remaining year is greated than 1
                            default:
                              $r_m=((12-$now_m)+$end_m);
                              //if remaining month is greater than 12
                              if ($r_m>=12) {
                                $remaining_time.=(($y+1)-1).' years '.($r_m-12).' months';
                              }
                            //if remaining month is less than 12
                              else{
                                $remaining_time.=($y-1).' years '.$r_m.' months';
                              }
                              break;
                          }
                          
                        }
                     //if the remaining year equal current year
                        else{
                              // calculate day and month if the end month is >=current mtnh and the end year is current year
                        if ($end_m>=$now_m) {
                          $r_m=$end_m-$now_m;
                          $r_d=$end_d-$now_d;
                          switch ($r_m) {
                            case '0':
                              $remaining_time.=$r_d . ' days';
                              // set alert
                              if ($r_d==1) {
                                $timeToAlert=1;
                              }
                              break;

                              case '1':
                               
                               if ($end_d>$now_d) {
                                  $remaining_time .=(30-$now_d)+($r_d).' days';
                                  // set alert
                                   if ((30-$now_d)+($r_d)==1) {
                                          $timeToAlert=1;
                                        }
                               }
                               if ($end_d<$now_d) {
                                 # code...
                                 $remaining_time .=(30-($now_d-$end_d)).' days';
                                  // set alert
                                   if ((30-($now_d-$end_d))==1) {
                                          $timeToAlert=1;
                                        }
                               }
                              break;
                                   case '2':
                               
                               if ($end_d>$now_d) {
                                  $remaining_time .= ($r_m-1).' month '.(30-$now_d)+($r_d).' days';
                               }
                               if ($end_d<$now_d) {
                                 # code...
                                 $remaining_time .= ($r_m-1).' month '.(30-($now_d-$end_d)).' days';
                               }
                              break;
                                   case '3':
                               
                               if ($end_d>$now_d) {
                                  $remaining_time .= ($r_m-1).' month '.(30-$now_d)+($r_d).' days';
                               }
                               if ($end_d<$now_d) {
                                 # code...
                                 $remaining_time .= ($r_m-1).' month '.(30-($now_d-$end_d)).' days';
                               }
                              break;
                                   case '4':
                               
                               if ($end_d>$now_d) {
                                  $remaining_time .= ($r_m-1).' month '.(30-$now_d)+($r_d).' days';
                               }
                               if ($end_d<$now_d) {
                                 # code...
                                 $remaining_time .= ($r_m-1).' month '.(30-($now_d-$end_d)).' days';
                               }
                              break;
                                   case '5':
                               
                               if ($end_d>$now_d) {
                                  $remaining_time .= ($r_m-1).' month '.(30-$now_d)+($r_d).' days';
                               }
                               if ($end_d<$now_d) {
                                 # code...
                                 $remaining_time .= ($r_m-1).' month '.(30-($now_d-$end_d)).' days';
                               }
                              break;
                                   case '6':
                               
                               if ($end_d>$now_d) {
                                  $remaining_time .= ($r_m-1).' month '.(30-$now_d)+($r_d).' days';
                               }
                               if ($end_d<$now_d) {
                                 # code...
                                 $remaining_time .= ($r_m-1).' month '.(30-($now_d-$end_d)).' days';
                               }
                              break;
                          
                                 case '7':
                               
                               if ($end_d>$now_d) {
                                  $remaining_time .= ($r_m-1).' month '.(30-$now_d)+($r_d).' days';
                               }
                               if ($end_d<$now_d) {
                                 # code...
                                 $remaining_time .= ($r_m-1).' month '.(30-($now_d-$end_d)).' days';
                               }
                              break;
                                   case '8':
                               
                               if ($end_d>$now_d) {
                                  $remaining_time .= ($r_m-1).' month '.(30-$now_d)+($r_d).' days';
                               }
                               if ($end_d<$now_d) {
                                 # code...
                                 $remaining_time .= ($r_m-1).' month '.(30-($now_d-$end_d)).' days';
                               }
                              break;
                                   case '9':
                               
                               if ($end_d>$now_d) {
                                  $remaining_time .= ($r_m-1).' month '.(30-$now_d)+($r_d).' days';
                               }
                               if ($end_d<$now_d) {
                                 # code...
                                 $remaining_time .= ($r_m-1).' month '.(30-($now_d-$end_d)).' days';
                               }
                              break;
                                   case '10':
                               
                               if ($end_d>$now_d) {
                                  $remaining_time .= ($r_m-1).' month '.(30-$now_d)+($r_d).' days';
                               }
                               if ($end_d<$now_d) {
                                 # code...
                                 $remaining_time .= ($r_m-1).' month '.(30-($now_d-$end_d)).' days';
                               }
                              break;
                                   case '11':
                               
                               if ($end_d>$now_d) {
                                  $remaining_time .= ($r_m-1).' month '.(30-$now_d)+($r_d).' days';
                               }
                               if ($end_d<$now_d) {
                                 # code...
                                 $remaining_time .= ($r_m-1).' month '.(30-($now_d-$end_d)).' days';
                               }
                              break;
                                   case '12':
                               
                               if ($end_d>$now_d) {
                                  $remaining_time .= ($r_m-1).' month '.(30-$now_d)+($r_d).' days';
                               }
                               if ($end_d<$now_d) {
                                 # code...
                                 $remaining_time .= ($r_m-1).' month '.(30-($now_d-$end_d)).' days';
                               }
                              break;
                            default:
                              # code...
                              break;
                          }
                          
                        }
                        }

                   
                      @endphp


                     {{--all buttons  --}}
                <div class="pull-right">
            {{--  <a class="btn-danger">
               {{ Carbon::parse($task->end_date)->diffForHumans() }}
             </a> --}}
                      {{-- Check if it is complete or not --}}
                       @if (!$task->is_complete)
                             {{-- show alert button --}}
                             @if (!$task->is_late)
                               @if ($timeToAlert)
                              <span class="btn btn-danger" 
                            title="" data-toggle="tooltip" data-placement="top" data-container="body" data-original-title="Complete the task quickly">
                            1 day to live
                            </span>
                               @endif
                             @endif
                          {{-- check if the task has deadline or not --}}
                          @if ($task->end_date)
                          {{-- check if the task is late or not --}}
                          
                          @php
                          //find the if the remaining time is negetive or not
                            $timeIsOver=str_replace('Remaining','',$remaining_time);
                            $timeIsOver=str_replace('days','',$timeIsOver);

                          @endphp
                            <span class="btn {{$timeIsOver<0||$task->is_late?'btn-danger':'' }}{{ $timeToAlert?'btn-warning':''}}" 
                            title="" data-toggle="tooltip" data-placement="top" data-container="body" data-original-title="{{ $remaining_time }}">
                            {{ $task->is_late||$timeIsOver<0?'Task Delayed':$end_date }}
                            </span>
                            {{-- counter --}}
                         {{-- <span class="remaining_clock"></span>
                            @section('footer')
                              <script type="text/javascript">
                          var days="{{ $timeIsOver }}";
                          var clock = $('.remaining_clock').FlipClock(3600 * 24 * days, {
                            clockFace: 'DailyCounter',
                            countdown: true
                          });
                          </script>
                            @endsection --}}
                         
                       
                         {{--    {{Carbon::now()->format('m-d-y')}} --}}
                       {{--   <button type="button" class="btn btn-default btn-tooltip" data-toggle="tooltip" data-placement="left" title="" data-container="body" data-original-title="Tooltip on left">On left</button> --}}
                          @endif


                          {{-- done button --}}
                          <span href="" data-toggle="modal" data-target="#donetask{{ $task->id }}" class="btn btn-info" title="">done</span>

                          {{-- edit button --}}
                          <span href="" data-toggle="modal" data-target="#editTask{{ $task->id }}" class="btn btn-success" title=""><i class="fa fa-edit"></i></span>
                             @else
                             <span class="btn btn-success text-center">Task Completed</span>
                       @endif
                         
                    <span href="" data-toggle="modal" data-target="#deletetask{{ $task->id }}" class="btn btn-danger" title="">Remove</span>
            
                </div>

                {{-- show the task body if exist --}}
             {{--     <div class="collapse" id="body{{ $task->id }}">

                    @if ($task->body)
                      <p>{{$task->body}}</p>
                      @else
                      <p  class="text-alert">There is no description</p>
                    @endif
                              
                </div> --}}
        </li>
{{-- end of single list item --}}









              {{-- All Modals are here --}}

                <!-- deletetask Modal Core -->
          <div class="modal fade" id="deletetask{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="deletetask{{ $task->id }}Label" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                
                  <h4 class="modal-title text-center" id="deletetask{{ $task->id }}Label">Want to remove The task?</h4>
                <div class="modal-body">
                    <button type="button" class="btn btn-primary pull-right 3x" data-dismiss="modal" aria-hidden="true">No</button>
                  {!! Form::open(['action'=>['TaskController@destroy',$task->id],'method'=>'delete','class'=>'sm-form']) !!}
                    {!! Form::button("Yes",
                     [
                     'class'=>'btn btn-danger',
                   
                     'type'=>'submit'
                     ]) !!}
                    

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
                    <button type="button" class="btn btn-primary pull-right 3x" data-dismiss="modal" aria-hidden="true">No</button>
                    {!! Form::open(['action'=>['TaskController@done',$task->id],'method'=>'put','class'=>'sm-form pull-right']) !!}
                        {!! Form::button("Yes",
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

            {{-- end of foreach --}}


          @else
          
           <li class="list-group-item">No task available! Add one now
          
           </li>
            @endif
                          
                
         </ul>
       </div>
       <div class="panel-footer">
         {{ $tasks->links() }}
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
          