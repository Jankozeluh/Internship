@extends('layouts.master')
@section('title','Subjects')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <form method="POST" class="px-4 py-3" style="text-align: center">
                    @csrf
                    <h4 style="text-align: center">INSERT SUBJECT</h4>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Name</span>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Credits</span>
                        <input type="number" class="form-control" name="credits" required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Semester</span>
                        <input type="number" class="form-control" name="semester" required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Garant</span>
                        <select name="garant" class="form-select form-select-sm" required>
                            @foreach($teachers=\App\Models\Teacher::all() as $key => $item)
                                <option value="{{$item['id']}}">{{$item['degree']." ".$item['firstName']." ".$item['lastName']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">PC</span>
                        <select name="pc" class="form-select form-select-sm" required>
                            <option value="yes">YES</option>
                            <option value="no">NO</option>
                        </select>
                    </div>
                        <input type="submit" name="insert" class="btn btn-secondary" value="Submit new subject" />
                </form>
            </div>
            <div class="col-sm">
                <form method="POST" class="px-4 py-3" style="text-align: center">
                    @csrf
                    <h4 style="text-align: center">DELETE</h4>
                    <div class="input-group input-group-sm mb-3">
                        <select name="subject_1" class="form-select form-select-sm" required>
                            @foreach($teachers=\App\Models\Subject::all() as $key => $item)
                                <option value="{{$item['id']}}">{{$item['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                        <input type="submit" name="delete" class="btn btn-secondary" value="Delete subject" />

                </form>
            </div>
            <div class="col-sm">
                <form method="POST" class="px-4 py-3" style="text-align: center">
                    @csrf
                    <h4 style="text-align: center">END</h4>
                    <div class="input-group input-group-sm mb-3">
                        <select name="subject_2" class="form-select form-select-sm" required>
                            @foreach($teachers=\App\Models\Subject::all() as $key => $item)
                                <option value="{{$item['id']}}">{{$item['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                        <input type="submit" name="end" class="btn btn-secondary" value="End subject" />
                </form>
            </div>
        </div>
    </div>
@endsection
