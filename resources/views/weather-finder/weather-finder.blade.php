@extends('adminlte::page')

@section('title', env('APP_NAME'))

@section('nav-weather-finder')
    active
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Weather finder</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">Look for the best weather for you...</p>
                </div>
            </div>
        </div>
    </div>
@stop
