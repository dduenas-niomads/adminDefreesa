@extends('adminlte::page')

@section('title', env('APP_NAME'))

@section('nav-users-menu')
    menu-open
@stop

@section('nav-users')
    active
@stop

@section('nav-delivery-users')
    active
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Mis repartidores</h1>
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
								<th>Email</th>
								<th>Documento</th>
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
						<h4 class="modal-title">Información de repartidor</h4>
					</div>
					<div class="modal-body" id="infoModalBody">
						<div class="row">
							<div class="col-md-4">
								<div class="card card-primary card-outline">
									<div class="card-body box-profile">
										<div class="text-center">
											<img class="profile-user-img img-fluid img-circle" id="infoModalImg" src="/img/logo.png" alt="User profile picture" height="100px">
										</div>
										<br>
										<ul class="list-group list-group-unbordered mb-3">
											<li class="list-group-item-warehouses">
												<b>Fecha de creación</b> <br> <a class="float-left" id="infoModalCreatedAt"></a>
											</li>
											<!-- <li class="list-group-item-warehouses">
												<b>Última actualización</b> <br> <a class="float-left" id="infoModalUpdatedAt"></a>
											</li> -->
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-8">
								<div class="card">
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
													<label class="col-sm-3 col-form-label">Email</label>
													<div class="col-sm-9">
														<input type="text" class="form-control" placeholder="Email" id="infoModalEmail" readonly>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-3 col-form-label">Documento</label>
													<div class="col-sm-9">
														<input type="text" class="form-control" placeholder="Documento" id="infoModalDocument" readonly>
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
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Regresar</button>
						<button type="button" class="btn btn-info" onClick="goToEditModal();">Editar repartidor</button>
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
					<h4 class="modal-title">Cambiar datos de repartidor</h4>
				</div>
				<div class="modal-body" id="editModalBody">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<div class="tab-content">
										<!-- /.tab-pane -->
										<div class="active tab-pane" id="settings">
										{{ Form::open(array('url' => '/delivery-users', 'method' => 'PUT', 'enctype' => 'multipart/form-data')) }}
											<input type="hidden" name="id" id="editModalId">
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Nombres</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Nombres" name="name" id="editModalName" onClick="this.select();" autocomplete="off" maxlength="100">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Apellidos</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Apellidos" name="lastname" id="editModalLastname" onClick="this.select();" autocomplete="off" maxlength="200">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Email</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Email" name="email" id="editModalEmail" onClick="this.select();" autocomplete="off" maxlength="10">
												</div>
											</div>											
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Documento</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Documento" name="document_number" id="editModalDocument" onClick="this.select();" autocomplete="off" maxlength="10">
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
				<h4 class="modal-title">Eliminar repartidor</h4>
				</div>
				<div class="modal-body" id="deleteModalBody">
				</div>
				<div class="modal-footer">
					{{ Form::open(array('url' => '/delivery-users', 'method' => 'DELETE')) }}
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
    @include('delivery-users.partials.scripts-delivery-users')
@stop