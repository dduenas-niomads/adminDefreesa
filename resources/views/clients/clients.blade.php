@extends('adminlte::page')

@section('title', env('APP_NAME'))

@section('nav-users-menu')
    menu-open
@stop

@section('nav-users')
    active
@stop

@section('nav-clients')
    active
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Mis clientes</h1>
@stop

@section('content')
    <div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<table id="example1" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
						<thead>
							<tr role="row">
								<th>Nombres</th>
								<th>Apellidos</th>
								<th>Documento</th>
								<th>Última compra</th>
								<th>Total de compras</th>
								<th>Estado</th>
                                <th width="20%">Opciones</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
		<div class="modal fade bd-example-modal-lg" id="modal-info" style="display: none;">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Información de consumidor</h4>
					</div>
					<div class="modal-body" id="infoModalBody">
						<div class="row">
							<div class="col-md-8">
								<div class="card-body">
									<div class="tab-content">
										<!-- /.tab-pane -->
										<div class="active tab-pane" id="info">
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Nombres</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Nombre" id="infoModalName" readonly>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Apellidos</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Apellidos" id="infoModalLastname" readonly>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Documento</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Email" id="infoModalDocument" readonly>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Última Compra</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Última Compra" id="infoModalLastPurchase" readonly>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Total Compras</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Total Compras" id="infoModalTotalPurchase" readonly>
												</div>
											</div>																																				
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Estado</label>
												<div class="col-sm-9">
													<select id="infoModalFlagActive" class="custom-select" disabled>
														<option value="1">ACTIVO</option>
														<option value="0">INACTIVO</option>
													</select>
												</div>
											</div>												
										</div>
									</div>
									<!-- /.tab-content -->
								</div><!-- /.card-body -->
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Regresar</button>
						<button type="button" class="btn btn-info" onClick="goToEditModal();">Editar consumidor</button>
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
				<button type="button" class="btn btn-danger">Eliminar cliente</button>
				</div>
			</div>
			<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
    </div>
@stop

@section('scripts')
    @include('clients.partials.scripts-clients')
@stop