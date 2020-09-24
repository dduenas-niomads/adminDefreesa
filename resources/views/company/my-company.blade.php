@extends('adminlte::page')

@section('title', env('APP_NAME'))

@section('nav-dashboard-menu')
    menu-open
@stop

@section('nav-dashboard')
    active
@stop

@section('nav-company')
    active
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Mi empresa</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="/img/logo.png" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">{{ $company['name'] }}</h3>
                            <p class="text-muted text-center">{{ $company['category']['name'] }}</p>
                            <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>País</b> <a class="float-right">{{ $company['country_name'] }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Moneda</b> <a class="float-right">{{ $company['currency_name'] }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Plan actual</b> <a class="float-right">{{ $currentLicense['license']['name'] }}</a>
                            </li>
                            </ul>
                            <a href="/upgrade" class="btn btn-primary btn-block"><b>Aumentar plan</b></a>
                        </div>
                        <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#license" data-toggle="tab">Licencia</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Editar</a></li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <!-- /.tab-pane -->
                                    <div class="active tab-pane" id="license">
                                        {{ Form::open(array('url' => '/upgrade', 'method' => 'GET', 'class'=>'form-horizontal')) }}
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Tipo de plan</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" placeholder="Nombre de tipo de plan" value="{{ $currentLicense['license']['type'] }}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Nombre de plan</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" placeholder="Nombre de tipo de plan" value="{{ $currentLicense['license']['name'] }}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Frecuencia</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" placeholder="Nombre de Frecuencia de subscripción" value="{{ $currentLicense['license']['frequency'] }}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Descripción</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" placeholder="Descripción subscripción" readonly>{{ $currentLicense['license']['description'] }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Disponibilidad</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" placeholder="Inicio de plan" value="Inicio: {{ $currentLicense['date_start'] }}" readonly>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" placeholder="Fin de plan" value="Fin: {{ $currentLicense['date_end'] }}" readonly>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" placeholder="Fin de plan" value="{{ $currentLicense['days_available'] }} días disponibles" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <button type="submit" class="btn btn-outline-secondary btn-block btn-lg">Cambiar de plan</button>
                                            </div>
                                        {{ Form::close() }}
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="settings">
                                        {{ Form::open(array('url' => '/my-company', 'method' => 'PUT', 'class'=>'form-horizontal')) }}
                                            {{ csrf_field() }}
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-3 col-form-label">Rubro o categoría</label>
                                                <div class="col-sm-9">
                                                    <select name="inputCategoryId" id="inputCategoryId" class="form-control">
                                                    @foreach ($categories as $category)
                                                        @if ((int)$company['bs_ms_company_categories_id'] === (int)$category['id'])
                                                            <option selected value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                                        @else
                                                            <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                                        @endif
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-3 col-form-label">Nombre</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="inputName" id="inputName" placeholder="Ingrese nombre" value="{{ $company['name'] }}" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputDescription" class="col-sm-3 col-form-label">Descripción</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="inputDescription" id="inputDescription" placeholder="Ingrese descripción" value="{{ $company['description'] }}" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputAddress" class="col-sm-3 col-form-label">Dirección</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="inputAddress" id="inputAddress" placeholder="Ingrese dirección" value="{{ $company['address'] }}" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputDistrictAndCity" class="col-sm-3 col-form-label">Distrito, ciudad y país</label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" name="inputDistrict" id="inputDistrict" placeholder="Ingrese distrito" value="{{ $company['district'] }}" required>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" name="inputCity" id="inputCity" placeholder="Ingrese ciudad" value="{{ $company['city'] }}" required>
                                                </div>
                                                <div class="col-sm-3">
                                                    <select name="inputCountry" id="inputCountry" class="form-control">
                                                    @foreach ($countries as $country)
                                                        @if ($company['country'] === $country['code'])
                                                            <option selected value="{{ $country['code'] }}">{{ $country['name'] }}</option>
                                                        @else
                                                            <option value="{{ $country['code'] }}">{{ $country['name'] }}</option>
                                                        @endif
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputCurrency" class="col-sm-3 col-form-label">Moneda de operación</label>
                                                <div class="col-sm-9">
                                                    <select name="inputCurrency" id="inputCurrency" class="form-control">
                                                    @foreach ($currencies as $currency)
                                                        @if ($company['currency'] === $currency['code'])
                                                            <option selected value="{{ $currency['code'] }}">{{ $currency['name'] }}</option>
                                                        @else
                                                            <option value="{{ $currency['code'] }}">{{ $currency['name'] }}</option>
                                                        @endif
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <button type="submit" class="btn btn-outline-primary btn-block btn-lg">Guardar cambios de mi empresa</button>
                                            </div>
                                        {{ Form::close() }}
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                    <!-- /.col -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
