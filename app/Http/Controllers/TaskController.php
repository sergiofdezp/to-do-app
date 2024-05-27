<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TaskRequest;

use App\Models\Task;

use Auth;

class TaskController extends Controller
{
    public function index() : View
    {
        $tasks = Task::all();

        return view("home", compact("tasks"));
    }

    public function create() : View
    {
        return view('tasks.create');
    }

    public function store(TaskRequest $request) : RedirectResponse
    {
        $user = Auth::user();
        $new_task = $request->all();

        $new_task = [
            'title' => $request->title,
            'description' => $request->description,
            'status_id' => 1,
            'user_id' => $user->id,
        ];

        Task::create($new_task);

        return redirect()->route('home')->with('success', $new_task['title'] .' ha sido creada correctamente.');
    }

    public function show(string $id)
    {
        //
    }

    public function update(TaskRequest $request, Task $task) : RedirectResponse
    {
        $task_updated = $request->all();
        $task->update($task_updated);

        return redirect()->route('home')->with('success', 'La tarea: '. $task_updated['title'] .' ha sido editada correctamente.');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        
        return redirect()->route('home')->with('success', 'La tarea: '. $task->title .' ha sido eliminada correctamente.');
    }
}
