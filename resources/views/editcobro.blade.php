@extends('layout.plantilla')
<link rel="stylesheet" href="{{ asset('css/formularios.css') }}">
@section('contenidoprincipal')
    <div class="container" style="padding-left: 150px;padding-top:10px;">
        <h3>Editar Cobro</h3>
        <hr>
        @if (session('failed'))
            <div class="alert alert-danger">{{ session('failed') }}</div>
        @endif
        <form action="{{route('updatecobro', $cobro->id)}}" method="POST" id="formulariocobro" name="formulariocobro" class="form">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="codigo" class="form-label">Codigo</label>
                <input type="text" name="codigo" id="codigo" class="form-control"  tabindex="1" autocomplete="off" value="{{$cobro->codigo}}">
                    <span style="color: red;">@error('codigo'){{ $message }}@enderror</span>
            </div>
            <div class="form-group">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control" tabindex="2" autocomplete="off" value="{{$cobro->fecha}}">
                    <span style="color: red;">@error('fecha'){{ $message }}@enderror</span>
            </div>
            <button type="submit" class="btn btn-outline-warning btn-lg">Editar</button>
        </form>
    </div>
@endsection