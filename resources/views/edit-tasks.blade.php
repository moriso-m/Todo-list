@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors }}
        </div>
    @endif
    <form action="/tasks/{{ $task->id }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group col-md-4 offset-md-4">
            <label for="title">Title:</label>
            <input type="text" name="title" id="" class="form-control" value="{{ $task->title }}">
        </div>
        <div class="form-group col-md-4 offset-md-4">
            <label for="description">Description:</label>
            <textarea name="description" id="" class="form-control">
                {{ $task->description }}
            </textarea>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2 offset-md-4">
                <label for="date">Due on:</label>
                <input type="date" name="date" id="" class="form-control" value="{{ $task->date }}">
            </div>
            <div class="form-group col-md-2">
                <label for="time">Time:</label>
                <input type="time" name="time" id="" class="form-control" value="{{ $task->time }}">
            </div>
        </div>
        <div class="form-group col-md-4 offset-md-4 row">
            <input type="checkbox" name="completed" id="" class="form-control col-md-2 offset-md-4"
            @if ($task->completed)
                checked
            @endif
            >
            <label for="completed" class="col-md-2">Status:</label>
        </div>
        <button type="submit" class="btn btn-outline-success col-md-2 offset-5">
            Edit
        </button>
    </form>
@endsection
