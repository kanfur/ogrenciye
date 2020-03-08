@extends('layouts.main')

@section('title','Users')

@section('content')

    <div class="container list">
    @if($users->count())
        @foreach($users as $index => $user)
            <div class="row align-items-center">
                <div class="col-md-1">{{$user->isStudent()?'Ö':'R'}}</div>
                <div class="col-md-2"><img src="{{$user->photo}}" style="max-width: 45px"></div>
                <div class="col-md-2">{{$user->name.' '.$user->surname}}</div>
                <div class="col-md-2">{{$user->phone}}</div>
                <div class="col-md-3"><small>{{$user->email}}</small></div>
                <div class="col-md-2"><button class="btn btn-outline-info">Onay</button></div>
            </div>
        @endforeach
    @endif
    </div>
    <div class="row justify-content-center">{{$users->links()}}</div>
@endsection