@extends('layout.plantilla')
<link rel="stylesheet" href="{{ asset('css/formularios.css') }}">
@section('contenidoprincipal')
    <div class="container" style="padding-left: 150px;padding-top:10px;">
        <h3>Agregar Cobro</h3>
        <hr>
        @if (session('failed'))
            <div class="alert alert-danger">{{ session('failed') }}</div>
        @endif
        <form action="{{route('savecobro')}}" method="POST" id="formulariocobro" name="formulariocobro" class="form">
            @csrf
            <div class="form-group">
                <label for="codigo" class="form-label">Codigo</label>
                <input type="text" name="codigo" id="codigo" class="form-control" placeholder="00000" tabindex="1" 
                    autocomplete="off">
                    <span style="color: red;">@error('codigo'){{ $message }}@enderror</span>
            </div>
            <div class="form-group">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control" placeholder="00/00/0000" tabindex="2"
                     autocomplete="off">
                    <span style="color: red;">@error('fecha'){{ $message }}@enderror</span>
            </div>
            <button type="submit" class="btn btn-outline-success btn-lg">Guardar</button>
        </form>
    </div>
@endsection
