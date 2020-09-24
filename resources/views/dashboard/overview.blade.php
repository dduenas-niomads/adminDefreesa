@extends('adminlte::page')

@section('title', env('APP_NAME'))

@section('nav-dashboard-menu')
    menu-open
@stop

@section('nav-dashboard')
    active
@stop

@section('nav-overview')
    active
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Panel de control</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">¡Estás conectado!</p>
                </div>
            </div>
        </div>
    </div>
@stop
