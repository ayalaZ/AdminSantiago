@extends('layout.plantilla')
<link rel="stylesheet" href="{{ asset('css/formularios.css') }}">
@section('contenidoprincipal')
    <div class="container" style="padding-left: 150px;padding-top:10px;">
        <h3>Agregar orden</h3>
        <hr>
        @if (session('failed'))
        <div class="alert alert-danger">{{ session('failed') }}</div>
    @endif
        <form action="{{ route('saveorden')}}" method="POST" id="formularioOrden" name="formularioOrden" class="form">
            @csrf
            <div class="form-group">
                <label for="numorden" class="form-label">Numero de orden</label>
                <input type="text" name="numorden" id="numorden"  autocomplete="off" class="form-control">
                <span style="color: red;">@error('numorden'){{ $message }}@enderror</span>
            </div>
            <div class="form-group">
                <label for="tipoOrden" class="form-label">Tipo de orden</label>
                <select name="tipoOrden" id="tipoOrden" class="form-control" >
                    <option value="">Seleccione una opcion</option>
                    <option value="( O )">Orden de revision</option>
                    <option value="( I )">Instalacion</option>
                    <option value="( R )">Reconexion</option>
                    <option value="( S )">Suspension</option>
                    <option value="( M )">Migracion</option>
                    <option value="( T )">Traslado</option>
                </select>
                <span style="color: red;">@error('tipoOrden'){{ $message }}@enderror</span>
            </div>
            <div class="form-group">
                <label for="municipio" class="form-label">Municipio</label>
                <select name="municipio" id="municipio" class="form-control"  style="width:100%;display:block;margin:300px;">
                    <option value="">Seleccione una opcion</option>
                    @foreach ($municipios as $item)
                        <option value="{{$item->municipio}}">{{$item->municipio}}</option>
                    @endforeach
                </select>
                <span style="color: red;">@error('municipio'){{ $message }}@enderror</span>
            </div>
            <div class="form-group">
                <label for="fechayencargado" class="form-label">Fecha y encargado</label>
                <select name="fechayencargado" id="fechayencargado" class="form-control"  style="width:100%;display:block;margin:300px;">
                    <option value="">Seleccione una opcion</option>
                    @foreach ($programas as $item)
                         <option value="{{ $item->id }}">{{ $item->tecnicos->nombre}}, {{ $item->fecha}}</option>
                    @endforeach
                </select>
                <span style="color: red;">@error('fechayencargado'){{ $message }}@enderror</span>
            </div>
            <div class="form-group">
                <label for="descripcion" class="form-label">Descripcion</label>
                <textarea rows="5" cols="50" name="descripcion" class="form-control" id="descripcion"
                      autocomplete="off" maxlength="100"></textarea>
                    <span style="color: red;">@error('descripcion'){{ $message }}@enderror</span>
            </div>
                <button type="submit" class="btn btn-outline-success btn-lg">Guardar</button>
        </form>
    </div>
@endsection