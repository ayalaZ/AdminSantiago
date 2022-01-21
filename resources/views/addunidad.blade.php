@extends('layout.plantilla')
<link rel="stylesheet" href="{{ asset('css/formularios.css') }}">
@section('contenidoprincipal')
@php
$user = Auth::user();
$tipouser = $user->tipouser;
@endphp
@if ($tipouser == 1 || $tipouser === 2)
<div class="container" style="padding-left: 150px;padding-top:10px;">
    <h3>Agregar unidad</h3>
    <hr>
    @if (session('failed'))
        <div class="alert alert-danger">{{ session('failed') }}</div>
    @endif
    <form action="{{ route('saveunidad') }}" method="POST" id="formulariounidad" name="formulariounidad"
        class="form">
        @csrf
        <div class="form-group">
            <label for="placa" class="form-label">Placa</label>
            <input type="text" name="placa" id="placa" class="form-control" placeholder="Placa de la unidad"
                tabindex="1" required autocomplete="off" autofocus value="{{ old('placa')}}">
                <span style="color: red;">@error('placa'){{ $message }}@enderror</span>
        </div>
        <div class="form-group">
            <label for="marca" class="form-label">Marca</label>
            <input type="text" name="marca" id="marca" class="form-control" placeholder="Escriba la marca de la unidad"
                tabindex="2" required autocomplete="off" value="{{ old('marca')}}">
                <span style="color: red;">@error('marca'){{ $message }}@enderror</span>
        </div>
        <div class="form-group">
            <label for="4x4" class="form-label">Seleccione si la unidad es 4x4 </label><br>
            <div class="col-12">
                <input class="checkbox-tools" type="radio" name="doble" id="tool-1" value="Si">
                <label class="for-checkbox-tools" for="tool-1">
                    <i class="fas fa-check"></i>
                    Si
                </label>
                <input class="checkbox-tools" type="radio" name="doble" id="tool-2" value="No" checked>
                <label class="for-checkbox-tools" for="tool-2">
                    <i class="fas fa-times"></i>
                    No
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="descripcion" class="form-label">Descripcion</label>
            <textarea rows="5" cols="50" name="descripcion" class="form-control" id="descripcion"
                placeholder="Descripcion" tabindex="4" required autocomplete="off">{{ old('descripcion')}}</textarea>
                <span style="color: red;">@error('descripcion'){{ $message }}@enderror</span>
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
