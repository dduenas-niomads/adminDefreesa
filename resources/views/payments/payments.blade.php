@extends('adminlte::page')

@section('title', env('APP_NAME'))

@section('nav-payments')
    active
@stop

@section('content_header')
<h1 class="m-0 text-dark">Mis pagos <button type="button" onClick="openNewModal();" class="btn btn-outline-success">Nuevo pago</button> </h1>
@stop

@section('content')
    <div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<table id="example1" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
						<thead>
							<tr role="row">
								<th>Local Afiliado</th>
								<th>Total</th>
								<th>Status</th>
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
						<h4 class="modal-title">Información de pago</h4>
					</div>
					<div class="modal-body" id="infoModalBody">
						<div class="row">
							<div class="col-md-12">
								<div class="card-body">
									<div class="tab-content">
										<!-- /.tab-pane -->
										<div class="active tab-pane" id="info">
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Local Afiliado</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Local Afiliado" id="infoModalSupplier" readonly>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Total</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Total" id="infoModalTotal" readonly>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Status</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Status" id="infoModalStatus" readonly>
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
						<button type="button" class="btn btn-info" onClick="goToEditModal();">Editar pago</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<div class="modal fade bd-example-modal-lg" id="modal-edit" style="display: none;">
			<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Cambiar datos de pago</h4>
				</div>
				<div class="modal-body" id="editModalBody">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<div class="tab-content">
										<!-- /.tab-pane -->
										<div class="active tab-pane" id="settings">
										{{ Form::open(array('url' => '/payments', 'method' => 'PUT', 'enctype' => 'multipart/form-data')) }}
											<input type="hidden" name="id" id="editModalId">
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Local Afiliado</label>
												<div class="col-sm-9">
													<select class="form-control" placeholder="Seleccione un local" name="bs_suppliers_id" id="editModalSupplierId">
														@foreach ($suppliers as $supplier)
															<option value="{{ $supplier['id'] }}">{{ $supplier['name'] }}</option>
														@endforeach
													</select>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Total</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Total" name="total" id="editModalTotal" onClick="this.select();" autocomplete="off" maxlength="200">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Status</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Status" name="status" id="editModalStatus" onClick="this.select();" autocomplete="off" maxlength="10">
												</div>
											</div>											
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Estado</label>
												<div class="col-sm-9">
													<select name="flag_active" id="editModalFlagActive" class="custom-select">
														<option value="1">ACTIVO</option>
														<option value="0">INACTIVO</option>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>									
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Regresar</button>
					<button type="submit" class="btn btn-warning">Guardar cambios</button>
					{{ Form::close() }}
				</div>
			</div>
			<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<div class="modal fade bd-example-modal-lg" id="modal-new" style="display: none;">
			<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Crear nuevo pago</h4>
				</div>
				<div class="modal-body" id="newModalBody">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<div class="tab-content">
										<!-- /.tab-pane -->
										<div class="active tab-pane" id="new">
											{{ Form::open(array('url' => '/payments', 'method' => 'POST')) }}
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Local Afiliado</label>
												<div class="col-sm-9">
													<select class="form-control" placeholder="Seleccione un local afiliado" name="bs_suppliers_id" id="newModalSupplierId">
														@foreach ($suppliers as $supplier)
															<option value="{{ $supplier['id'] }}">{{ $supplier['name'] }}</option>
														@endforeach
													</select>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Total</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Total" name="total" id="editModalTotal" onClick="this.select();" autocomplete="off" maxlength="200">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Status</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Status" name="status" id="editModalStatus" onClick="this.select();" autocomplete="off" maxlength="10" required>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Estado</label>
												<div class="col-sm-9">
													<select name="flag_active" id="editModalFlagActive" class="custom-select">
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
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Regresar</button>
					<button type="submit" class="btn btn-success">Guardar cambios</button>
					{{ Form::close() }}
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
				<h4 class="modal-title">Eliminar pago</h4>
				</div>
				<div class="modal-body" id="deleteModalBody">
				</div>
				<div class="modal-footer">
					{{ Form::open(array('url' => '/payments', 'method' => 'DELETE')) }}
					<input type="hidden" name="id" id="deleteModalId">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">No</button>
					<button type="submit" class="btn btn-danger">Sí</button>
					{{ Form::close() }}
				</div>
			</div>
			<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
    </div>
@stop

@section('scripts')
    @include('payments.partials.scripts-payments')
@stop