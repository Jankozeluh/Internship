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
                <form action="/schd_inq" method="POST" class="px-4 py-3" style="text-align: center">
                    @csrf
                    {{--                'name','date','subject_id','teacher_id','group_id'--}}
                    <h4 style="text-align: center" id="nmm">INSERT LECTURE</h4>
                    <div class="input-group input-group-sm mb-3">
                        <div class="form-check form-switch" style="margin: auto">
                            <input class="form-check-input" type="checkbox" name="pcc" id="pcc">
                        </div>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Name</span>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Date</span>
                        <input type="date" name="date" class="form-control" required>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Group</span>
                        <select name="group" class="form-control" id="group" required>
                            <option disabled selected>Select group</option>
                            @foreach($group as $item)
                                <option value={{$item->id}}>{{$item->code}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Subject</span>
                        <select class="form-control formselect required" placeholder="Select subject" id="subject" name="subject" required></select>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text">Teacher</span>
                        <select class="form-control formselect required" placeholder="Select Teacher" id="teacher"
                                name="teacher" required>
                        </select>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="pcspan" style="display:none;">PC</span>
                        <select name="pc" class="form-control" id="pc" style="display:none;">
                        </select>
                    </div>
                    <input type="submit" name="insert" class="btn btn-secondary" value="Submit"/>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $(document).on('click', '#pcc', function () {
                if ($('#pcc').is(':checked')) {
                    $('.single-item').prop('checked', true);
                    $('#nmm').empty();
                    $('#nmm').append('INSERT EXERCISE');

                    $('#pc').append(`<option value='Yes'>Yes</option>`);
                    $('#pc').append(`<option value='No'>No</option>`);
                    $('#pc').show();
                    $('#pcspan').show();

                } else {
                    $('.single-item').prop('checked', false);
                    $('#pc').empty();

                    $('#pc').hide();
                    $('#pcspan').hide();

                    $('#nmm').empty();
                    $('#nmm').append('INSERT LECTURE');
                }
            });

            $('#group').on('change', function () {
                let id = $(this).val();
                $('#subject').empty();
                $('#teacher').empty();
                $('#subject').append(`<option disabled selected>Processing...</option>`);
                $.ajax({
                    type: 'GET',
                    url: 'getSubjects/' + id,
                    success: function (response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#subject').empty();
                        $('#subject').append(`<option value="0" disabled selected>Select subject</option>`);
                        response.forEach(element => {
                            $('#subject').append(`<option value="${element['id']}">${element['name']}</option>`);
                        });
                    }
                });
                $('#subject').on('input', function () {
                    let id = $(this).val();
                    $('#teacher').empty();
                    $('#teacher').append(`<option disabled selected>Processing...</option>`);
                    $.ajax({
                        type: 'GET',
                        url: 'getTeachers/' + id,
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
        });
    </script>
@endsection

