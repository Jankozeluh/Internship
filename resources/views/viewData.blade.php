@extends('layouts.master')
@section('title','Home')
@section('content')

    <div class="container">
            <div class="row">
                <div class="col-sm" style="text-align: center;padding-top: 2%">
                    <table style="border: 1px solid black;text-align: center;" class="table table-secondary table-sm">
                        <a href="{{ url('/student') }}"><h4>Students</h4></a>
                        <thead>
                            <tr>
                                <th scope="row">#</th>
                                <th>Name</th>
                                <th>Birth</th>
                                <th>Enrollment</th>
                                <th>Credits</th>
                                <th>Subjects</th>
                            </tr>
                        </thead>
                        @foreach($studentData as $student)
                            <tr>
                                <th>{{$student['id']}}</th>
                                <td>{{$student['degree']." ".$student['firstName']." ".$student['lastName']}}</td>
                                <td>{{$student['birth']}}</td>
                                <td>{{$student['enrollment']}}</td>
                                <td>{{$student['credits']}}</td>
                                <td>
                                    @foreach($studentSubData as $item)
                                        @if((int)$item->id===$student['id'])
                                            {{$item->name." ,"}}
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="col-sm" style="text-align: center;padding-top: 2%">
                    <table style="border: 1px solid black;text-align: center;" class="table table-secondary table-sm ">
                        <a href="{{ url('/teacher') }}"><h4>Teachers</h4></a>
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Birth</th>
                            <th>Subjects</th>
                        </tr>
                        </thead>
                        @foreach($teacherData as $teacher)
                            <tr>
                                <th scope="row">{{$teacher['id']}}</th>
                                <td>{{$teacher['degree']." ".$teacher['firstName']." ".$teacher['lastName']}}</td>
                                <td>{{$teacher['birth']}}</td>
                                <td>
                                @foreach($teacherSubData as $item)
                                    @if((int)$item->idt===$teacher['id'])
                                        {{$item->name."(".$item->lecture."/".$item->exercise.") ,"}}
                                    @endif
                                @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="container" style="width: 50%">
            <div class="row" >
                <div class="col-sm" style="text-align: center;padding-top: 2%">
                    <table style="border: 1px solid black;text-align: center;" class="table table-secondary table-sm">
                        <a href="{{ url('/subject') }}"><h4>Subjects</h4></a>
                        <thead>
                            <tr>
                                <th scope="row">#</th>
                                <th scope="row">Name</th>
                                <th scope="row">Credits</th>
                                <th scope="row">Semester</th>
                                <th scope="row">Garant</th>
                                <th scope="row">Pc</th>
                                <th scope="row">Teachers</th>
                            </tr>
                        </thead>
                        @foreach($subjectData as $subject)
                            <tr>
                                <th scope="row">{{$subject->id}}</th>
                                <td>{{$subject->name}}</td>
                                <td>{{$subject->credits}}</td>
                                <td>{{$subject->semester}}</td>
                                <td>{{$subject->degree." ".$subject->firstName." ".$subject->lastName}}</td>
                                <td>{{$subject->pc}}</td>
                                <td>
                                    @foreach($teacherSubData as $item)
                                        @if($item->id===$subject->id)
                                            {{$item->firstName." ".$item->lastName."(".$item->lecture."/".$item->exercise.") ,"}}
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
@endsection
