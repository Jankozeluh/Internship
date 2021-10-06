@extends('layouts.master')
@section('title','End')
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
                <form action="/subjects/{{$subject->id}}/end/submit" method="POST" class="px-4 py-3" style="text-align: center">
                    @csrf
                    <h4 style="text-align: center">{{$subject->name}}</h4>
                    <div class="input-group input-group-sm mb-3">
                        <div style="margin: auto">
                            @foreach($subject->students as $item)
                                <label for="id">{{$item->degree.$item->firstName.$item->lastName}}</label>
                                <select class="form-select form-select-sm" name={{$item->id}} id="st">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <br>
                            @endforeach
                        </div>
                    </div>
                    <input type="submit" class="btn btn-secondary" value="End this subject"/>
                </form>
            </div>
        </div>
    </div>
@endsection

