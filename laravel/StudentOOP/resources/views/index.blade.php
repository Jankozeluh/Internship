@extends('layouts.master')
@section('title','Home')
@section('content')
    <div>
        <div style="text-align: center">
            <form method="GET" id="semester" >
            <label for="fff">Semester filter</label><br>
                <select name="filter" id="fff">
{{--                    onchange="filtt()"--}}
                    <option value="off">OFF</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select>
            </form>
        </div>
    </div>

    <div class="container">
            <div class="row">
                <div class="col-sm" style="text-align: center;padding-top: 2%">
                    <table style="border: 1px solid black;text-align: center;" class="table table-secondary table-sm">
                        <a href="{{ url('/students') }}"><h4>Students</h4></a>
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
                        @foreach($student as $st)
                            <tr>
                                <th style="border-right: solid 1px #000;">{{$st['id']}}</th>
                                <td>{{$st['degree']." ".$st['firstName']." ".$st['lastName']}}</td>
                                <td>{{$st['birth']}}</td>
                                <td>{{$st['enrollment']}}</td>
                                <td>{{$st['credits']}}</td>
                                <td>
                                    @foreach($st->subjects as $item)
                                        {{$item->name." ,"}}
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="col-sm" style="text-align: center;padding-top: 2%">
                    <table style="border: 1px solid black;text-align: center;" class="table table-secondary table-sm ">
                        <a href="{{ url('/teachers') }}"><h4>Teachers</h4></a>
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Birth</th>
                            <th>Subjects</th>
                        </tr>
                        </thead>
                        @foreach($teacher as $t)
                            <tr>
                                <th scope="row" style="border-right: solid 1px #000;">{{$t['id']}}</th>
                                <td>{{$t['degree']." ".$t['firstName']." ".$t['lastName']}}</td>
                                <td>{{$t['birth']}}</td>
                                <td>
                                @foreach($t->subjects as $item)
                                        {{$item->name." ,"}}
                                @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row" >
                <div class="col-sm" style="text-align: center;padding-top: 2%">
                    <table style="border: 1px solid black;text-align: center;" class="table table-secondary table-sm">
                        <a href="{{ url('/subjects') }}"><h4>Subjects</h4></a>
                        <thead>
                            <tr>
                                <th scope="row" >#</th>
                                <th scope="row">Name</th>
                                <th scope="row">Credits</th>
                                <th scope="row">Semester</th>
                                <th scope="row">Garant</th>
                                <th scope="row">Teachers</th>
                            </tr>
                        </thead>
                        @foreach($subject as $sub)
                            <tr>
                                <th scope="row" style="border-right: solid 1px #000;">{{$sub->id}}</th>
                                <td>{{$sub->name}}</td>
                                <td>{{$sub->credits}}</td>
                                <td>{{$sub->semester}}</td>
                                <td>{{$sub->garantName->degree." ".$sub->garantName->firstName." ".$sub->garantName->lastName}}</td>
                                <td>
                                    @foreach($sub->teachers as $item)
                                            {{$item->degree." ".$item->firstName." ".$item->lastName." ,"}}
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

    <div class="container">
        <div class="row">
            <div class="col-sm" style="text-align: center;padding-top: 2%">
                <table style="border: 1px solid black;text-align: center;" class="table table-secondary table-sm">
                    <a href="{{ url('/schd_inq') }}"><h4>Lectures</h4></a>
                    <thead>
                    <tr>
                        <th scope="row">#</th>
                        <th scope="row">Name</th>
                        <th scope="row">Date</th>
                        <th scope="row">Subject</th>
                        <th scope="row">Teacher</th>
                        <th scope="row">Group</th>
                    </tr>
                    </thead>
                    @foreach($lecture as $lec)
                        <tr>
                            <th style="border-right: solid 1px #000;">{{$lec['id']}}</th>
                            <td>{{$lec['name']}}</td>
                            <td>{{$lec['date']}}</td>
                            <td>{{$lec->subject->name}}</td>
                            <td>{{$lec->teacher->degree.' '.$lec->teacher->firstName.' '.$lec->teacher->lastName}}</td>
                            <td>{{$lec->group->code}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="col-sm" style="text-align: center;padding-top: 2%">
                <table style="border: 1px solid black;text-align: center;" class="table table-secondary table-sm">
                    <a href="{{ url('/schd_inq') }}"><h4>Exercises</h4></a>
                    <thead>
                    <tr>
                        <th scope="row">#</th>
                        <th scope="row">Name</th>
                        <th scope="row">Date</th>
                        <th scope="row">Subject</th>
                        <th scope="row">Teacher</th>
                        <th scope="row">Group</th>
                        <th scope="row">PC needed</th>
                    </tr>
                    </thead>
                    @foreach($exercise as $exe)
                        <tr>
                            <th style="border-right: solid 1px #000;">{{$exe['id']}}</th>
                            <td>{{$exe['name']}}</td>
                            <td>{{$exe['date']}}</td>
                            <td>{{$exe->subject->name}}</td>
                            <td>{{$exe->teacher->degree.' '.$exe->teacher->firstName.' '.$exe->teacher->lastName}}</td>
                            <td>{{$exe->group->code}}</td>
                            <td>{{$exe->pc}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

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
                                    {{$item->degree." ".$item->firstName." ".$item->lastName}}<br>
                                @endforeach
                            </td>
                            <td>
                                @foreach($grp->lectures as $item)
                                    {{$item->name." - ".$item->date}}<br>
                                @endforeach
                            </td>
                            <td>
                                @foreach($grp->exercises as $item)
                                    {{$item->name." - ".$item->date}}<br>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <script>
            $(function() {
                $('#fff').change(function() {
                    localStorage.setItem('filter', this.value);
                    $('#semester').submit();
                });
                if(localStorage.getItem('filter')){
                    $('#fff').val(localStorage.getItem('filter'));
                }
            });
    </script>
@endsection
