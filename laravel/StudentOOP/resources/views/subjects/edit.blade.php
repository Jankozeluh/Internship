@extends('layouts.master')
@section('title','Edit')
@section('content')
    <div class="container" style="width: 50%">
        <div class="row">
            <div class="col-sm">
                <form action="/subjects/{{$subject->id}}" method="POST" class="px-4 py-3" style="text-align: center">
                    @csrf
                    @method('PUT')
                    <h4 style="text-align: center">EDIT</h4>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Name</span>
                        <input type="text" name="name" class="form-control" value="{{$subject->name}}">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Credits</span>
                        <input type="number" name="credits" class="form-control" value="{{$subject->credits}}" >
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Semester</span>
                        <input type="number" name="semester" class="form-control" value="{{$subject->semester}}">
                    </div>
                    <input type="submit" name="edit" class="btn btn-secondary" value="Edit this subject" />
                </form>
            </div>
        </div>
    </div>
@endsection
