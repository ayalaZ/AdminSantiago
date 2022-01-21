@extends('layout.plantilla')
<link rel="stylesheet" href="{{ asset('css/formularios.css') }}">
@section('contenidoprincipal')
    <div class="container" style="padding-left: 150px;padding-top:10px;">
        <h3>Editar programacion</h3>
        <hr>
        @if (session('failed'))
            <div class="alert alert-danger">{{ session('failed') }}</div>
        @endif
        <form action="{{ route('updateprograma',$programa->id)}}" method="POST" id="formularioprogramacion" name="formularioprogramacion" class="form">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control" placeholder="fecha del programa"
                    tabindex="1" autocomplete="off" value="{{ $programa->fecha }}">
                    <span style="color: red;">@error('fecha'){{ $message }}@enderror</span>
            </div>
            <div class="form-group">
                <label for="encargado" class="form-label">Encargado de unidad</label>
                <select name="encargado" id="encargado" class="form-control" tabindex="2">
                    <option value="">Seleccion encargado de unidad</option>
                    @foreach ($tecnico as $item)
                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                    @endforeach
                </select>
                <span style="color: red;">@error('encargado'){{ $message }}@enderror</span>
            </div>
            <div class="form-group">
                <label for="placa" class="form-label">Placa</label>
                <select name="placa" id="placa" class="form-control" tabindex="3">
                    <option value="">Seleccion la placa de la unidad</option>
                    @foreach ($unidad as $item)
                        <option value="{{ $item->id }}">{{ $item->placa }}</option>
                    @endforeach
                </select>
                <span style="color: red;">@error('placa'){{ $message }}@enderror</span>
            </div>
            <button type="submit" class="btn btn-outline-warning btn-lg">Editar</button>
        </form>
    </div>
@endsection
