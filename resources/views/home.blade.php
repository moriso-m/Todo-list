@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success row">
                <a href="#" class="close" data-toggle="alert">&times;</a>
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <h3 class="text-center">Todo List</h3>


            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Task title</th>
                        <th>Task description</th>
                        <th>Due date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>{{ $task->date_due }}</td>
                            <td>{{ $task->time_due }}</td>
                            <td>
                                @if ($task->completed)
                                    <span class="badge badge-pill badge-success">Completed</span>
                                @else
                                    <span class="badge badge-pill badge-warning">Not completed</span>
                                @endif
                            <td>
                                <a href="tasks/{{ $task->id }}/edit" class="btn btn-warning">Edit</a>
                                <a href="#" class="btn btn-danger" id="delete" onclick="deleteTask();">Delete</a>
                                {{--  mark task as completed  --}}
                                @if ($task->completed)
                                    <a href="/tasks/completed/{{ $task->id }}" class="btn btn-success disabled">
                                        Mark as completed
                                    </a>
                                @else
                                    <a href="/tasks/completed/{{ $task->id }}" class="btn btn-success">
                                        Mark as completed
                                    </a>
                                @endif

                                <form action="/tasks/{{ $task->id }}" method="post" id="delete-form">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function deleteTask(){
            let choice = confirm('Are you sure you want to delete the record');
            if(choice){
                document.getElementById('delete-form').submit();
            }
        }
    </script>
@endsection
