@extends('layouts.master')
@section('title',$subject->name)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm" style="text-align: center;padding-top: 2%">
                <h5>Credits: {{$subject->credits}}</h5>
                <h5>Semester: {{$subject->semester}}</h5>
                <h5>Garant: <a href="/teachers/{{$subject->garantName->id}}">{{$subject->garantName->degree . " " . $subject->garantName->firstName . " " . $subject->garantName->lastName}}</a></h5>
                <h5>Prerequisites:
                    @foreach($subject->prereq as $preq)
                        <a href="/subjects/{{$preq->id}}">{{$preq->name}}</a>
                    @endforeach
                </h5>
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
                    @foreach($subject->lectures as $item)
                        <tr>
                            <td style="border-right: solid 1px #000;">{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>
                                <a href="/teachers/{{$item->teacher->id}}">{{$item->teacher->degree." ".$item->teacher->firstName." ".$item->teacher->lastName}}</a>
                            </td>
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
                        <th></th>
                    </tr>
                    </thead>
                    @foreach($subject->students as $item)
                        <tr>
                            <td style="border-right: solid 1px #000;"><a href="/students/{{$item->id}}">{{$item->id}}</a></td>
                            <td><a href="/students/{{$item->id}}">{{$item->degree." ".$item->firstName." ".$item->lastName}}</a></td>
                            <td>{{$item->credits}}</td>
                            <td>{{$item->enrollment}}</td>
                            <td style="border-left: solid 1px #000;">
                                <a href="{{$subject->id}}/student/{{$item->id}}/end">
                                    <button type="submit" id="iddButton">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -7px" width="24" height="24" fill="currentColor" class="bi bi-skip-end-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M6.271 5.055a.5.5 0 0 1 .52.038L9.5 7.028V5.5a.5.5 0 0 1 1 0v5a.5.5 0 0 1-1 0V8.972l-2.71 1.935A.5.5 0 0 1 6 10.5v-5a.5.5 0 0 1 .271-.445z"/></svg>
                                    </button>
                                </a>
                            </td>
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
                    @foreach($subject->exercises as $item)
                        <tr>
                            <td style="border-right: solid 1px #000;">{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>
                                <a href="/teachers/{{$item->teacher->id}}">{{$item->teacher->degree." ".$item->teacher->firstName." ".$item->teacher->lastName}}</a>
                            </td>
                            <td><a href="/subjects/{{$item->subject->id}}">{{$item->subject->name}}</a></td>
                            <td>{{$item->date}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection

