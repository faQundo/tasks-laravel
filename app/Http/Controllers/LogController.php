<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Task;
use App\Models\User;
use App\Models\TaskLog;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'comment' => 'required|string',
            'taskId' => 'required',
        ]);
        try {
            $log = new Log();
            $log->comment = $request->comment;
            $log->date = Carbon::now()->format('Y-m-d');
            $log->save();

            $taskLog = new TaskLog();
            $taskLog->log()->associate($log);
            $taskLog->task()->associate($request->taskId);
            $taskLog->save();

            $title = 'Success!!!';
            $description = 'Log create succesfully';

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
        //
    }
}
