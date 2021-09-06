@extends('layouts.master')
@section('title','Students')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <form method="POST" class="px-4 py-3" style="text-align: center">
                    @csrf
                    <h4 style="text-align: center">INSERT</h4>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Degree</span>
                        <input type="text" name="degree" class="form-control">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">First name</span>
                        <input type="text" name="firstName" class="form-control" required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Last name</span>
                        <input type="text" name="lastName" class="form-control" required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Birth</span>
                        <input type="date" name="birth" class="form-control" required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Enrollment</span>
                        <input type="date" name="enrollment" class="form-control" required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Credits</span>
                        <input type="number" name="credits" class="form-control" required>
                    </div>
                    <input type="submit" name="insert" class="btn btn-secondary" value="Submit new student" />
                </form>
            </div>
            <div class="col-sm">
                <form method="POST" class="px-4 py-3" style="text-align: center">
                    @csrf
                    <h4 style="text-align: center">INSERT SUBJECT TO</h4>
                    <div class="input-group input-group-sm mb-3">
                        <select name="studentOfSub" class="form-select form-select-sm" required>
                            @foreach($students=\App\Models\Student::all() as $key => $item)
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
                    <input type="submit" name="subToStudent" class="btn btn-secondary" value="Submit subject to a student" />
                </form>
            </div>
            <div class="col-sm">
                    <form method="POST" class="px-4 py-3" style="text-align: center">
                        @csrf
                        <h4 style="text-align: center">DELETE </h4>
                        <div class="input-group input-group-sm mb-3">
                            <select name="student" class="form-select form-select-sm" required>
                                @foreach($students=\App\Models\Student::all() as $key => $item)
                                    <option value="{{$item['id']}}">{{$item['degree']." ".$item['firstName']." ".$item['lastName']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="submit" name="delete" class="btn btn-secondary" value="Delete a student" />
                    </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm">
                <form method="POST" class="px-4 py-3" style="text-align: center">
                    @csrf
                    <h4 style="text-align: center">LEAVE </h4>
                    <div class="input-group input-group-sm mb-3">
                        <select name="st_leave" class="form-select form-select-sm" required>
                            @foreach($students=\App\Models\Student::all() as $key => $item)
                                <option value="{{$item['id']}}">{{$item['degree']." ".$item['firstName']." ".$item['lastName']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="submit" name="leave" class="btn btn-secondary" value="Leave" />
                </form>
            </div>
            <div class="col-sm">
            </div>
            <div class="col-sm">
            </div>
        </div>
    </div>
@endsection
