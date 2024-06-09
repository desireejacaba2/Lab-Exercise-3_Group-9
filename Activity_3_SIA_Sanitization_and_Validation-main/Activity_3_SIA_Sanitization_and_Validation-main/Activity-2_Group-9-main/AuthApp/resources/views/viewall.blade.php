@extends('layout.app')
@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<h2 class="dash-header">My Task | Things To Do</h2>
<table class="table container table-stripped">
  <thead>
    <tr>
      <th scope="col" class="table-heading">Task Name</th>
      <th scope="col" class="table-heading">Task Type</th>
      <th scope="col" class="table-heading">Description</th>
      <th scope="col" class="table-heading">Task Date</th>
      <th scope="col" class="table-heading">Actions</th> <!-- New column for actions -->
    </tr>
  </thead>
  <tbody>
    @foreach($tasks as $task) <!-- Renamed $task to $tasks -->
    <tr>
      <td>{{$task->task_name}}</td>
      <td>{{$task->task_type}}</td>
      <td>{{$task->description}}</td>
      <td>{{$task->task_date}}</td>
      <td>
     
        <!-- Delete Form -->
        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        
        <!-- Edit Form -->
        <form action="{{ route('tasks.edit', $task->id) }}" method="GET" style="display: inline;">
          @csrf
          <button type="submit" class="btn btn-primary">Edit</button>
        </form>
              
        <!-- Complete Form -->
        @if(!$task->completed)
          <form action="{{ route('tasks.complete', $task->id) }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-success">Mark as Complete</button>
          </form>
        @else
          <button type="button" class="btn btn-success" disabled>Completed</button>
        @endif
        
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

<div class="text-center">
  <a href="/maketask" class="mt-4 btn btn-info lower-btn">Create Task +</a>
</div>

@endsection