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
                <form action="/subjects/end/submit" method="POST" class="px-4 py-3" style="text-align: center">
                    @csrf
                    <h4 style="text-align: center">END {{$subject->name}}</h4>
                    <div class="input-group input-group-sm mb-3">
{{--                        <h4 class="input-group-text">Students</h4>--}}
                        @foreach($subject->students as $item)
                            <h5>{{$item->degree}}{{$item->firstName}}{{$item->lastName}}</h5>
                            <input type="checkbox" id="{{$item->id}}" value="{{$item->id}}">
                        @endforeach
                    </div>
                    <input type="submit" name="insert" class="btn btn-secondary" value="Submit new subject" />
                </form>
            </div>
        </div>
    </div>
@endsection

