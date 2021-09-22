@extends('layouts.master')
@section('title','Add group')
@section('content')
    <div class="container" style="text-align: center">
        <div class="row">
            <div class="col-sm">
                <form action="/students/{{$student->id}}/add/group/submit" method="POST" class="px-4 py-3" style="display: flex;justify-content: center;align-items: center;flex-direction: column">
                    @csrf
                    <div class="input-group input-group-sm mb-3" style="display: flex;justify-content: center;align-items: center;">
                        <span class="input-group-text">Group</span>
                        <select name="group" required>
                            @foreach($group as $item)
                                <option value={{$item->id}}>{{$item->code}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="submit" name="addGroup" class="btn btn-secondary" value="Add group to {{$student->firstName . " " . $student->lastName}}" style="margin-top: 2%" />
                </form>
            </div>
    </div>
@endsection
