@extends('layout.plantilla')
<link rel="stylesheet" href="{{ asset('css/formularios.css') }}">
@section('contenidoprincipal')
@php
    $user = Auth::user();
    $tipouser = $user->tipouser;
    @endphp
    @if ($tipouser == 1 || $tipouser === 2)
    <div class="container" style="padding-left: 150px;padding-top:10px;">
        <h3>Editar tecnico</h3>
        <hr>
        @if (session('failed'))
        <div class="alert alert-danger">{{ session('failed') }}</div>
    @endif
        <form action="{{ route('updatetecnico',$tecnico->id)}}" method="POST" id="formulariotecnico" name="formulariotecnico" class="form">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="nombre" class="form-label">Nombres</label>
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="nombre del tecnico"
                    tabindex="1" required autocomplete="off" value="{{ $tecnico->nombre }}">
                    <span style="color: red;">@error('nombre'){{ $message }}@enderror</span>
            </div>
            <div class="form-group">
                <label for="apellido" class="form-label">Apellidos</label>
                <input type="text" name="apellido" id="apellido" class="form-control" placeholder="apellido del tecnico"
                    tabindex="2" required autocomplete="off" value="{{ $tecnico->apellido }}">
                    <span style="color: red;">@error('apellido'){{ $message }}@enderror</span>
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
