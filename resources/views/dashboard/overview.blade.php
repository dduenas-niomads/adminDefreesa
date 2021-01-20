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
                    <main class="col-md-12 ml-sm-auto col-lg-12 px-md-4 py-4">
                        <!-- <div class="row my-4">
                            <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
                                <div class="card">
                                    <h5 class="card-header">Clientes</h5>
                                    <div class="card-body">
                                    <h5 class="card-title">34</h5>
                                    <p class="card-text">Enero 1 - Hoy, Perú</p>
                                    <p class="card-text text-success">18.2% aumento desde mes pasado</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
                                <div class="card">
                                    <h5 class="card-header">Ingresos totales</h5>
                                    <div class="card-body">
                                    <h5 class="card-title">S/ 2400.00</h5>
                                    <p class="card-text">Enero 1 - Hoy, Perú</p>
                                    <p class="card-text text-success">4.6% aumento desde mes pasado</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
                                <div class="card">
                                    <h5 class="card-header">Órdenes totales</h5>
                                    <div class="card-body">
                                    <h5 class="card-title">43</h5>
                                    <p class="card-text">Enero 1 - Hoy, Perú</p>
                                    <p class="card-text text-info">2.6% aumento desde mes pasado</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
                                <div class="card">
                                    <h5 class="card-header">Movimiento de productos</h5>
                                    <div class="card-body">
                                    <h5 class="card-title">64</h5>
                                    <p class="card-text">Enero 1 - Hoy, Perú</p>
                                    <p class="card-text text-info">2.5% aumento desde mes pasado</p>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="col-12 col-xl-12 mb-4 mb-lg-0">
                                <div class="card">
                                    <h5 class="card-header">Últimos movimientos</h5>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th scope="col">Órden</th>
                                                    <th scope="col">Detalle</th>
                                                    <th scope="col">Cliente</th>
                                                    <th scope="col">Total</th>
                                                    <th scope="col">Fecha</th>
                                                    <th scope="col"></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <th scope="row">204</th>
                                                    <td>1 pollo a la brasa (1) y Pack parrillero (1)</td>
                                                    <td>Xavier</td>
                                                    <td>142.30</td>
                                                    <td>2020-11-23</td>
                                                    <td><a href="#" class="btn btn-sm btn-success">ENTREGADO</a></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">202</th>
                                                    <td>1 pollo a la brasa (1), Pack parrillero (1), Parrilla para dos (1) y Caja de cervezas (1)</td>
                                                    <td>Jesus</td>
                                                    <td>283.20</td>
                                                    <td>2020-11-23</td>
                                                    <td><a href="#" class="btn btn-sm btn-danger">ANULADO</a></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">204</th>
                                                    <td>1 pollo a la brasa</td>
                                                    <td>Henry</td>
                                                    <td>59.90</td>
                                                    <td>2020-11-23</td>
                                                    <td><a href="#" class="btn btn-sm btn-warning">POR ENTREGAR</a></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <a href="/orders" class="btn btn-block btn-light">Ver todo</a>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-12 col-xl-4">
                                <div class="card">
                                    <h5 class="card-header">Traffic last 6 months</h5>
                                    <div class="card-body">
                                        <div id="traffic-chart"></div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
@stop
