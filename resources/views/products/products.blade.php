@extends('adminlte::page')

@section('title', env('APP_NAME'))

@section('nav-products')
    active
@stop

@section('content_header')
	<h1 class="m-0 text-dark">Mis productos <button type="button" onClick="openNewModal();" class="btn btn-outline-success">Nuevo producto</button> </h1> 
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
                                <th>Categoría</th>
                                <th>Marca</th>
                                <th>Nombre</th>
                                <th>Código</th>
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
						<h4 class="modal-title">Información de producto</h4>
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
												<b>Kárdex</b> <br> <a class="float-left" id="infoModalKardex"></a>
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
													<label class="col-sm-3 col-form-label">Categoría</label>
													<div class="col-sm-9">
														<input type="text" class="form-control" placeholder="Categoría" id="infoModalCategoryName" readonly>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-3 col-form-label">Marca</label>
													<div class="col-sm-9">
														<input type="text" class="form-control" placeholder="Marca" id="infoModalBrandName" readonly>
													</div>
												</div>
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
													<label class="col-sm-3 col-form-label">Código</label>
													<div class="col-sm-9">
														<input type="text" class="form-control" placeholder="Precio" id="infoModalCode" readonly>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-3 col-form-label">Precio</label>
													<div class="col-sm-9">
														<input type="text" class="form-control" placeholder="Precio" id="infoModalPrice" readonly>
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
						<button type="button" class="btn btn-info" onClick="goToEditModal();">Editar producto</button>
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
					<h4 class="modal-title">Cambiar datos de producto</h4>
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
											<b>Última actualización</b> <br> <a class="float-left" id="editModalUpdatedAt"></a>
										</li>
										<li class="list-group-item-warehouses">
											<b>Kárdex</b> <br> <a class="float-left" id="editModalKardex"></a>
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
											{{ Form::open(array('url' => '/products', 'method' => 'PUT')) }}
											<input type="hidden" name="id" id="editModalId">
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Categoría</label>
												<div class="col-sm-9">
													<select name="bs_ms_product_categories_id" id="editModalCategory" class="custom-select">
														<option value="1">Productos generales</option>
													</select>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Marca</label>
												<div class="col-sm-9">
													<select name="bs_brands_id" id="editModalBrand" class="custom-select">
														<option value="1">Primera marca</option>
														<option value="2">Segunda marca</option>
														<option value="3">Tercera marca</option>
														<option value="4">Cuarta marca</option>
														<option value="5">Quinta marca</option>
														<option value="6">Sexta marca</option>
														<option value="7">Séptima marca</option>
													</select>	
												</div>
											</div>
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
												<label class="col-sm-3 col-form-label">Código</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Precio" name="code" id="editModalCode" onClick="this.select();" autocomplete="off" maxlength="25">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Precio</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Precio" name="price" id="editModalPrice" onClick="this.select();" autocomplete="off" maxlength="10">
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
					<h4 class="modal-title">Crear nuevo producto</h4>
				</div>
				<div class="modal-body" id="newModalBody">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<div class="tab-content">
										<!-- /.tab-pane -->
										<div class="active tab-pane" id="new">
											{{ Form::open(array('url' => '/products', 'method' => 'POST')) }}
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Categoría</label>
												<div class="col-sm-9">
													<select name="bs_ms_product_categories_id" id="editModalCategory" class="custom-select">
														<option value="1">Productos generales</option>
													</select>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Marca</label>
												<div class="col-sm-9">
													<select name="bs_brands_id" id="editModalBrand" class="custom-select">
														<option value="1">Primera marca</option>
														<option value="2">Segunda marca</option>
														<option value="3">Tercera marca</option>
														<option value="4">Cuarta marca</option>
														<option value="5">Quinta marca</option>
														<option value="6">Sexta marca</option>
														<option value="7">Séptima marca</option>
													</select>	
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Nombre</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Nombre" name="name" id="editModalName" onClick="this.select();" autocomplete="off" maxlength="100" required>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Descripción</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Descripción" name="description" id="editModalDescription" onClick="this.select();" autocomplete="off" maxlength="200">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Código</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Precio" name="code" id="editModalCode" onClick="this.select();" autocomplete="off" maxlength="25" required>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Precio</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Precio" name="price" id="editModalPrice" onClick="this.select();" autocomplete="off" maxlength="10" required>
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
				<h4 class="modal-title">Eliminar producto</h4>
				</div>
				<div class="modal-body" id="deleteModalBody">
				</div>
				<div class="modal-footer">
					{{ Form::open(array('url' => '/products', 'method' => 'DELETE')) }}
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
    @include('products.partials.scripts-products')
@stop