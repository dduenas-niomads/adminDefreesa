@extends('adminlte::page')

@section('title', env('APP_NAME'))

@section('nav-upgrade')
    active
@endsection

@section('content_header')
    <h1 class="m-0 text-dark">Checkout</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0" id="result"><b>Resultado de transacción:</b> En progreso</p>
                    <div id="purchaseSummary"></div>
                    <input type="hidden" id="transactionToken" value="{{ $transactionToken }}">
                    <input type="hidden" id="amount" value="{{ $amount }}">
                    <input type="hidden" id="purchaseNumber" value="{{ $purchaseNumber }}">
                    <input type="hidden" id="token" value="{{ $token }}">
                    <input type="hidden" id="upgradeToType" value="{{ $type }}">
                    <div class="row">
                        <div class="col-12">
                            <br>
                            <button type="button" onClick="goToDashboard();" class="btn btn-block btn-outline-secondary btn-lg">Ir al inicio</button>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modal-on-load">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" align="center">
                                <h1 class="modal-title">Transacción en progreso...</h4>
                            </div>
                            <div class="modal-body" align="center">
                                Por favor, espere
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    @include('license.partials.scripts-checkout')
@stop
