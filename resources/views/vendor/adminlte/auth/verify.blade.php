@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('auth_header', __('adminlte::adminlte.verify_message'))

@section('auth_body')

    @if ($status)
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>

        {{ __('adminlte::adminlte.verify_check_your_email') }}
        {{ __('adminlte::adminlte.verify_if_not_recieved') }}, porfavor, revisa tu carpeta de SPAM.

        <form class="d-inline" method="GET" action="{{ route('welcome') }}">
            @csrf
            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
                Genial! Regresar al inicio
            </button>.
        </form>
    @else
        <div class="alert alert-danger" role="alert">
            Tenemos un problema al crear tu cuenta.
        </div>

        {{ $message }}

        <form class="d-inline" method="GET" action="/register">
            @csrf
            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
                Ok. Regresar
            </button>.
        </form>
    @endif

@stop
