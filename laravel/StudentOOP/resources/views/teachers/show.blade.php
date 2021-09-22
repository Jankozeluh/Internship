@extends('layouts.master')
@section('title',$teacher->degree." ".$teacher->firstName." ".$teacher->lastName)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm" style="text-align: center;padding-top: 2%">
                <h6>BIRTH: {{$teacher->birth}}</h6>
                <br>
            </div>
        </div>

        <div class="row">
        <div class="col-sm" style="text-align: center;padding-top: 2%">
            <table style="border: 1px solid black;text-align: center;" class="table table-secondary table-sm">
                <thead>
                    <tr>
                        <th><a href="/subjects/">Subjects</a></th>
                        <th><a href="/lectures/">Lectures</a></th>
                        <th><a href="/exercises/">Exercises</a></th>
                    </tr>
                </thead>
                @foreach($teacher->subjects as $item)
                    <tr>
                        <td>
                            @foreach($teacher->subjects as $item)
                                <a href="/subjects/{{$item->id}}">{{$item->name}}</a> ,
                            @endforeach
                        </td>

                        <td>
                            @foreach($teacher->lectures as $item)
                                {{$item->name}},
                            @endforeach
                        </td>

                        <td>
                            @foreach($teacher->exercises as $item)
                                {{$item->name}},
                            @endforeach
                        </td>
                    </tr>
                    <tr style="font-size: 10px;border-top: solid 2px #000;" >
                        <td>Number of subjects - {{$teacher->subjects->count()}}</td>
                        <td>Number of lectures - {{$teacher->lectures->count()}}</td>
                        <td>Number of exercises - {{$teacher->exercises->count()}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection

