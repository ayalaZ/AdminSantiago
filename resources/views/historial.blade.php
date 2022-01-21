@extends('layout.plantilla')
@section('contenidoprincipal')
@php
    $user = Auth::user();
    $tipouser = $user->tipouser;
    @endphp
    @if ($tipouser == 1 || $tipouser === 2)
    <div class="container" style="padding-left: 150px;padding-top:50px;">
        <a href="{{ route('addhistoria')}}" class="btn btn-outline-success btn-lg">Nuevo Registro</a>
        <hr>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
            <div class="table-responsive">
                <table class="table" id="tabla">
                    <thead>
                        <tr>
                            <th colspan="6">Historial de trabajos en nodos</th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Nodo</th>
                            <th>Tecnico</th>
                            <th>Fecha</th>
                            <th>Problema</th>
                            <th>Solucion</th>
                            <th>Parametros</th>
                            <th>Procesos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $num = 1;
                    @endphp
                    @foreach ($historia as $item)
                        <tr>
                            <td><?php echo $num; $num++; ?></td>
                            <td>{{ $item->nodos->nodo}}</td>
                            <td>{{$item->tecnicos->nombre}}</td>
                            <td>{{$item->fecha}}</td>
                            <td>{{$item->problema}}</td>
                            <td>{{$item->solucion}}</td>
                            <td>{{$item->parametros}}</td>
                            <td style="width: 20%"><a href="{{ route('edithistoria', $item->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                |
                                <form action="{{ route('eliminarhistoria', $item->id) }}" style="display:inline;"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
    </div>
    @else
    <div class="container" style="padding-left: 150px;padding-top:50px;">
        <div class="alert alert-danger">No tiene permisos para estar en esta seccion</div>
    </div>
    @endif
@endsection