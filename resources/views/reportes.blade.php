@php
use App\Models\cronograma;
@endphp
@extends('layout.plantilla')
@section('contenidoprincipal')

    <div class="container" style="padding-left: 150px;padding-top:50px;">
        <h3>Reportes</h3>
        <hr>
        <div class="alert alert-dark" role="alert">
            <h4 class="alert-heading">Unidades</h4>
            <p>Si desea imprimir el reporte acerca de las unidades registradas solo de click en el boton imprimir.</p>
            <hr>
            <p class="mb-0"><a href="{{ route('/unidades/imprimir') }}" class="btn btn-sm btn-danger"
                    target="_blank">Imprimir</a></p>
        </div>
        <div class="alert alert-dark" role="alert">
            <h4 class="alert-heading">Tecnicos</h4>
            <p>Si desea imprimir el reporte acerca de las tecnicos registrados solo de click en el boton imprimir.</p>
            <hr>
            <p class="mb-0"><a href="{{ route('/tecnicos/imprimir') }}" class="btn btn-sm btn-danger"
                    target="_blank">Imprimir</a></p>
        </div>
        <div class="alert alert-dark" role="alert">
            <h4 class="alert-heading">Programas</h4>
            <p>Si desea imprimir el reporte acerca de los programas registrados solo de click en el boton imprimir.</p>
            <hr>
            <p class="mb-0"><a href="{{ route('/programas/imprimir') }}" class="btn btn-sm btn-danger"
                    target="_blank">Imprimir</a></p>
        </div>
        <div class="alert alert-dark" role="alert">
            <h4 class="alert-heading">Ordenes</h4>
            <p>Si desea imprimir el reporte acerca de las ordenes registradas primero selecciones la fecha y tecnico y
                despues de click en el boton imprimir.</p>
            <hr>
            <p class="mb-0">
                @php
                    $programas = App\Models\cronograma::all();
                @endphp
            <form action="{{ route('/ordenes/imprimir') }}" style="display:inline;" method="POST" target="_blank">
                <select name="fechayencargado" id="fechayencargado" class="form-control"
                    style="width:25%;display:block;margin:300px;">
                    @foreach ($programas as $item)
                        <option value="{{ $item->id }}">{{ $item->tecnicos->nombre }}, {{ $item->fecha }}</option>
                    @endforeach
                </select>
                @csrf
                <button class="btn btn-danger btn-sm" type="submit">Imprimir</button>
            </form>
        </div>
        <div class="alert alert-dark" role="alert">
            <h4 class="alert-heading">Nodos</h4>
            <p>Si desea imprimir el reporte acerca de los nodos registrados solo de click en el boton imprimir.</p>
            <hr>
            <p class="mb-0"><a href="{{ route('/nodos/imprimir') }}" class="btn btn-sm btn-danger"
                    target="_blank">Imprimir</a></p>
        </div>
        <div class="alert alert-dark" role="alert">
            <h4 class="alert-heading">Historial</h4>
            <p>Si desea imprimir el reporte acerca de las bitacoras registradas solo de click en el boton imprimir.</p>
            <hr>
            <p class="mb-0"><a href="{{ route('/historial/imprimir') }}" class="btn btn-sm btn-danger"
                    target="_blank">Imprimir</a></p>
        </div>
        <div class="alert alert-dark" role="alert">
            <h4 class="alert-heading">Cobros</h4>
            <p>Si desea imprimir el reporte acerca de los cobros registrados primero selecciones la fecha y despues de click
                en el boton imprimir.</p>
            <hr>
            <p class="mb-0">
                @php
                    date_default_timezone_set('America/El_Salvador');
                    $fecha = date('Y-m-d');
                @endphp
            <form action="{{ route('/cobros/imprimir') }}" style="display:inline;" method="POST" target="_blank">
                @csrf
                <input type="date" name="fecha" id="fecha" value='{{$fecha}}' class="form-control" style="width: 25%;display:inline;" value='31/10/2021'>
                <button class="btn btn-danger btn-sm" type="submit">Imprimir</button>
            </form>
        </div>
    </div>
@endsection
