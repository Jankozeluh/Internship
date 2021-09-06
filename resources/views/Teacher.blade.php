@extends('layouts.master')
@section('title','Teachers')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <form method="POST" class="px-4 py-3"  style="text-align: center">
                    @csrf
                    <h4 style="text-align: center">INSERT</h4>
                    <div class="input-group input-group-sm mb-3" >
                        <span class="input-group-text">Degree</span>
                        <input type="text" class="form-control" name="degree" required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">First name</span>
                        <input type="text" class="form-control" name="firstName" required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Last name</span>
                        <input type="text" class="form-control" name="lastName" required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Birth</span>
                        <input type="date" class="form-control" name="birth" required>
                    </div>
                    <input type="submit" name="insert" class="btn btn-secondary" value="Submit new teacher" />
                </form>
            </div>
            <div class="col-sm">
                <form method="POST" class="px-4 py-3" style="text-align: center">
                    @csrf
                    <h4 style="text-align: center">INSERT SUBJECT TO</h4>
                    <div class="input-group input-group-sm mb-3">
                        <select name="teacherOfSub" class="form-select form-select-sm" required>
                            @foreach($teachers=\App\Models\Teacher::all() as $key => $item)
                                <option value="{{$item['id']}}">{{$item['degree']." ".$item['firstName']." ".$item['lastName']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <select name="Subject" class="form-select form-select-sm" required>
                            @foreach($teachers=\App\Models\Subject::all() as $key => $item)
                                <option value="{{$item['id']}}">{{$item['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Lecture</span>
                        <input type="number" class="form-control" name="lecture" required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Exercise</span>
                        <input type="number" class="form-control" name="exercise" required>
                    </div>
                    <input type="submit" name="subToTeacher" class="btn btn-secondary" value="Submit subject to a person" />
                </form>
            </div>
            <div class="col-sm">
                <form method="POST" class="px-4 py-3" style="text-align: center">
                    @csrf
                    <h4 style="text-align: center">DELETE </h4>
                    <div class="input-group input-group-sm mb-3">
                        <select name="student" class="form-select form-select-sm" required>
                            @foreach($teachers=\App\Models\Teacher::all() as $key => $item)
                                <option value="{{$item['id']}}">{{$item['degree']." ".$item['firstName']." ".$item['lastName']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="submit" name="delete" class="btn btn-secondary" value="Delete a teacher" />
                </form>
            </div>
        </div>
    </div>
@endsection
