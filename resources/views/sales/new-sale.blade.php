@extends('adminlte::page')

@section('title', env('APP_NAME'))

@section('nav-sales')
    active
@stop

@section('content')
    <div class="row">
		<div class="col-12">
            crear nueva venta
		</div>
    </div>
@stop

@section('scripts')
    @include('sales.partials.scripts-new-sale')
@stop
