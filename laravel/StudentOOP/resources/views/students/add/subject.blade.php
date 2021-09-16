@extends('layouts.master')
@section('title','Add subject')
@section('content')
    <div class="container" style="text-align: center">
        <div class="row">
            <div class="col-sm">
                <form action="/students/{{$student->id}}/add/subject/submit" method="POST" class="px-4 py-3" style="display: flex;justify-content: center;align-items: center;flex-direction: column">
                    @csrf
                    <div class="input-group input-group-sm mb-3" style="display: flex;justify-content: center;align-items: center;">
                        <span class="input-group-text">Subject</span>
                        <select name="subject" required>
                            @foreach($subject as $item)
                                <option value={{$item->id}}>{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="submit" name="addSubject" class="btn btn-secondary" value="Add subject to {{$student->firstName . " " . $student->lastName}}" style="margin-top: 2%" />
                </form>
            </div>
    </div>
@endsection
