@extends('layouts.app')

@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>

    @endif
    <form action="/tasks" method="post">
        @csrf
        <div class="form-group col-md-4 offset-md-4">
            <label for="title">Title:</label>
            <input type="text" name="title" id="" class="form-control">
        </div>
        <div class="form-group col-md-4 offset-md-4">
            <label for="description">Description:</label>
            <textarea name="description" id="" class="form-control"></textarea>
        </div>
        <div class="form-group col-md-4 offset-md-4">
            <label for="date">Due on:</label>
            <input type="date" name="date" id="" class="form-control">
        </div>
        <div class="form-group col-md-4 offset-md-4">
            <label for="time">Time:</label>
            <input type="time" name="time" id="" class="form-control">
        </div>
        <button type="submit" class="btn btn-outline-success col-md-2 offset-5">
            Submit
        </button>
    </form>
@endsection
