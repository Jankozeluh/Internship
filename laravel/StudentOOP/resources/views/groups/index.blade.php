@extends('layouts.master')
@section('title','Home')
@section('content')

    <div class="container">
            <div class="row">
                <div class="col-sm" style="text-align: center;padding-top: 2%">
                    <table style="border: 1px solid black;text-align: center;" class="table table-secondary table-sm">
                        <a href="{{ url('/groups') }}"><h4>Groups</h4></a>
                        <thead>
                            <tr>
                                <th scope="row">#</th>
                                <th>Code</th>
                                <th>Semester</th>
                                <th>Students</th>
                                <th>Lectures</th>
                                <th>Exercises</th>
                            </tr>
                        </thead>
                        @foreach($group as $grp)
                            <tr>
                                <th style="border-right: solid 1px #000;">{{$grp['id']}}</th>
                                <td>{{$grp['code']}}</td>
                                <td>{{$grp['semester']}}</td>
                                <td>
                                    @foreach($grp->students as $item)
                                        {{$item->firstName." ".$item->lastName." ,"}}<br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($grp->lectures as $item)
                                        {{$item->name." ,"}}<br>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
    </div>
@endsection
