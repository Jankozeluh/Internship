@extends('layouts.master')
@section('title','Add student')
@section('content')
    <div class="container" style="text-align: center">
        <div class="row">
            <div class="col-sm">
                <form action="/groups/{{$group->id}}/add/student/submit" method="POST" class="px-4 py-3" style="display: flex;justify-content: center;align-items: center;flex-direction: column">
                    @csrf
                    <div class="input-group input-group-sm mb-3" style="display: flex;justify-content: center;align-items: center;">
                        <span class="input-group-text">Student</span>
                        <select name="student" required>
                            @foreach($student as $item)
                                <option value={{$item->id}}>{{$item->degree . " " . $item->firstName . " " . $item->lastName}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="submit" name="addStudent" class="btn btn-secondary" value="Add student to {{$group->code}}" style="margin-top: 2%"/>
                </form>
            </div>
        </div>
@endsection
