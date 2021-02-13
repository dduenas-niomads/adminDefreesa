@extends('adminlte::page')

@section('title', env('APP_NAME'))

@section('nav-dashboard-menu')
    menu-open
@stop

@section('nav-dashboard')
    active
@stop

@section('nav-account')
    active
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Mi cuenta</h1>
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
                            <h3 class="profile-username text-center">{{ $account['name'] }} {{ $account['lastname'] }}</h3>
                            <p class="text-muted text-center">Role</p>
                            <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Documento</b> <a class="float-right">{{ $account['document_number'] }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Miembro desde</b> <a class="float-right">{{ $account['member_since'] }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Plan actual</b> <a class="float-right">{{ $account['active_license']['license']['name'] }}</a>
                            </li>
                            </ul>
                            <a href="/upgrade" class="btn btn-primary btn-block"><b>Aumentar plan</b></a>
                        </div>
                        <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <!-- About Me Box 
                        <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> Education</strong>
                            <p class="text-muted">
                            B.S. in Computer Science from the University of Tennessee at Knoxville
                            </p>
                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                            <p class="text-muted">Malibu, California</p>
                            <hr>
                            <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
                            <p class="text-muted">
                            <span class="tag tag-danger">UI Design</span>
                            <span class="tag tag-success">Coding</span>
                            <span class="tag tag-info">Javascript</span>
                            <span class="tag tag-warning">PHP</span>
                            <span class="tag tag-primary">Node.js</span>
                            </p>
                            <hr>
                            <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                        </div>
                        </div>
                        /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Editar</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                            <!-- /.tab-pane -->
                            <div class="active tab-pane" id="settings">
                                {{ Form::open(array('url' => '/my-account', 'method' => 'PUT', 'class'=>'form-horizontal')) }}
                                    {{ csrf_field() }}
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-3 col-form-label">Nombres</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" name="inputName" id="inputName" placeholder="Ingrese sus nombres" value="{{ $account['name'] }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputLastname" class="col-sm-3 col-form-label">Apellidos</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" name="inputLastname" id="inputLastname" placeholder="Ingrese sus apellidos" value="{{ $account['lastname'] }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputDocumentNumber" class="col-sm-3 col-form-label">Número de documento</label>
                                        <div class="col-sm-9 row">
                                            <div class="col-sm-4">
                                                <select name="inputTypeDocument" id="inputTypeDocument" class="form-control">
                                                @if ( $account['type_document'] === '01')
                                                    <option selected value="01">CI/DNI</option>
                                                    <option value="04">CARNÉ EXTRANJERÍA</option>
                                                    <option value="06">RUC</option>
                                                    <option value="07">PASAPORTE</option>
                                                @elseif ( $account['type_document'] === '04')
                                                    <option value="01">CI/DNI</option>
                                                    <option selected value="04">CARNÉ EXTRANJERÍA</option>
                                                    <option value="06">RUC</option>
                                                    <option value="07">PASAPORTE</option>
                                                @elseif ( $account['type_document'] === '07')
                                                    <option value="01">CI/DNI</option>
                                                    <option value="04">CARNÉ EXTRANJERÍA</option>
                                                    <option value="06">RUC</option>
                                                    <option selected value="07">PASAPORTE</option>
                                                @else ( $account['type_document'] === '06')
                                                    <option value="01">CI/DNI</option>
                                                    <option value="04">CARNÉ EXTRANJERÍA</option>
                                                    <option selected value="06">RUC</option>
                                                    <option value="07">PASAPORTE</option>
                                                @endif
                                                </select>
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="inputDocumentNumber" id="inputDocumentNumber" placeholder="Ingrese su número de documento" value="{{ $account['document_number'] }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-3 col-form-label">Contraseña</label>
                                        <div class="col-sm-9">
                                        <input type="password" class="form-control" name="inputPassword" id="inputPassword" placeholder="Ingrese su nueva contraseña">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <button type="submit" class="btn btn-outline-primary btn-block btn-lg">Guardar cambios de mi cuenta</button>
                                    </div>
                                {{ Form::close() }}
                                {{ Form::open(array('url' => '/my-account/logout-all', 'method' => 'POST', 'class'=>'form-horizontal')) }}
                                    {{ csrf_field() }}
                                    <div class="form-group row">
                                        <button type="submit" class="btn btn-outline-danger btn-block btn-lg">Cerrar todas mis sesiones</button>
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
