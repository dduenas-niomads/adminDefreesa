@extends('adminlte::page')

@section('title', env('APP_NAME'))

@section('nav-dashboard-menu')
    menu-open
@stop

@section('nav-dashboard')
    active
@stop

@section('nav-explore')
    active
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Facturación electrónica</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">Indicadores de facturación electrónica...</p>
                </div>
            </div>
        </div>
    </div>
@stop
