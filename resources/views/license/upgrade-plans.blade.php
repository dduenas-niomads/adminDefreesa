@extends('adminlte::page')

@section('title', env('APP_NAME'))

@section('nav-upgrade')
    active
@endsection

@section('content_header')
    <h1 class="m-0 text-dark">Escoge el plan perfecto para ti</h1>
@stop

@section('content')
    <div class="row text-sm">
        <div class="col-12">
            <div class="card">
                <div class="card-body ">
                    <div class="row">
                    @foreach ($licenses as $license)
                        <div class="col-md-3">
                            <!-- Widget: user widget style 1 -->
                            <div class="card card-widget widget-user">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header text-white" style="background: gray center center;">
                                    <h3 class="widget-user-username text-right">{{ $license['name'] }}</h3>
                                    <h5 class="widget-user-desc text-right">{{ $license['type'] }}</h5>
                                </div>
                                <div class="widget-user-image">
                                    <img class="img-circle" src="./img/logo.png" alt="User Avatar">
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                    <div class="col-sm-6 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">{{ $license['price'] }} {{ $license['currency'] }}</h5>
                                            <span class="description-text">{{ $license['price_scrumb'] }}</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-6">
                                        @if ($license['type'] === $currentLicense['license']['type'])
                                            <div class="description-block">
                                                <h5 class="description-header">Ver más</h5>
                                                <span class="description-text">detalles</span>
                                            </div>
                                        @else
                                            @if ($license['flag_active'])
                                                <a style="text-decoration:none;" href="/upgrade-to/{{ $license['type'] }}">
                                                    <div class="description-block">
                                                        <h5 class="description-header">Cambiar a</h5>
                                                        <span class="description-text">{{ $license['type'] }}</span>
                                                    </div>
                                                </a>
                                            @else
                                                <div class="description-block">
                                                    <h5 class="description-header">Próximamente</h5>
                                                </div>
                                            @endif
                                        @endif
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                            </div>
                            <!-- /.widget-user -->
                            <p>{{ $license['description'] }}</p>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
