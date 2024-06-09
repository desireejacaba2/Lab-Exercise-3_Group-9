@extends('layout.app')
@section('content')

<div class="container">
    <div class="contain">
        <h2 class="heading">Todo-List</h2>
        <form action="store" method="post">
            @csrf
            @if(session()->has('success'))
            <div class="alert alert-success" role="alert" x-data='{show:true}' x-init='setTimeout(()=>show=false,3000)' x-show='show'>
                <h5>
                    {{ session('') }}
                </h5>
            </div>
            @endif

            <label for="task_name">Task Name</label>
            @error('task_name')
            <h6 class="text-danger">{{ $message }}</h6>
            @enderror
            <input type="text" class="form-control" name="task_name">

            <label for="task_type">Task Type</label>
            @error('task_type')
            <h6 class="text-danger">{{ $message }}</h6>
            @enderror
            <select name="task_type" class="form-control">
                <option value="Everyday Task">Everyday Task</option>
                <option value="Work Task">Work Task</option>
                <option value="House Task">House Task</option>
                <option value="Others">Others</option>
            </select>

            <label for="task_date">Task Date</label>
            @error('task_date')
            <h6 class="text-danger">{{ $message }}</h6>
            @enderror
            <input type="date" class="form-control" name="task_date">

            <label for="">Task Description</label>
    @error('task_description')
    <h6 class="text-danger">{{$message}}</h6>
    @enderror
            <textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
            <button class="btn btn-dark mt-2" style="width:100%;">Submit Task</button>
        </form>
        <a href="/" class="btn btn-primary mt-2 " style="width:100%;"> View All Tasks</a>
    </div>
</div>
@endsection