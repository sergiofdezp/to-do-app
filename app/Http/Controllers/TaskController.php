<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TaskRequest;

use App\Models\Task;

use Auth;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    public function index() : View
    {
        $user = Auth::user();
        $tasks = Task::where('user_id', $user->id)->where('status_id','<>', 3)->get();

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

    public function archive(Request $request, Task $task){
        $task_updated = $request->all();

        $task_updated = [
            'status_id' => 3,
        ];

        $task->update($task_updated);

        return redirect()->route('home')->with('success', 'La tarea ha sido archivada correctamente.');
    }

    // Cambia el estado del checkbox en la vista en la primera carga.
    public function check_task_status(Request $task_id) : JsonResponse
    {
        $task = $this->select_task($task_id);

        return response()->json([
            'success'=> true, 
            'status'=> $task->status_id
        ], 201);
    }

    // Cambia el estado de una tarea, de pendiente a terminada y viceversa.
    public function change_task_status(Request $task_id) : JsonResponse
    {
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

        return response()->json([
            'success'=> true, 
            'status'=> $task->status_id
        ], 200);
    }

    // Recibe un id y devuelve una tarea.
    public function select_task($task_id)
    {
        $task_id = $task_id->get('task_id');

        $task = Task::all()->where('id', $task_id)->first();

        return $task;
    }

    // Filtra las tareas según su estado.
    public function filter_tasks(Request $status_id) : JsonResponse
    {
        $status_id = $status_id->get('status_id');
        $user = Auth::user();

        if($status_id == 0){
            $tasks = Task::where('user_id', $user->id)->where('status_id','<>', 3)->get();
        } else{
            $tasks = Task::where('user_id', $user->id)->where('status_id', $status_id)->get();
        }

        return response()->json([
            'success'=> true, 
            'tasks' => $tasks
        ], 200);
    }
}