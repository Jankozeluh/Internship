@extends('layouts.master')
@section('title','Edit')
@section('content')
    <div class="container" style="width: 50%">
        <div class="row">
            <div class="col-sm">
                <form action="/students/{{$student->id}}" method="POST" class="px-4 py-3" style="text-align: center">
                    @csrf
                    @method('PUT')
                    <h4 style="text-align: center">EDIT</h4>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Degree</span>
                        <input type="text" name="degree" class="form-control" value="{{$student->degree}}">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">First name</span>
                        <input type="text" name="firstName" class="form-control" value="{{$student->firstName}}">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Last name</span>
                        <input type="text" name="lastName" class="form-control" value="{{$student->lastName}}">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Birth</span>
                        <input type="date" name="birth" class="form-control" value="{{$student->birth}}">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Enrollment</span>
                        <input type="date" name="enrollment" class="form-control" value="{{$student->enrollment}}">
                    </div>
                    <input type="submit" name="insert" class="btn btn-secondary" value="Edit this student"/>
                </form>
            </div>
        </div>
    </div>
@endsection
