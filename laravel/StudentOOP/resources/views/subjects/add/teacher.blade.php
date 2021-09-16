@extends('layouts.master')
@section('title','Add teacher')
@section('content')
    <div class="container" style="text-align: center">
        <div class="row">
            <div class="col-sm">
                <form action="/subjects/{{$subject->id}}/add/teacher/submit" method="POST" class="px-4 py-3" style="display: flex;justify-content: center;align-items: center;flex-direction: column">
                    @csrf
                    <div class="input-group input-group-sm mb-3" style="display: flex;justify-content: center;align-items: center;">
                        <span class="input-group-text">Subject</span>
                        <select name="teacher" required>
                            @foreach($teacher as $item)
                                <option value={{$item->id}}>{{$item->degree . " " . $item->firstName . " " . $item->lastName}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="submit" name="addTeacher" class="btn btn-secondary" value="Add teacher to {{$subject->name}}" style="margin-top: 2%" />
                </form>
            </div>
    </div>
@endsection
