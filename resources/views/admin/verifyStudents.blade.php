@extends('layouts.main')

@section('title','Users')

@section('content')

    <div class="container list">
    @if($users->count())
        @foreach($users as $index => $user)
            <div class="row align-items-center">
                <div class="col-md-1">{{$user->isStudent()?'Ö':'R'}}</div>
                <div class="col-md-2">
                    <img src="{{$user->studentDocument? $user->studentDocument["path"]:""}}" style="max-height: 75px">
                </div>
                <div class="col-md-2">
                    {{$user->name.' '.$user->surname}} </br>
                    <small>{{$user->email}}</small></br>
                    <small>{{$user->phone}}</small>
                </div>
                <div class="col-md-3">
                    {{$user->education? $user->education->university:""}} </br>
                    {{$user->education? $user->education->department:""}}
                </div>
                <div class="col-md-2">
                    @if(!$user->isVerified)
                        <form class="m-0" method="POST" action="/admin/users/student/verify/{{$user->id}}">
                            @csrf
                            <button class="btn btn-outline-success">Onayla</button>
                        </form>
                    @else
                        <span>&nbsp Onaylı</span>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
    </div>
    <div class="row justify-content-center">{{$users->links()}}</div>
    @if (session()->has('success'))
        <div class="col-sm-12">
            <div class="alert  alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="col-sm-12">
            <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
@endsection