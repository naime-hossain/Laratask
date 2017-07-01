<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\User;
 use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TaskController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user=Auth::user();

        // $tasks=Task::whereUser_id($user->id)->get();
     $tasks=$user->tasks()->orderBy('end_date','asc')->paginate(10);
        return view('tasks.index',compact('user','tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
        'title'=>'required|max:30',
        'end_date'=>'required',
            ]);
        $input=$request->all();
        $user=Auth::user();
    // restrict user to add previus date
                    $now_y=trim(Carbon::now()->format('y'));
                    $now_m=trim(Carbon::now()->format('m'));
                    $now_d=trim(Carbon::now()->format('d'));
                    $end_y=trim(Carbon::parse($input['end_date'])->format('y'));
                    $end_m=trim(Carbon::parse($input['end_date'])->format('m'));
                    $end_d=trim(Carbon::parse($input['end_date'])->format('d'));

      if ($end_y<$now_y)
       {
           return back()->withErrors('You can not assign a task in previous year');                           
       }
       elseif($end_y>$now_y)
       {
         
       }
       else{
            if ($end_m<$now_m){
                return back()->withErrors('You can not assign a task in previous Month'); 
            }elseif($end_m==$now_m)
            {
                if ($end_d<$now_d) {
                    # code...
                     return back()->withErrors('You can not assign a task in previous day');
                }
            }else{

            }
       }
        //end of time restriction 



        $user_task=$user->tasks()->whereTitle($request->title)->first();
        if ($user_task) {
            // session( ['message'=>'']);
            // $request->session()->forget('message');
            return back()->withErrors('this task already created');
        }else{
            $user->tasks()->create($input);
            return back()->with(['message'=>'this task created']);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return redirect('/task')->with(['message'=>'nothing to show']);
        // throw new \Exception("Error Processing Request",1);
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $task=Task::findOrFail($id);
         $user=Auth::user();
         if ($task->user_id==$user->id) {
         $input=$request->all();

 // restrict user to add previus date
                    $now_y=trim(Carbon::now()->format('y'));
                    $now_m=trim(Carbon::now()->format('m'));
                    $now_d=trim(Carbon::now()->format('d'));
                    $end_y=trim(Carbon::parse($input['end_date'])->format('y'));
                    $end_m=trim(Carbon::parse($input['end_date'])->format('m'));
                    $end_d=trim(Carbon::parse($input['end_date'])->format('d'));

      if ($end_y<$now_y)
       {
           return back()->withErrors('You can not assign a task in previous year');                           
       }
       elseif($end_y>$now_y)
       {
         
       }
       else{
            if ($end_m<$now_m){
                return back()->withErrors('You can not assign a task in previous Month'); 
            }elseif($end_m==$now_m)
            {
                if ($end_d<$now_d) {
                    # code...
                     return back()->withErrors('You can not assign a task in previous day');
                }
            }else{

            }
       }
        //end of time restriction      
                
                //check if the title is changed or not
                if ($request->title!=$task->title) {
                    # if title change do this
                          $user_task=$user->tasks()->whereTitle($request->title)->first();
                    if ($user_task) {
                        // session( ['message'=>'']);
                        // $request->session()->forget('message');
                        return back()->withErrors('This task already created Or TAsk is not Updated');
                    }else{

                        $now=trim(Carbon::now()->format('m-d-y'));
                        $new_date=trim(Carbon::parse($input['end_date'])->format('m-d-y'));
                        if ($now!=$new_date) {
                          # code...
                          $input['is_late']=0;
                          
                        }
                        // $user->tasks()->whereId($id)->update($input);
                        $task->update($input);
                        return back()->with(['message'=>' task Updated']);

                    }
                }else{
                      //if title dont chage do this
                     // $user->tasks()->whereId($id)->update($input);
                        $now=trim(Carbon::now()->format('m-d-y'));
                        $new_date=trim(Carbon::parse($input['end_date'])->format('m-d-y'));
                        if ($now!=$new_date) {
                          # code...
                          $input['is_late']=0;
                          
                        }
                    $task->update($input);
                    return back()->with(['message'=>' task Updated']); 
                }
         }else{
            return redirect('/task')->with(['message'=>'This is not your task']);
         }
            
      
    }

      /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function done(Request $request, $id)
    {

        $task=Task::findOrFail($id);
        $user=Auth::user();
        if ($task->user_id==$user->id) {
          $input=$request->all();
          $task->is_complete=1;
          $task->save();
      return back()->with(['message'=>'TASK COMPLETED']);
         }else{
            return redirect('/task')->with(['message'=>'This is not your task']);
         }

         
      
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task=Task::findOrFail($id);
         $user=Auth::user();
           if ($task->user_id==$user->id) {
             $task->delete();
             return back()->with(['message'=>' task Deleted']); 
         }else{
            return redirect('/task')->with(['message'=>'This is not your task']);
         }

        
    }
}
