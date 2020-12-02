@extends('adminlte::page')

@section('title', env('APP_NAME'))

@section('nav-users-menu')
    menu-open
@stop

@section('nav-users')
    active
@stop

@section('nav-partners')
    active
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Mis partners</h1>
@stop

@section('content')
    <div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<table id="example1" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
						<thead>
							<tr role="row">
								<th>Nombre</th>
								<th>Ruc</th>
								<th>Dirección</th>
								<th>Teléfono</th>
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
						<h4 class="modal-title">Información de partner</h4>
					</div>
					<div class="modal-body" id="infoModalBody">
						<div class="row">
							<div class="col-md-12">
								<div class="card-body">
									<div class="tab-content">
										<!-- /.tab-pane -->
										<div class="active tab-pane" id="info">
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Nombre</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Nombre" id="infoModalName" readonly>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">RUC</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="RUC" id="infoModalRuc" readonly>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Dirección</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Dirección" id="infoModalAddress" readonly>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Teléfono</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Teléfono" id="infoModalPhone" readonly>
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
						<button type="button" class="btn btn-info" onClick="goToEditModal();">Editar partner</button>
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
					<h4 class="modal-title">Cambiar datos de partner</h4>
				</div>
				<div class="modal-body" id="editModalBody">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<div class="tab-content">
										<!-- /.tab-pane -->
										<div class="active tab-pane" id="settings">
										{{ Form::open(array('url' => '/partners', 'method' => 'PUT', 'enctype' => 'multipart/form-data')) }}
											<input type="hidden" name="id" id="editModalId">
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Nombre</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Nombre" name="name" id="editModalName" onClick="this.select();" autocomplete="off" maxlength="100">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Ruc</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Ruc" name="ruc" id="editModalRuc" onClick="this.select();" autocomplete="off" maxlength="200">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Dirección</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Dirección" name="address" id="editModalAddress" onClick="this.select();" autocomplete="off" maxlength="10">
												</div>
											</div>											
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Teléfono</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Teléfono" name="phone" id="editModalPhone" onClick="this.select();" autocomplete="off" maxlength="10">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Estado</label>
												<div class="col-sm-9">
													<select name="active" id="editModalFlagActive" class="custom-select">
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
		<div class="modal fade" id="modal-delete" style="display: none;">
			<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				<h4 class="modal-title">Eliminar partner</h4>
				</div>
				<div class="modal-body" id="deleteModalBody">
				</div>
				<div class="modal-footer">
					{{ Form::open(array('url' => '/partners', 'method' => 'DELETE')) }}
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
    @include('partners.partials.scripts-partners')
@stop