<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Jobs\DeleteCompletedTask;

class TaskController extends Controller
{
    public function index()
    {
        return Cache::tags('tasks')->remember('tasks.index', 60, function () {
            return Task::whereNull('deleted_at')->get();
        });
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'data_limite' => 'nullable|date',
        ]);

        $task = Task::create($data);
        Cache::tags('tasks')->flush();
        return response()->json($task, 201);
    }

    public function show(Task $task)
    {
        return Cache::tags('tasks')->remember("tasks.{$task->id}", 60, fn () => $task);
    }

    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'data_limite' => 'nullable|date',
        ]);

        $task->update($data);
        Cache::tags('tasks')->flush();
        return response()->json($task);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        Cache::tags('tasks')->flush();
        return response()->json(null, 204);
    }

    public function toggle(Task $task)
    {
        $task->update(['finalizado' => !$task->finalizado]);
        Cache::tags('tasks')->flush();

        if ($task->finalizado) {
            dispatch(new DeleteCompletedTask($task))->delay(now()->addMinutes(10));
        }

        return response()->json($task);
    }
}
