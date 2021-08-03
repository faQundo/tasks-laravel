<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
/* use Illuminate\Support\Facades\Auth; */

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* dd(Carbon::now()->format('Y-m-d') , Task::first()->date); */
        $data['users'] = User::all();
        $data['logs'] = Log::all();
        $data['tasksOverdue'] = Task::where([
                                    ['date','>=', Carbon::now()->format('Y-m-d')]
                                ])->paginate(25);
        $data['tasks'] = Task::where([
                            ['date', '<', Carbon::now()->format('Y-m-d')]
                        ])->paginate(25);
        return view('dashboard' , $data);
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
        $request->validate([
            'description' => 'required|string',
            'date' => 'required',
            'user_designated_id' => 'required',
        ]);
        try {
            $task = new Task();
            $task->description = $request->description;
            $task->date = $request->date;
            if($request->has('user_designated_id')){
                $task->designate()->associate($request->input('user_designated_id'));
            }
            $task->save();

            $title = 'Success!!!';
            $description = 'Task create succesfully';

            return redirect()->route('tasks.index')
                ->with('success',true)
                ->with('title', $title)
                ->with('description', $description);

        }catch (\Throwable $th) {
            return redirect()->route('tasks.index')
                             ->with([
                                 'destroy' => true,
                                 'description' => $th,
                                 ]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $task = Task::find($id);
            $task->delete();

            $title = 'Deleted!!!';
            $description = 'Task deleted succesfully';

            return redirect()->route('tasks.index')
                ->with('success',true)
                ->with('title', $title)
                ->with('description', $description);
        } catch (\Throwable $th) {
            return redirect()->route('tasks.index')
                             ->with([
                                 'destroy' => true,
                                 'description' => $th,
                                 ]);
        }
    }
}
