@extends('layouts.master')
@section('title','Home')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm" style="text-align: center;padding-top: 2%">
                <table style="border: 1px solid black;text-align: center;" class="table table-secondary table-sm">
                    <a href="{{ url('/teachers') }}"><h4>Teachers</h4></a>
                    <thead>
                    <tr>
                        <th scope="row">#</th>
                        <th>Name</th>
                        <th>Birth</th>
                        <th>Subjects</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    @foreach($teacher as $t)
                            <tr>
                                    <th>{{$t->id}}</th>
                                    <td>{{$t->degree." ".$t->firstName." ".$t->lastName}}</td>
                                    <td>{{$t->birth}}</td>
                                    <td>
                                        @foreach($t->subjects as $item)
                                                {{$item->name." ,"}}
                                        @endforeach
                                    </td>
                                <td><a href="teachers/{{$t->id}}/edit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16"><path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/></svg></a></td>
                                <td>
                                    <form action="/teachers/{{$t->id}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" id="iddButton"><svg style="margin-top: -7px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/></svg></button>
                                    </form>
                                </td>
                            </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="container" style="width: 10%; text-align: center">
        <div class="row">
            <button name="insert" class="btn btn-secondary"><a href="/teachers/create" style="color: white">Create</a></button>
        </div>
    </div>
@endsection