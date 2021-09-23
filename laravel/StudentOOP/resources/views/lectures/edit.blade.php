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
                        <select class="form-control formselect required" placeholder="Select subject" id="subject" name="subject" required>
                            <option disabled selected>Select subject</option>
                            @foreach($subject as $item)
                                <option value={{$item->id}}>{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Teacher</span>
                        <select class="form-control formselect required" placeholder="Select Teacher" id="teacher" name="teacher" required>

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
                    <input type="submit" name="edit" class="btn btn-secondary" value="Edit this lecture" />
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#subject').on('input', function () {
                let id = $(this).val();
                $('#teacher').empty();
                $('#teacher').append(`<option disabled selected>Processing...</option>`);
                $.ajax({
                    type: 'GET',
                    url: '../getTeachers/' + id,
                    success: function (response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#teacher').empty();
                        $('#teacher').append(`<option value="0" disabled selected>Select teacher</option>`);
                        response.forEach(element => {
                            $('#teacher').append(`<option value="${element['id']}">${element['degree']}${element['firstName']}${element['lastName']}</option>`);
                        });
                    }
                });
            });
        });
    </script>
@endsection
