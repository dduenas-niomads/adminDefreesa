@extends('adminlte::page')

@section('title', env('APP_NAME'))

@section('nav-orders')
    active
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Mis pedidos</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                        <thead>
                            <tr role="row">
                                <th>N.Orden</th>
                                <th>Fecha creación</th>
                                <th>Tienda</th>
                                <th>Detalle</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
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
		<div class="modal fade" id="modal-message" style="display: none;">
			<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				<h4 class="modal-title">Message Modal</h4>
				</div>
				<div class="modal-body" id="messageModalBody">
				</div>
				<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Regresar</button>
				<button type="button" class="btn btn-info">Enviar mensaje</button>
				</div>
			</div>
			<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<div class="modal fade" id="modal-info" style="display: none;">
			<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				<h4 class="modal-title">Info Modal</h4>
				</div>
				<div class="modal-body" id="infoModalBody">
				</div>
				<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Regresar</button>
				<button type="button" class="btn btn-info" onClick="goToEditModal();">Editar pedido</button>
				</div>
			</div>
			<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<div class="modal fade" id="modal-edit" style="display: none;">
			<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				<h4 class="modal-title">Edit Modal</h4>
				</div>
				<div class="modal-body" id="editModalBody">
				</div>
				<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Regresar</button>
				<button type="button" class="btn btn-warning">Guardar cambios</button>
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
				<h4 class="modal-title">Delete Modal</h4>
				</div>
				<div class="modal-body" id="deleteModalBody">
				</div>
				<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Regresar</button>
				<button type="button" class="btn btn-danger">Eliminar pedido</button>
				</div>
			</div>
			<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
    </div>
@stop

@section('scripts')
    @include('orders.partials.scripts-orders')
@stop