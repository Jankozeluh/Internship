@extends('layouts.master')
@section('title','Edit')
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
                <form action="/schd_inq/{{$schedule->id}}" method="POST" class="px-4 py-3" style="text-align: center">
                    @csrf
                    @method('PUT')
                    {{--                'name','date','subject_id','teacher_id','group_id'--}}
                    <h4 style="text-align: center" id="nmm">EDIT LECTURE</h4>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Name</span>
                        <input type="text" name="name" value="{{$schedule->name}}" class="form-control" required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Date</span>
                        <input type="date" name="date" value="{{$schedule->date}}" class="form-control" required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Subject</span>
                        <select class="form-control formselect required" placeholder="Select subject" id="subject"
                                name="subject" required>
                            <option disabled selected>Select subject</option>
                            @foreach($subject as $item)
                                <option value={{$item->id}}>{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Teacher</span>
                        <select class="form-control formselect required" placeholder="Select Teacher" id="teacher"
                                name="teacher" required>
                        </select>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Group</span>
                        <select name="group" class="form-control" required>
                            @foreach($group as $item)
                                <option value={{$item->id}}>{{$item->code}}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($schedule->pc != null)
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text" id="pcspan">PC</span>
                            <select name="pc" class="form-control" id="pc">
                                <option value='Yes'>Yes</option>
                                <option value='No'>No</option>
                            </select>
                        </div>
                    @endif
                    <input type="submit" name="edit" class="btn btn-secondary" value="Edit"/>
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

