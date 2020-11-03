@extends('adminlte::page')

@section('title', env('APP_NAME'))

@section('nav-suppliers')
    active
@stop

@section('content_header')
	<h1 class="m-0 text-dark">Mis proveedores <button type="button" onClick="openNewModal();" class="btn btn-outline-success">Nuevo proveedor</button> </h1> 
@stop

@section('content')
	<style>
		.list-group-item-warehouses {
			position: relative;
			display: block;
			padding: .5rem 0rem;
			background-color: #fff;
			/* border: 1px solid rgba(0,0,0,.125); */
		}
	</style>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                        <thead>
                            <tr role="row">
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Estado</th>
                                <th>Opciones</th>
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
						<h4 class="modal-title">Información de categoría</h4>
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
											<li class="list-group-item-warehouses">
												<b>Última actualización</b> <br> <a class="float-left" id="infoModalUpdatedAt"></a>
											</li>
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
													<label class="col-sm-3 col-form-label">Nombre</label>
													<div class="col-sm-9">
														<input type="text" class="form-control" placeholder="Nombre" id="infoModalName" readonly>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-3 col-form-label">Descripción</label>
													<div class="col-sm-9">
														<input type="text" class="form-control" placeholder="Descripción" id="infoModalDescription" readonly>
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
						<button type="button" class="btn btn-info" onClick="goToEditModal();">Editar categoría</button>
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
					<h4 class="modal-title">Cambiar datos de categoría</h4>
				</div>
				<div class="modal-body" id="editModalBody">
					<div class="row">
						<div class="col-md-4">
							<div class="card card-primary card-outline">
								<div class="card-body box-profile">
									<div class="text-center">
										<img class="profile-user-img img-fluid img-circle" id="editModalImg" src="/img/logo.png" alt="User profile picture" height="100px">
									</div>
									<br>
									<ul class="list-group list-group-unbordered mb-3">
										<li class="list-group-item-warehouses">
											<b>Fecha de creación</b> <br> <a class="float-left" id="editModalCreatedAt"></a>
										</li>
										<li class="list-group-item-warehouses">
											<b>Última actualización</b> <br> <a class="float-left" id="editModalUpdatedAt"></a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-8">
							<div class="card">
								<div class="card-body">
									<div class="tab-content">
										<!-- /.tab-pane -->
										<div class="active tab-pane" id="settings">
											{{ Form::open(array('url' => '/categories', 'method' => 'PUT')) }}
											<input type="hidden" name="id" id="editModalId">
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Nombre</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Nombre" name="name" id="editModalName" onClick="this.select();" autocomplete="off" maxlength="100">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Descripción</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Descripción" name="description" id="editModalDescription" onClick="this.select();" autocomplete="off" maxlength="200">
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
					<h4 class="modal-title">Crear nuevo proveedor</h4>
				</div>
				<div class="modal-body" id="newModalBody">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<div class="tab-content">
										<!-- /.tab-pane -->
										<div class="active tab-pane" id="new">
											{{ Form::open(array('url' => '/suppliers', 'method' => 'POST')) }}
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Categoría</label>
												<div class="col-sm-9">
													<select class="form-control" placeholder="Seleccione una categoría" name="bs_categories_id" id="newModalCategoryId">
														@foreach ($categories as $category)
															<option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
														@endforeach
													</select>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Nombre</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Nombre" name="name" id="newModalName" onClick="this.select();" autocomplete="off" maxlength="100" required>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Descripción</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Descripción" name="description" id="newModalDescription" onClick="this.select();" autocomplete="off" maxlength="200">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Estado</label>
												<div class="col-sm-9">
													<select name="flag_active" id="newModalFlagActive" class="custom-select">
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
				<h4 class="modal-title">Eliminar categoría</h4>
				</div>
				<div class="modal-body" id="deleteModalBody">
				</div>
				<div class="modal-footer">
					{{ Form::open(array('url' => '/categories', 'method' => 'DELETE')) }}
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
    @include('suppliers.partials.scripts-suppliers')
@stop