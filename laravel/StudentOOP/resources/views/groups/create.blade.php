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
                        <input type="number" name="semester" class="form-control" required>
                    </div>
                    <br/>
                    <div class="input-group input-group-sm mb-3">
                        <div class="col-12">
                            <h4 style="text-align: center;font-size: 22px">Students</h4>
                        </div>
                            @foreach($student as $item)
                                <div class="form-check form-switch col-7" style="margin: auto">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">{{$item->degree. " " .$item->firstName. " " .$item->lastName}}</label>
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" value={{$item->id}}>
                                </div>
                            @endforeach
                    </div>
                    <br>
                    <input type="submit" name="insert" class="btn btn-secondary" value="Submit new group" />
                </form>
            </div>
        </div>
    </div>
@endsection

