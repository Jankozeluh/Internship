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
                        <input type="text" name="degree" class="form-control" value="{{$subject->name}}">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Credits</span>
                        <input type="text" name="firstName" class="form-control" value="{{$subject->credits}}">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Garant</span>
                        <input type="text" name="lastName" class="form-control" value="{{$subject->lastName}}">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Birth</span>
                        <input type="date" name="birth" class="form-control" value="{{$teacher->birth}}">
                    </div>
                    <input type="submit" name="insert" class="btn btn-secondary" value="Edit this teacher" />
                </form>
            </div>
        </div>
    </div>
@endsection
