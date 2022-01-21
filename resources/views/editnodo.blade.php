@extends('layout.plantilla')
<link rel="stylesheet" href="{{ asset('css/formularios.css') }}">
@section('contenidoprincipal')
@php
    $user = Auth::user();
    $tipouser = $user->tipouser;
    @endphp
    @if ($tipouser == 1 || $tipouser === 2)
    <div class="container" style="padding-left: 150px;padding-top:10px;">
        <h3>Editar nodo</h3>
        <hr>
        @if (session('failed'))
            <div class="alert alert-danger">{{ session('failed') }}</div>
        @endif
        <form action="{{route('updatenodo',$nodo->id)}}" method="POST" id="formularionodo" name="formularionodo" class="form">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="nombre" class="form-label">Nombre del nodo</label>
                <input type="text" name="nombrenodo" id="nombrenodo" class="form-control" placeholder="Nodo" autocomplete="off" value="{{$nodo->nodo}}">
                <span style="color: red;">@error('nombrenodo'){{ $message }}@enderror</span>
            </div>
            <div class="form-group">
                <label for="Transmisor" class="form-label">Tranmisor</label>
                <input type="text" name="transmisor" id="transmisor" class="form-control" placeholder="T00:CH-00" autocomplete="off" value="{{$nodo->tranmisor}}">
                <span style="color: red;">@error('transmisor'){{ $message }}@enderror</span>
            </div>
            <div class="form-group">
                <label for="receptor" class="form-label">Receptor</label>
                <input type="text" name="receptor" id="receptor" class="form-control" placeholder="R00:CH-00" autocomplete="off" value="{{$nodo->receptor}}">
                <span style="color: red;">@error('receptor'){{ $message }}@enderror</span>
            </div>
            <div class="form-group">
                <label for="coordenadas" class="form-label">Coordenadas</label>
                <input type="text" name="coordenadas" id="coordenadas" class="form-control" placeholder="00.000000,-00.00000" autocomplete="off" value="{{$nodo->coordenadas}}">
                <span style="color: red;">@error('coordenadas'){{ $message }}@enderror</span>
            </div>
            <div class="form-group">
                <label for="distancia" class="form-label">Distancia</label>
                <input type="text" name="distancia" id="distancia" class="form-control" placeholder="00.00km" autocomplete="off" value="{{$nodo->distancia}}">
                <span style="color: red;">@error('distancia'){{ $message }}@enderror</span>
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
