@extends('layouts.master')
@section('title','Create')
@section('content')
    <div class="container" style="width: 50%">
        <div class="row">
            <div class="col-sm">
                <form action="/exercises" method="POST" class="px-4 py-3" style="text-align: center">
                    @csrf
{{--                'name','date','subject_id','teacher_id','group_id'--}}
                    <h4 style="text-align: center">INSERT</h4>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Name</span>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Date</span>
                        <input type="date" name="date" class="form-control" required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Subject</span>
                        <select name="subject" required>
                            @foreach($subject as $item)
                                <option value={{$item->id}}>{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Teacher</span>
                        <select name="teacher" required>
                            @foreach($teacher as $item)
                                <option value={{$item->id}}>{{$item->degree . " " . $item->firstName . " " . $item->lastName}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Group</span>
                        <select name="group" required>
                            @foreach($group as $item)
                                <option value={{$item->id}}>{{$item->code}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">PC</span>
                        <select name="pc" required>
                                <option value='Yes'>Yes</option>
                                <option value='No'>No</option>
                        </select>
                    </div>
                    <input type="submit" name="insert" class="btn btn-secondary" value="Submit new exercise" />
                </form>
            </div>
        </div>
    </div>
@endsection

