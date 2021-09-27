@extends('layouts.master')
@section('title','Create')
@section('content')
    <div class="container" style="width: 50%">
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <p style="text-align: center">{{ $error }}</p>
                            {{header("Refresh:5")}}
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-sm">
                <form action="/subjects" method="POST" class="px-4 py-3" style="text-align: center">
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
                        <select name="semester" class="form-control" required>
                            <option value=1>1</option>
                            <option value=2>2</option>
                        </select>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Garant</span>
                        <select name="garant" class="form-control" required>
                            @foreach($teacher as $item)
                                <option value={{$item->id}}>{{$item->degree . " " . $item->firstName . " " . $item->lastName}}</option>
                            @endforeach
                        </select>
                    </div>
                    <h4 style="text-align: center">Prerequisites</h4>
                    <div class="input-group input-group-sm mb-3">
                        <div class="form-check form-switch" style="margin: auto">
                            @foreach($subject as $item)
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                       name="subject[]" value={{$item->id}}>
                                <label class="form-check-label" for="flexSwitchCheckDefault">{{$item->name}}</label>
                                <br>
                            @endforeach
                        </div>
                    </div>
                    <input type="submit" name="insert" class="btn btn-secondary" value="Submit new subject" />
                </form>
            </div>
        </div>
    </div>
@endsection

