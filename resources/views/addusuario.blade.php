@extends('layout.plantilla')
<link rel="stylesheet" href="{{ asset('css/formularios.css') }}">
@section('contenidoprincipal')
@php
$user = Auth::user();
$tipouser = $user->tipouser;
@endphp
@if ($tipouser == 1)
<div class="container" style="padding-left: 150px;padding-top:10px;">
    <h3>Agregar Usuario</h3>
    <hr>
    @if (session('failed'))
        <div class="alert alert-danger">{{ session('failed') }}</div>
    @endif
    <form action="{{ route('saveusuario')}}" method="POST" id="formulariousuario" name="formulariousuario" class="form">
        @csrf
        <div class="form-group">
            <label for="name" class="form-label">Nickname</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="user@1994"
                tabindex="1"  autocomplete="off" autofocus value="{{ old('name')}}">
            <span style="color: red;">@error('name'){{ $message }}@enderror</span>
        </div>
        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Example@gmail.com"
            tabindex="2"  autocomplete="off" value="{{ old('email')}}">
            <span style="color: red;">@error('email'){{ $message }}@enderror</span>
        </div>
        <div class="form-group">
            <label for="password" class="form-label">Clave</label>
            <input type="password" name="password" id="password" class="form-control" tabindex="3"  autocomplete="off">
            <span style="color: red;">@error('password'){{ $message }}@enderror</span>
        </div>
        <div class="form-group">
            <label for="tipouser" class="form-label">Tipo de usuario</label>
            <select name="tipouser" id="tipouser" class="form-control" tabindex="4" >
                <option value="">Seleccion el tipo de usuario</option>
                <option value="1">Administrador</option>
                <option value="2">Monitor</option>
                <option value="3">Usuario</option>
            </select>
            <span style="color: red;">@error('tipouser'){{ $message }}@enderror</span>
        </div>
            <button type="submit" class="btn btn-outline-success btn-lg">Guardar</button>
    </form>
</div>
@else
<div class="container" style="padding-left: 150px;padding-top:50px;">
    <div class="alert alert-danger">No tiene permisos para estar en esta seccion</div>
</div>
@endif
    
@endsection