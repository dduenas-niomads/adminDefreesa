@extends('adminlte::page')

@section('title', env('APP_NAME'))

@section('nav-warehouses')
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
								<th>Nombre comercial</th>
								<th>RUC/Documento</th>
								<th>Ubicación</th>
								<th>Teléfono</th>
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
						<h4 class="modal-title">Información de tienda</h4>
					</div>
					<div class="modal-body" id="infoModalBody">
								<div class="row">
									<div class="col-md-4">
										<div class="card card-primary card-outline">
											<div class="card-body box-profile">
												<div class="text-center">
													<img class="profile-user-img img-fluid img-circle" src="/img/logo.png" alt="User profile picture">
												</div>
												<br>
												<ul class="list-group list-group-unbordered mb-3">
													<li class="list-group-item-warehouses">
														<b>Fecha de creación</b> <br> <a class="float-left" id="infoModalCreatedAt"></a>
													</li>
													<li class="list-group-item-warehouses">
														<b>Última actualización</b> <br> <a class="float-left" id="infoModalUpdatedAt"></a>
													</li>
													<li class="list-group-item-warehouses">
														<b>Usuarios</b> <br> <a class="float-left" id="infoModalUsers">0 usuarios</a>
													</li>
													<li class="list-group-item-warehouses">
														<b>Productos</b> <br> <a class="float-left" id="infoModalProducts">0 productos</a>
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
															<label class="col-sm-3 col-form-label">Nombre comercial</label>
															<div class="col-sm-9">
																<input type="text" class="form-control" placeholder="Nombre comercial" id="infoModalCommercialName" readonly>
															</div>
														</div>
														<div class="form-group row">
															<label class="col-sm-3 col-form-label">Número de RUC</label>
															<div class="col-sm-9">
																<input type="text" class="form-control" placeholder="Número de documento RUC" id="infoModalDocumentNumber" readonly>
															</div>
														</div>
														<div class="form-group row">
															<label class="col-sm-3 col-form-label">Ubicación</label>
															<div class="col-sm-9">
																<input type="text" class="form-control" placeholder="Ubicación de la tienda" id="infoModalShowAddress" readonly>
															</div>
														</div>
														<div class="form-group row">
															<label class="col-sm-3 col-form-label">Teléfono</label>
															<div class="col-sm-9">
																<input type="text" class="form-control" placeholder="Teléfono de contacto" id="infoModalPhone" readonly>
															</div>
														</div>
														<div class="form-group row">
															<label class="col-sm-3 col-form-label">Email</label>
															<div class="col-sm-9">
																<input type="text" class="form-control" placeholder="Email de contacto" id="infoModalEmail" readonly>
															</div>
														</div>
														<div class="form-group row">
															<label class="col-sm-3 col-form-label">Código de moneda</label>
															<div class="col-sm-9">
																<input type="text" class="form-control" placeholder="Código de moneda" id="infoModalCurrency" readonly>
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
						<button type="button" class="btn btn-info" onClick="goToEditModal();">Editar tienda</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<div class="modal fade bd-example-modal-lg" id="modal-serie" style="display: none;">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Series de comprobantes</h4>
					</div>
					<div class="modal-body" id="serieModalBody">
						<div class="row">
							<div class="col-md-4">
								<div class="card card-primary card-outline">
									<div class="card-body box-profile">
										<div class="text-center">
											<img class="profile-user-img img-fluid img-circle" src="/img/logo.png" alt="User profile picture">
										</div>
										<br>
										<ul class="list-group list-group-unbordered mb-3">
											<li class="list-group-item-warehouses">
												<b>Tienda</b> <br> <a class="float-left" id="serieModalCommercialName"></a>
											</li>
											<li class="list-group-item-warehouses">
												<b>Nº RUC</b> <br> <a class="float-left" id="serieModalDocumentNumber"></a>
											</li>
											<li class="list-group-item-warehouses">
												<b>Última actualización</b> <br> <a class="float-left" id="serieModalUpdatedAt"></a>
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
											<div class="active tab-pane" id="serie">
												{{ Form::open(array('url' => '/warehouses', 'method' => 'PUT')) }}
												<input type="hidden" name="series" value="true">
												<input type="hidden" name="id" id="serieModalId">
												<div class="form-group row">
													<div class="col-sm-6">
														<label class="col-form-label">SERIE FACTURA</label>
														<input type="text" class="form-control" onClick="this.select();" placeholder="F001" value="F001" name="serieModalSerie01" id="serieModalSerie01" autocomplete="off" maxlength="6">
													
														<label class="col-form-label">SERIE BOLETA</label>
														<input type="text" class="form-control" onClick="this.select();" placeholder="B001" value="B001" name="serieModalSerie03" id="serieModalSerie03" autocomplete="off" maxlength="6">
													
														<label class="col-form-label">SERIE DOC.INTERNO</label>
														<input type="text" class="form-control" onClick="this.select();" placeholder="P001" value="P001" name="serieModalSerie00" id="serieModalSerie00" autocomplete="off" maxlength="6">
													
														<label class="col-form-label">SERIE GUÍA REMISIÓN</label>
														<input type="text" class="form-control" onClick="this.select();" placeholder="T001" value="T001" name="serieModalSerie09" id="serieModalSerie09" autocomplete="off" maxlength="6">
													</div>
													<div class="col-sm-6">
														<label class="col-form-label">CORRELATIVO FACTURA</label>
														<input type="text" class="form-control" onClick="this.select();" placeholder="1" value="1" name="serieModalNumber01" id="serieModalNumber01" autocomplete="off" maxlength="8">

														<label class="col-form-label">CORRELATIVO BOLETA</label>
														<input type="text" class="form-control" onClick="this.select();" placeholder="1" value="1" name="serieModalNumber03" id="serieModalNumber03" autocomplete="off" maxlength="8">

														<label class="col-form-label">CORRELATIVO DOC.INTERNO</label>
														<input type="text" class="form-control" onClick="this.select();" placeholder="1" value="1" name="serieModalNumber00" id="serieModalNumber00" autocomplete="off" maxlength="8">

														<label class="col-form-label">CORRELATIVO GUÍA DE R.</label>
														<input type="text" class="form-control" onClick="this.select();" placeholder="1" value="1" name="serieModalNumber09" id="serieModalNumber09" autocomplete="off" maxlength="8">
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
						<button type="submit" class="btn btn-secondary">Guardar cambios</button>
						{{ Form::close() }}
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
				<h4 class="modal-title">Cambiar datos de tienda</h4>
				</div>
				<div class="modal-body" id="editModalBody">
					<div class="row">
						<div class="col-md-4">
							<div class="card card-primary card-outline">
								<div class="card-body box-profile">
									<div class="text-center">
										<img class="profile-user-img img-fluid img-circle" src="/img/logo.png" alt="User profile picture">
									</div>
									<br>
									<ul class="list-group list-group-unbordered mb-3">
										<li class="list-group-item-warehouses">
											<b>Fecha de creación</b> <br> <a class="float-left" id="editModalCreatedAt"></a>
										</li>
										<li class="list-group-item-warehouses">
											<b>Última actualización</b> <br> <a class="float-left" id="editModalUpdatedAt">fecha 2</a>
										</li>
										<li class="list-group-item-warehouses">
											<b>Usuarios</b> <br> <a class="float-left" id="editModalUsers">0 usuarios</a>
										</li>
										<li class="list-group-item-warehouses">
											<b>Productos</b> <br> <a class="float-left" id="editModalProducts">0 productos</a>
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
											{{ Form::open(array('url' => '/warehouses', 'method' => 'PUT')) }}
												<input type="hidden" name="id" id="editModalId">
												<div class="form-group row">
													<label class="col-sm-3 col-form-label">Nombre comercial</label>
													<div class="col-sm-9">
														<input type="text" class="form-control" onClick="this.select();" placeholder="Nombre comercial" name="commercial_name" id="editModalCommercialName" maxlength="100" autocomplete="off">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-3 col-form-label">Número de RUC</label>
													<div class="col-sm-9">
														<input type="text" class="form-control" onClick="this.select();" placeholder="Número de documento RUC" name="document_number" id="editModalDocumentNumber" maxlength="11" autocomplete="off" required>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-3 col-form-label">Ubicación</label>
													<div class="col-sm-9">
														<input type="text" class="form-control" onClick="this.select();" placeholder="Ubicación de la tienda" name="show_address" id="editModalShowAddress" maxlength="200" autocomplete="off">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-3 col-form-label">Teléfono</label>
													<div class="col-sm-9">
														<input type="text" class="form-control" onClick="this.select();" placeholder="Teléfono de contacto" name="phone" id="editModalPhone" maxlength="25" autocomplete="off">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-3 col-form-label">Email</label>
													<div class="col-sm-9">
														<input type="email" class="form-control" onClick="this.select();" placeholder="Email de contacto" name="email" id="editModalEmail" maxlength="100" autocomplete="off">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-3 col-form-label">Código de moneda</label>
													<div class="col-sm-9">
														<select name="currency" id="editModalCurrency" class="custom-select">
															<option value="CLP">CLP - PESOS CHILENOS</option>
															<option value="PEN">PEN - SOL PERUANO</option>
															<option value="USD">USD - DÓLAR ESTADOUNIDENSE</option>
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
				<h4 class="modal-title">Crear nueva tienda</h4>
				</div>
				<div class="modal-body" id="newModalBody">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<div class="tab-content">
										<!-- /.tab-pane -->
										<div class="active tab-pane" id="new">
											{{ Form::open(array('url' => '/warehouses', 'method' => 'POST')) }}
												<div class="form-group row">
													<label class="col-sm-3 col-form-label">Nombre comercial</label>
													<div class="col-sm-9">
														<input type="text" class="form-control" onClick="this.select();" placeholder="Nombre comercial" name="commercial_name" id="newModalCommercialName" maxlength="100" autocomplete="off">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-3 col-form-label">Número de RUC</label>
													<div class="col-sm-9">
														<input type="text" class="form-control" onClick="this.select();" placeholder="Número de documento RUC" name="document_number" id="newModalDocumentNumber" maxlength="11" autocomplete="off" required>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-3 col-form-label">Ubicación</label>
													<div class="col-sm-9">
														<input type="text" class="form-control" onClick="this.select();" placeholder="Ubicación de la tienda" name="show_address" id="newModalShowAddress" maxlength="200" autocomplete="off">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-3 col-form-label">Teléfono</label>
													<div class="col-sm-9">
														<input type="text" class="form-control" onClick="this.select();" placeholder="Teléfono de contacto" name="phone" id="newModalPhone" maxlength="25" autocomplete="off">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-3 col-form-label">Email</label>
													<div class="col-sm-9">
														<input type="email" class="form-control" onClick="this.select();" placeholder="Email de contacto" name="email" id="newModalEmail" maxlength="100" autocomplete="off">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-3 col-form-label">Código de moneda</label>
													<div class="col-sm-9">
														<select name="currency" id="newModalCurrency" class="custom-select">
															<option value="CLP">CLP - PESOS CHILENOS</option>
															<option selected value="PEN">PEN - SOL PERUANO</option>
															<option value="USD">USD - DÓLAR ESTADOUNIDENSE</option>
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
				<h4 class="modal-title">Eliminar tienda</h4>
				</div>
				<div class="modal-body" id="deleteModalBody">
				</div>
				<div class="modal-footer">
					{{ Form::open(array('url' => '/warehouses', 'method' => 'DELETE')) }}
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
    @include('warehouses.partials.scripts-warehouses')
@stop
