@extends('layouts.master')
@section('title','Edit')
@section('content')
    <div class="container" style="width: 50%">
        <div class="row">
            <div class="col-sm">
                <form action="/groups/{{$group->id}}" method="POST" class="px-4 py-3" style="text-align: center">
                    @csrf
                    @method('PUT')
                    <h4 style="text-align: center">EDIT</h4>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Code</span>
                        <input type="text" name="code" class="form-control" value={{$group->code}} required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Semester</span>
                        <select name="semester" class="form-control" required>
                            <option value=1>1</option>
                            <option value=2>2</option>
                        </select>
                    </div>
                    <br>
                    <input type="submit" name="edit" class="btn btn-secondary" value="Submit edit of group"/>
                </form>
            </div>
        </div>
    </div>
@endsection
