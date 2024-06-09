
@extends('layout.app')
@section('content')

<div class="container">
    <div class="contain">
        <h2 class="heading">Edit Task</h2>
        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <label for="task_name">Task Name</label>
            <input type="text" class="form-control" id="task_name" name="task_name" value="{{ $task->task_name }}">
            
            <label for="task_type">Task Type</label>
            <select name="task_type" class="form-control">
                <option value="Everyday Task" {{ $task->task_type == 'Everyday Task' ? 'selected' : '' }}>Everyday Task</option>
                <option value="Work Task" {{ $task->task_type == 'Work Task' ? 'selected' : '' }}>Work Task</option>
                <option value="House Task" {{ $task->task_type == 'House Task' ? 'selected' : '' }}>House Task</option>
                <option value="Others" {{ $task->task_type == 'Others' ? 'selected' : '' }}>Others</option>
            </select>

            <label for="task_date">Task Date</label>
            <input type="date" class="form-control" id="task_date" name="task_date" value="{{ $task->task_date }}">

            <label for="description">Description</label>
            <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{ $task->description }}</textarea>
            
            <button class="btn btn-dark mt-2" style="width:100%;">Update Task</button>
        </form>
        <a href="/" class="btn btn-primary mt-2 " style="width:100%;"> View All Tasks</a>
    </div>
</div>

@endsection