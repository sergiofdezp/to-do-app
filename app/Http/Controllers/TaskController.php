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
        $user = Auth::user();
        $tasks = Task::all()->where('user_id', $user->id);

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

    // Cambia el estado del checkbox en la vista en la primera carga.
    public function check_task_status(Request $task_id){
        $task = $this->select_task($task_id);

        return response()->json(['success'=> true, 'status'=> $task->status_id]);
    }

    // Cambia el estado de una tarea, de pendiente a terminada y viceversa.
    public function change_task_status(Request $task_id){
        $task = $this->select_task($task_id);

        // Evalua el estado actual de la tarea para despues cambiarlo.
        if($task->status_id == 1){
            $task->status_id = 2;
        } else if($task->status_id == 2){
            $task->status_id = 1;
        }

        $new_task_status = [
            'status_id' => $task->status_id,
        ];

        $task->update($new_task_status);

        return response()->json(['success'=> true, 'status'=> $task->status_id]);
    }

    // Recibe un id y devuelve una tarea.
    public function select_task($task_id){
        $task_id = $task_id->get('task_id');

        $task = Task::all()->where('id', $task_id)->first();

        return $task;
    }
}