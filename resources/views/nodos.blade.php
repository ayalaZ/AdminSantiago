@extends('layout.plantilla')
@section('contenidoprincipal')
@php
    $user = Auth::user();
    $tipouser = $user->tipouser;
    @endphp
    @if ($tipouser == 1 || $tipouser === 2)
    <div class="container" style="padding-left: 150px;padding-top:50px;">
        <a href="{{ route('addnodo') }}" class="btn btn-outline-success btn-lg">Nuevo Registro</a>
        <hr>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="table-responsive">
            <table class="table" id="tabla">
                <thead>
                    <tr>
                        <th colspan="7">Listado de nodos</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Tranmisor</th>
                        <th>Receptor</th>
                        <th>Coordenadas</th>
                        <th>Distancia (km)</th>
                        <th>Procesos</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $num = 1;
                    @endphp
                    @foreach ($nodos as $item)
                        <tr>
                            <td><?php echo $num;
                            $num++; ?></td>
                            <th>{{ $item->nodo }}</th>
                            <td>{{ $item->tranmisor }}</td>
                            <td>{{ $item->receptor }}</td>
                            <td>{{ $item->coordenadas }}</td>
                            <td>{{ $item->distancia }}</td>
                            <td style="width: 20%"><a href="{{ route('editnodo', $item->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                |
                                <form action="{{ route('eliminarnodo', $item->id) }}" style="display:inline;"
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
