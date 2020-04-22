<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\task;

class TasksController extends Controller
{
    // getでmessages/にアクセスされた場合の「一覧表示処理」
    public function index()
    {

        $task = task::all();
        return view('task.index', [
            'task' => $task,
        ]);
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

        $Task = new Task;
        $Task->content = $request->content;
        $Task->save();

        return redirect('/');
    }
    // getでmessages/idにアクセスされた場合の「取得表示処理」
    public function show($id)
    {

        $task = task::find($id);

        return view('task.show', [
            'task' => $task,
        ]);
    }
    // getでmessages/id/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {

        $task = task::find($id);

        return view('task.edit', [
            'task' => $task,
        ]);
    }
    // putまたはpatchでmessages/idにアクセスされた場合の「更新処理」
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

        $Task = task::find($id);
        $Task->delete();

        return redirect('/');
    }
}
