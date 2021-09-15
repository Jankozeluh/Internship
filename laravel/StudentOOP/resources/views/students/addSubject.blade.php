@extends('layouts.master')
@section('title','Add subject')
@section('content')
    <div class="container" style="width: 50%">
        <div class="row">
            <div class="col-sm">
{{--                <form action="/students/{{$student->id}}" method="POST" class="px-4 py-3" style="text-align: center">--}}
                <form action="/students/{{$student->id}}" method="POST" class="px-4 py-3" style="text-align: center">
                @csrf
                    @method('PUT')
                    <h4 style="text-align: center">Add subject to student -> {{$student->firstName . " " . $student->lastName}}</h4>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Subject</span>
                        <select name="subject" required>
                            @foreach($subject as $item)
                                <option value={{$item->id}}>{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="submit" name="insert" class="btn btn-secondary" value="Add subject to this student" />
                </form>
            </div>
        </div>
    </div>
@endsection
