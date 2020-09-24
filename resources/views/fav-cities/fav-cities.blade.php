@extends('adminlte::page')

@section('title', env('APP_NAME'))

@section('nav-fav-cities')
    active
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Favorite cities</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">Your favorite cities...</p>
                </div>
            </div>
        </div>
    </div>
@stop
