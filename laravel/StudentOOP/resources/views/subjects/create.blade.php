@extends('layouts.master')
@section('title','Create')
@section('content')
    <div class="container" style="width: 50%">
        <div class="row">
            <div class="col-sm">
                <form action="/subjects" method="POST" class="px-4 py-3" style="text-align: center">
                    {{--                 ['name','credits','semester','garant','pc']--}}
                    @csrf
                    <h4 style="text-align: center">INSERT</h4>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Name</span>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Credits</span>
                        <input type="number" name="credits" class="form-control" required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Semester</span>
                        <input type="number" name="semester" class="form-control" required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Garant</span>
                        <select name="garant" required>
                            @foreach($teacher as $item)
                                <option value={{$item->id}}>{{$item->degree . " " . $item->firstName . " " . $item->lastName}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Pc</span>
                        <select name="pc" required>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                        </select>
                    </div>
                    <input type="submit" name="insert" class="btn btn-secondary" value="Submit new subject" />
                </form>
            </div>
        </div>
    </div>
@endsection

