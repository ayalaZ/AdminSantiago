@extends('layout.plantilla')

@section('contenidoprincipal')
    @php
    $user = Auth::user();
    $tipouser = $user->tipouser;
    @endphp
    @if ($tipouser == 1 || $tipouser === 2)
        <div class="container" style="padding-left: 150px;padding-top:50px;">
            <a href="{{ route('addunidad') }}" class="btn btn-outline-success btn-lg">Nuevo Registro</a>
            <hr>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('faile'))
                <div class="alert alert-danger">{{ session('faile') }}</div>
            @endif
            <div class="table-responsive">
                <table class="table" id="tabla">
                    <thead>
                        <tr>
                            <th colspan="6">Listado de unidades</th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Placa</th>
                            <th>Marca</th>
                            <th>4x4</th>
                            <th style="width: 50%">Descripcion</th>
                            <th>Procesos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $num = 1;
                        @endphp
                        @foreach ($unidades as $item)
                            <tr>
                                <td><?php echo $num;
                                    $num++; ?></td>
                                <th>{{ $item->placa }}</th>
                                <td>{{ $item->marca }}</td>
                                <td>{{ $item->doble }}</td>
                                <td>{{ $item->descripcion }}</td>
                                <td><a href="{{ route('editunidad', $item->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                    |
                                    <form action="{{ route('eliminarunidad', $item->id) }}" style="display:inline!important;" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                                    </form></td>
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
