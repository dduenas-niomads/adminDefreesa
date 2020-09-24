@extends('adminlte::page')

@section('title', env('APP_NAME'))

@section('nav-upgrade')
    active
@endsection

@section('content_header')
    <h1 class="m-0 text-dark">Cambiar al plan {{ $license['type'] }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">Con el plan <b>{{ $license['name'] }}</b> podrás:</p>
                    <p>{{ $license['description'] }}</p>
                    <p>Desde: {{ $license['price'] }} {{ $license['currency'] }} {{ $license['price_scrumb'] }}</p>
                    <div class="form-check">
                        <input type="checkbox" onChange="updateCheckbox();" class="form-check-input" id="visanetCheckbox">
                        <a href="/terms-and-conditions" target="_blank" >Aceptar los términos y condiciones</a>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <button type="button" onClick="goToPlans();" class="btn btn-outline-secondary btn-block btn-lg">Escoger otro plan</button>
                        </div>
                        <div class="col-6">
                            @if (!is_null($token))
                                <button id="buttonUpgrade" disabled class="btn btn-danger btn-block btn-lg" onclick="openVisanet()">Cambiar a {{ $license['type'] }}!</button>
                            @else
                                <form method="POST" action="/checkout?amount={{ $license['price'] }}&purchaseNumber={{ $purchaseNumber }}&type={{ $license['type'] }}">
                                    {{ csrf_field() }}
                                    <button id="buttonUpgrade" disabled type="submit" class="btn btn-danger btn-block btn-lg">Continuar!</button>
                                </form>
                            @endif
                        </div>
                        <div class="col-12">
                            <hr>
                            <p>Métodos de pago:</p>
                            <div class="row">
                                <div class="col-2 my-auto" valign="middle">
                                    <img src="/img/logos_visa/1.webp" alt="" width="100px">
                                </div>
                                <div class="col-2 my-auto" valign="middle">
                                    <img src="/img/logos_visa/2.png" alt="" width="100px">
                                </div>
                                <div class="col-2 my-auto" valign="middle">
                                    <img src="/img/logos_visa/3.png" alt="" width="100px">
                                </div>
                                <div class="col-2 my-auto" valign="middle">
                                    <img src="/img/logos_visa/4.png" alt="" width="100px">
                                </div>
                                <div class="col-2 my-auto" valign="middle">
                                    <img src="/img/logos_visa/5.png" alt="" width="100px">
                                </div>
                                <div class="col-2 my-auto" valign="middle">
                                    <img src="/img/logos_visa/6.png" alt="" width="100px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modal-on-load">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" align="center">
                                <h1 class="modal-title">Transacción en progreso...</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


@section('scripts')
    @include('license.partials.scripts-upgrade-to')
@stop
