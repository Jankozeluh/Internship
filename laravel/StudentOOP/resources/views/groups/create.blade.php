@extends('layouts.master')
@section('title','Create')
@section('content')
    <div class="container" style="width: 50%">
        <div class="row">
            <div class="col-sm">
                <form action="/groups" method="POST" class="px-4 py-3" style="text-align: center">
                    @csrf
                    <h4 style="text-align: center">INSERT</h4>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Code</span>
                        <input type="text" name="code" class="form-control" required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Semester</span>
                        <select name="semester" class="form-control" required>
                            <option value=1>1</option>
                            <option value=2>2</option>
                        </select>
                    </div>

                    <h4 style="text-align: center">Subjects</h4>
                    <div class="input-group input-group-sm mb-3">
                        <div class="form-check form-switch" style="margin: auto">
                            @foreach($subject as $item)
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                       name="subject" value={{$item->id}}>
                                <label class="form-check-label" for="flexSwitchCheckDefault">{{$item->name}}</label>
                                <br>
                            @endforeach
                        </div>
                    </div>

                    <br>
                    <input type="submit" name="insert" class="btn btn-secondary" value="Submit new group"/>
                </form>
            </div>
        </div>
    </div>
@endsection

