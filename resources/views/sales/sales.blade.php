@extends('adminlte::page')

@section('title', env('APP_NAME'))

@section('nav-sales')
    active
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Ventas y documentos <button type="button" onClick="goToUrl('new-sale');" class="btn btn-outline-success">Nueva venta</button> </h1>
@stop

@section('content')
    <div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<table id="example1" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
						<thead>
							<tr role="row">
								<th>Tienda de origen</th>
								<th>Comprobante</th>
								<th>Serie y número</th>
								<th>Cliente</th>
								<th>Total</th>
								<th>Fecha</th>
								<th>Estado</th>
								<th>Opciones</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
    </div>
@stop

@section('scripts')
    @include('sales.partials.scripts-sales')
@stop
