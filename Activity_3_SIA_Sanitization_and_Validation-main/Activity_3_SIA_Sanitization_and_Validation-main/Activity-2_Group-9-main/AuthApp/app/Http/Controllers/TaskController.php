<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth; // Import Auth

class TaskController extends Controller
{
    // Display all tasks for the authenticated user
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->get(); // Only get tasks for the authenticated user
        return view('viewall', compact('tasks')); // Loading viewall.blade.php with tasks data
    }

    // Show the form for creating a new task
    public function create()
    {
        return view('maketask'); // Loading maketask.blade.php for creating a new task
    }

    // Store a new task
    public function store(Request $request)
    {
        $request->validate([
            'task_name' => 'required',
            'task_type' => 'required',
            'task_date' => 'required',
            'description' => 'required',
        ]); // Validating request data

        // Creating a new task with request data and associating it with the authenticated user
        Task::create([
            'task_name' => $request->task_name,
            'task_type' => $request->task_type,
            'task_date' => $request->task_date,
            'description' => $request->description,
            'completed' => $request->has('completed') ? $request->completed : false,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('tasks.index')->with('success', 'You have made a new task'); // Redirecting to tasks index page with success message
    }

    // Update the specified task
    public function update(Request $request, Task $task)
    {
        // Ensure the authenticated user is the owner of the task
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'You are not authorized to update this task');
        }

        $request->validate([
            'task_name' => 'required',
            'task_type' => 'required',
            'task_date' => 'required',
            'description' => 'required',
        ]); // Validating request data

        $task->update($request->all()); // Updating task with request data

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully'); // Redirecting to tasks index page with success message
    }

    // Delete the specified task
    public function destroy(Task $task)
    {
        // Ensure the authenticated user is the owner of the task
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'You are not authorized to delete this task');
        }

        $task->delete(); // Deleting the specified task
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully'); // Redirecting to tasks index page with success message
    }

    // Mark the specified task as completed
    public function complete(Task $task)
    {
        // Ensure the authenticated user is the owner of the task
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'You are not authorized to complete this task');
        }

        $task->update(['completed' => true]); // Marking the specified task as completed
        return redirect()->route('tasks.index')->with('success', 'Task marked as completed'); // Redirecting to tasks index page with success message
    }
    public function edit(Task $task) 
    {
        return view('edit', compact('task')); // Loading edit.blade.php with task data for editing
    }
}