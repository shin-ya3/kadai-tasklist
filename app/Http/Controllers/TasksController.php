<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data= [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);
            
            $data = [
                'user' => $user,
                'tasks' => $tasks,
                ];
               
        }
        
        return view('tasks.index', $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $task = new Task;
        
        return view('tasks.create', [
            'task' => $task,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|max:10',
            'content' => 'required|max:191',
        ]);
        
        
        $request->user()->tasks()->create([
            'status' => $request->status,
            'content' => $request->content,
        ]);
        
        
        return redirect('/tasks');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // そもそもログインしてなかったら、TOPにリダイレクト
        // ログインしたユーザが投稿したタスクのページだったら、
        // タスクを表示
        // そうじゃなかったら、TOPにリダイレクト
        if (\Auth::check()) {
            // ログインしているユーザを取得
            $user = \Auth::user();
            // 表示したいタスクを取得
            $task = Task::find($id);
            
            $userId = $user->id;
            $taskUserId = $task->user_id;

            // 表示したいタスクを作成したユーザのIDと、
            // ログインしているユーザのIDが等しいか確認
            if ($userId === $taskUserId) {
                

                $data = [
                    'task' => $task,
                ];
        
                return view('tasks.show', $data);

            } else {
                // TOPにリダイレクト
                return redirect('/');
            }
        } else {
            // ログインしてない場合TOPにリダイレクト
            return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (\Auth::check()) {
            $user = \Auth::user();
            $task = Task::find($id);
            
            $userId = $user->id;
            $taskUserId = $task->user_id;
        
            if ($userId === $taskUserId) {
                

                $data = [
                    'task' => $task,
                ];
        
                return view('tasks.edit', $data);

                } else {
                    return redirect('/');
                }
        } else {
                return redirect('/');
        }

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
        $this->validate($request, [
            'status' => 'required|max:10',
            'content' => 'required|max:191',
        ]);
        
        $task = Task::find($id);
        $task->status = $request->status;
        $task->content = $request->content;
        $task->save();
        
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        if (\Auth::check()) {
            $user = \Auth::user();
            $task = \App\Task::find($id);
            
            $userId = $user->id;
            $taskUserId = $task->user_id;
        
            if ($userId === $taskUserId) {
                

                $data = [
                    'task' => $task,
                ];
                
                 if (\Auth::id() === $task->user_id) {
                    $task->delete();
                   }
                   return redirect('/');

                } else {
                    return redirect('/');
                }
        } else {
                return redirect('/');
        }
    }
}