<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\task;

class TasksController extends Controller
{
    // getでmessages/にアクセスされた場合の「一覧表示処理」
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $tasklists = $user->tasklists()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'tasklist' => $tasklists,
            ];
        }

        return view('Task.index', $data);
    }
    // getでmessages/createにアクセスされた場合の「新規登録画面表示処理」
    public function create()
    {

        $task = new Task;

        return view('task.create', [
            'task' => $task,
        ]);
    }
    // postでmessages/にアクセスされた場合の「新規登録処理」
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:191'
        ]);

        $request->user()->tasklists()->create([
            'user_id' => \Auth::user()->id,
            'title' => $request->title,
            'content' => $request->content
        ]);

        return redirect('/');
    }
    // getでmessages/idにアクセスされた場合の「取得表示処理」
    public function show($id)
    {
        $task = task::find($id);
        if (\Auth::id() == $task->user_id) {

        return view('task.show', [
            'task' => $task,
        ]);
        } else {
            return redirect('/');
        }
    }
    // getでtask/id/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
        if (\Auth::id() == task::find($id)->user_id) {
        $task = task::find($id);

        return view('task.edit', [
            'task' => $task,
        ]);
        }else {
            return redirect('/');
        }
    }
    // putまたはpatchでtask/idにアクセスされた場合の「更新処理」
    public function update(Request $request, $id)
    {

        $Task = task::find($id);
        $Task->content = $request->content;
        $Task->save();

        return redirect('/');
    }
    // deleteでmessages/idにアクセスされた場合の「削除処理」
    public function destroy($id)
    {

        $tasklist = \App\Task::find($id);
                if (\Auth::id() === $tasklist->user_id) {
                    //ログインしてるユーザーIDとMicropostのユーザーIDが同じなら
                    $tasklist->delete();
                }

        return redirect('/');
    }
}
