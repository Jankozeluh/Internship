@extends('layouts.master')
@section('title','Edit')
@section('content')
    <div class="container" style="width: 50%">
        <div class="row">
            <div class="col-sm">
                <form action="/lectures/{{$lecture->id}}" method="POST" class="px-4 py-3" style="text-align: center">
                    @csrf
                    @method('PUT')
                    <h4 style="text-align: center">EDIT</h4>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Name</span>
                        <input type="text" name="name" class="form-control" value="{{$lecture->name}}">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Date</span>
                        <input type="date" name="date" class="form-control" value="{{$lecture->date}}" >
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
                    <input type="submit" name="edit" class="btn btn-secondary" value="Edit this subject" />
                </form>
            </div>
        </div>
    </div>
@endsection
