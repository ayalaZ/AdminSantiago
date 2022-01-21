@extends('layout.plantilla')
<link rel="stylesheet" href="{{ asset('css/formularios.css') }}">
@section('contenidoprincipal')
@php
    $user = Auth::user();
    $tipouser = $user->tipouser;
    @endphp
    @if ($tipouser == 1 || $tipouser === 2)
    <div class="container" style="padding-left: 150px;padding-top:10px;">
        <h3>Editar Historia</h3>
        <hr>
        @if (session('failed'))
            <div class="alert alert-danger">{{ session('failed') }}</div>
        @endif
        <form action="{{route('updatehistoria',$historia->id)}}" method="POST" id="formulariohistorial" name="formulariohistorial" class="form">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="nodo" class="form-label">Nodo</label>
                <select name="nodo" id="nodo" class="form-control" tabindex="1">
                    <option value="">Seleccion una opcion</option>
                    @foreach ($nodo as $item)
                        <option value="{{ $item->id }}">{{ $item->nodo }}</option>
                    @endforeach
                </select>
                <span style="color: red;">@error('nodo'){{ $message }}@enderror</span>
            </div>
            <div class="form-group">
                <label for="tecnico" class="form-label">Tecnico</label>
                <select name="tecnico" id="tecnico" class="form-control" tabindex="2">
                    <option value="">Seleccion una opcion</option>
                    @foreach ($tecnico as $item)
                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                    @endforeach
                </select>
                <span style="color: red;">@error('tecnico'){{ $message }}@enderror</span>
            </div>
            <div class="form-group">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control" autocomplete="off" tabindex="3" value="{{ $historia->fecha }}">
                <span style="color: red;">@error('fecha'){{ $message }}@enderror</span>
            </div>
            <div class="form-group">
                <label for="problema" class="form-label">Problema</label>
                <input type="text" name="problema" id="problema" class="form-control" placeholder="Problema surgido"
                    tabindex="4"  autocomplete="off" value="{{$historia->problema}}">
                    <span style="color: red;">@error('problema'){{ $message }}@enderror</span>
            </div>
            <div class="form-group">
                <label for="solucion" class="form-label">Solucion</label>
                <input type="text" name="solucion" id="solucion" class="form-control"
                    placeholder="Describa la solicion del problema" tabindex="5"  autocomplete="off" value="{{$historia->solucion}}">
                    <span style="color: red;">@error('solucion'){{ $message }}@enderror</span>
            </div>
            <div class="form-group">
                <label for="parametros" class="form-label">Parametros</label>
                <input type="text" name="parametros" id="parametros" class="form-control" placeholder="TX:00,RX:00,SNR:00"
                    tabindex="6" autocomplete="off" value="{{$historia->parametros}}">
                    <span style="color: red;">@error('parametros'){{ $message }}@enderror</span>
            </div>
            <button type="submit" class="btn btn-outline-warning btn-lg">Editar</button>
        </form>
    </div>
    @else
    <div class="container" style="padding-left: 150px;padding-top:50px;">
        <div class="alert alert-danger">No tiene permisos para estar en esta seccion</div>
    </div>
    @endif
@endsection