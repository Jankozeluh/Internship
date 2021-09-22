@extends('layouts.master')
@section('title',$student->degree." ".$student->firstName." ".$student->lastName)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm" style="text-align: center;padding-top: 2%">
                <h6>BIRTH: {{$student->birth}}</h6>
                <h6>ENROLLMENT: {{$student->enrollment}}</h6>
                <h6>CREDITS: {{$student->credits}}</h6>
            </div>
        </div>

        <div class="row">
        <div class="col-sm" style="text-align: center;padding-top: 2%">
            <table style="border: 1px solid black;text-align: center;" class="table table-secondary table-sm">
                <thead>
                    <tr>
                        <th scope="row"><a href="/groups/">Group</a></th>
                        <th><a href="/subjects/">Subjects</a></th>
                    </tr>
                </thead>
                @foreach($student->groups as $item)
                    <tr>
                        <td><a href="/groups/{{$item->id}}">{{$item->code}}</a></td>
                        <td>
                            @foreach($student->subjects as $item)
                                <a href="/subjects/{{$item->id}}">{{$item->name}}</a> ,
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection

