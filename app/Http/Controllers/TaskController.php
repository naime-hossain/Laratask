<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\User;
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
        $tasks=$user->tasks;
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
        $input=$request->all();
        $user=Auth::user();
        if ($request->title!=$task->title) {
            # code...
                  $user_task=$user->tasks()->whereTitle($request->title)->first();
            if ($user_task) {
                // session( ['message'=>'']);
                // $request->session()->forget('message');
                return back()->withErrors('This task already created Or TAsk is not Updated');
            }else{

                // $user->tasks()->whereId($id)->update($input);
                $task->update($input);
                return back()->with(['message'=>' task Updated']);

            }
        }else{
             // $user->tasks()->whereId($id)->update($input);
            $task->update($input);
            return back()->with(['message'=>' task Updated']); 
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
        //
        $task=Task::findOrFail($id);
        $task->delete();
        return back()->with(['message'=>' task Deleted']); 
    }
}
