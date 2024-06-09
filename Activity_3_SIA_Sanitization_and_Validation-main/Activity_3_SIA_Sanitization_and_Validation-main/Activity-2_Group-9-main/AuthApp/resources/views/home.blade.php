@extends('layout.app')

@section('content')
<div class="container">
    <!-- Welcome message with user's name -->
    <h1>Welcome, {{ Auth::user()->name }}</h1>

    <div class="contain">
        <h2 class="heading">Todo-List</h2>
        <form action="{{ route('tasks.store') }}" method="post">
            @csrf
            @if(session()->has('success'))
            <div class="alert alert-success" role="alert" x-data='{show:true}' x-init='setTimeout(()=>show=false,3000)' x-show='show'>
                <h5>{{ session('success') }}</h5>
            </div>
            @endif

            <div class="form-group">
                <label for="task_name">Task Name</label>
                @error('task_name')
                <h6 class="text-danger">{{ $message }}</h6>
                @enderror
                <input type="text" class="form-control" name="task_name" id="task_name">
            </div>

            <div class="form-group">
                <label for="task_type">Task Type</label>
                @error('task_type')
                <h6 class="text-danger">{{ $message }}</h6>
                @enderror
                <select name="task_type" class="form-control" id="task_type">
                    <option value="Everyday Task">Everyday Task</option>
                    <option value="Work Task">Work Task</option>
                    <option value="House Task">House Task</option>
                    <option value="Others">Others</option>
                </select>
            </div>

            <div class="form-group">
                <label for="task_date">Task Date</label>
                @error('task_date')
                <h6 class="text-danger">{{ $message }}</h6>
                @enderror
                <input type="date" class="form-control" name="task_date" id="task_date">
            </div>

            <div class="form-group">
                <label for="description">Task Description</label>
                @error('description')
                <h6 class="text-danger">{{ $message }}</h6>
                @enderror
                <textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
            </div>

            <button class="btn btn-dark mt-2" style="width:100%;">Submit Task</button>
        </form>
        <a href="{{ route('tasks.index') }}" class="btn btn-primary mt-2" style="width:100%;">View All Tasks</a>
    </div>
</div>
@endsection
