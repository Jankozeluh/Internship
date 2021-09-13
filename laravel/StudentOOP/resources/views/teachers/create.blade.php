@extends('layouts.master')
@section('title','Create')
@section('content')
    <div class="container" style="width: 50%">
        <div class="row">
            <div class="col-sm">
                <form action="/teachers" method="POST" class="px-4 py-3" style="text-align: center">
                    @csrf
                    <h4 style="text-align: center">INSERT</h4>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Degree</span>
                        <input type="text" name="degree" class="form-control" required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">First name</span>
                        <input type="text" name="firstName" class="form-control" required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Last name</span>
                        <input type="text" name="lastName" class="form-control" required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Birth</span>
                        <input type="date" name="birth" class="form-control" required>
                    </div>
                    <input type="submit" name="insert" class="btn btn-secondary" value="Submit new teacher" />
                </form>
            </div>
        </div>
    </div>
@endsection
