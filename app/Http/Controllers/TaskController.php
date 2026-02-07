<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
  public function index(Request $request)
{
    $query = auth()->user()->tasks();

    if ($request->status === 'completed') {
        $query->where('is_completed', 1);
    }

    if ($request->status === 'pending') {
        $query->where('is_completed', 0);
    }

    if ($request->sort === 'due_date') {
        $query->orderBy('due_date');
    }

    $tasks = $query->get();

    return view('tasks.index', compact('tasks'));
}


    public function create()
    {
        return view('tasks.create');
    }

    public function store(StoreTaskRequest $request)
    {
        Auth::user()->tasks()->create($request->validated());

        return redirect()->route('tasks.index')
            ->with('success', 'Task created successfully');
    }

    public function edit(Task $task)
    {
        $this->authorizeTask($task);
        return view('tasks.edit', compact('task'));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->authorizeTask($task);

        $task->update($request->validated());

        return redirect()->route('tasks.index')
            ->with('success', 'Task updated successfully');
    }

    public function destroy(Task $task)
    {
        $this->authorizeTask($task);
        $task->delete();

        return back()->with('success', 'Task deleted');
    }

    public function toggle(Task $task)
    {
        $this->authorizeTask($task);

        $task->update([
            'is_completed' => !$task->is_completed
        ]);

        return back()->with('success', 'Task status updated');
    }

    private function authorizeTask(Task $task)
    {
        abort_if($task->user_id !== Auth::id(), 403);
    }
}
