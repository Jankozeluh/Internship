@extends('layouts.master')
@section('title',$group->code)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm" style="text-align: center;padding-top: 2%">
                <h5>Semester: {{$group->semester}}</h5>
            </div>
        </div>
            <div class="row">
                <div class="col-sm" style="text-align: center;padding-top: 2%">
                    <table style="border: 1px solid black;text-align: center;" class="table table-secondary table-sm">
                        <h4><a href="/schd_inq">Lectures</a></h4>
                        <thead>
                        <tr>
                            <th scope="row">#</th>
                            <th>Name</th>
                            <th>Teacher</th>
                            <th>Subject</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                            @foreach($group->lectures as $item)
                            <tr>
                                <td style="border-right: solid 1px #000;">{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td><a href="/teachers/{{$item->teacher->id}}">{{$item->teacher->degree." ".$item->teacher->firstName." ".$item->teacher->lastName}}</a></td>
                                <td><a href="/subjects/{{$item->subject->id}}">{{$item->subject->name}}</a></td>
                                <td>{{$item->date}}</td>
                            </tr>
                            @endforeach
                    </table>
                </div>
                <div class="col-sm" style="text-align: center;padding-top: 2%">
                    <table style="border: 1px solid black;text-align: center;" class="table table-secondary table-sm">
                        <h4><a href="/students">Students</a></h4>
                        <thead>
                        <tr>
                            <th scope="row">#</th>
                            <th>Name</th>
                            <th>Credits</th>
                            <th>Enrollment</th>
                        </tr>
                        </thead>
                            @foreach($group->students as $item)
                                <tr>
                                    <td style="border-right: solid 1px #000;"><a href="/students/{{$item->id}}">{{$item->id}}</a></td>
                                    <td><a href="/students/{{$item->id}}">{{$item->degree." ".$item->firstName." ".$item->lastName}}</a></td>
                                    <td>{{$item->credits}}</td>
                                    <td>{{$item->enrollment}}</td>
                                </tr>
                            @endforeach
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm" style="text-align: center;padding-top: 2%">
                    <table style="border: 1px solid black;text-align: center;" class="table table-secondary table-sm">
                        <h4><a href="/schd_inq">Exercises</a></h4>
                    <thead>
                    <tr>
                        <th scope="row">#</th>
                        <th>Name</th>
                        <th>Teacher</th>
                        <th>Subject</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                        @foreach($group->exercises as $item)
                            <tr>
                                <td style="border-right: solid 1px #000;">{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->teacher->degree." ".$item->teacher->firstName." ".$item->teacher->lastName}}</td>
                                <td>{{$item->subject->name}}</td>
                                <td>{{$item->date}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
@endsection

