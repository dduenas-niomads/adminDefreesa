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
                        <div class="container" style="margin-top: 50px;">

                            
                            <div class="card card-default">

                            <h5>Últimos Movimientos</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th>N.Orden</th>
                                    <th>Fecha creación</th>
                                    <th>Tienda</th>
                                    <th>Cliente</th>
                                    <th>Detalle</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                </tr>
                                <tbody id="tbody">

                                </tbody>
                            </table>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col-12 col-xl-12 mb-4 mb-lg-0">
                                <div class="card">
                                    <h5 class="card-header">Últimos movimientos</h5>
                                    <div class="card-body">
                                        <table id="example1" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                                            <thead>
                                                <tr role="row">
                                                    <th>N.Orden</th>
                                                    <th>Fecha creación</th>
                                                    <th>Tienda</th>
                                                    <th>Cliente</th>
                                                    <th>Detalle</th>
                                                    <th>Total</th>
                                                    <th>Estado</th>
                                                    <th width="17%">Opciones</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="modal fade" id="modal-status" style="display: none;">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h4 class="modal-title">Leyenda de estados</h4>
                                </div>
                                <div class="modal-body" id="statusModalBody">
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Regresar</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <div class="modal fade" id="modal-delete" style="display: none;">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h4 class="modal-title">Rechazar pedido</h4>
                                </div>
                                <div class="modal-body" id="deleteModalBody">
                                </div>
                            <div class="modal-footer">
                                {{ Form::open(array('url' => '/orders', 'method' => 'DELETE')) }}
                                <input type="hidden" name="id" id="deleteModalId">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Regresar</button>
                                    <button type="submit" class="btn btn-danger">RECHAZAR</button>
                                {{ Form::close() }}
                            </div>
                            </div>
                            <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <div class="modal fade" id="modal-accept" style="display: none;">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h4 class="modal-title">Aceptar pedido</h4>
                                </div>
                                <div class="modal-body" id="acceptModalBody">
                                </div>
                            <div class="modal-footer">
                                {{ Form::open(array('url' => '/orders', 'method' => 'PUT')) }}
                                <input type="hidden" name="id" id="acceptModalId">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Regresar</button>
                                    <button type="submit" class="btn btn-success">Aceptar</button>
                                {{ Form::close() }}
                            </div>
                            </div>
                            <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    @include('dashboard.partials.scripts-orders')
@stop