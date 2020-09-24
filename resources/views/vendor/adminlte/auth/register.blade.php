@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
@endif

@section('auth_header', __('adminlte::adminlte.register_message'))

@section('auth_body')
    <form action="{{ $register_url }}" method="post">
        {{ csrf_field() }}

        {{-- Name field --}}
        <div class="input-group mb-3">
            <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                   value="{{ old('name') }}" placeholder="{{ __('adminlte::adminlte.name') }}" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('name'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </div>
            @endif
        </div>
        {{-- Lastname field --}}
        <div class="input-group mb-3">
            <input type="text" name="lastname" class="form-control {{ $errors->has('lastname') ? 'is-invalid' : '' }}"
                   value="{{ old('lastname') }}" placeholder="{{ __('adminlte::adminlte.lastname') }}" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('lastname'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('lastname') }}</strong>
                </div>
            @endif
        </div>
        {{-- Country field --}}
        <div class="input-group mb-3">
            <select name="country" class="custom-select {{ $errors->has('country') ? 'is-invalid' : '' }}"
                   value="{{ old('country') }}" autofocus>
                <option value="">{{ __('adminlte::adminlte.country') }}</option>
                <option value="CL">CHILE</option>
                <option value="PA">PANAMÁ</option>
                <option value="PE">PERÚ</option>
            </select>
            @if($errors->has('country'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('country') }}</strong>
                </div>
            @endif
        </div>
        {{-- Type document field --}}
        <div class="input-group mb-3">
            <select name="type_document" class="custom-select {{ $errors->has('type_document') ? 'is-invalid' : '' }}"
                   value="{{ old('type_document') }}" autofocus>
                <option value="">{{ __('adminlte::adminlte.type_document') }}</option>
                <option value="01">CI/DNI</option>
                <option value="04">CARNÉ EXTRANJERÍA</option>
                <option value="07">PASAPORTE</option>
            </select>
            @if($errors->has('type_document'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('type_document') }}</strong>
                </div>
            @endif
        </div>
        {{-- Document field --}}
        <div class="input-group mb-3">
            <input type="text" name="document_number" class="form-control {{ $errors->has('document_number') ? 'is-invalid' : '' }}"
                   value="{{ old('document_number') }}" placeholder="{{ __('adminlte::adminlte.document_number') }}" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('document_number'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('document_number') }}</strong>
                </div>
            @endif
        </div>
        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                   value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('email'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </div>
            @endif
        </div>
        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password"
                   class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                   placeholder="{{ __('adminlte::adminlte.password') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('password'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </div>
            @endif
        </div>
        {{-- Confirm password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password_confirmation"
                   class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                   placeholder="{{ __('adminlte::adminlte.retype_password') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('password_confirmation'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </div>
            @endif
        </div>

        {{-- Register button --}}
        <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
            <span class="fas fa-user-plus"></span>
            {{ __('adminlte::adminlte.register') }}
        </button>

    </form>
@stop

@section('auth_footer')
    <p class="my-0">
        <a href="{{ $login_url }}">
            {{ __('adminlte::adminlte.i_already_have_a_membership') }}
        </a>
    </p>
@stop
