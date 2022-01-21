@extends('layout.plantilla')
@section('contenidoprincipal')
    <div class="container" style="padding-left: 150px;padding-top:50px;">
        <a href="{{ route('addorden') }}" class="btn btn-outline-success btn-lg">Nuevo Registro</a>
        <a href="{{ route('historialorden') }}" class="btn btn-outline-success btn-lg">Historial de ordenes</a>
        <hr>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="table-responsive">
            <table class="table table-hover" id="tabla">
                <thead>
                    <tr>
                        <th colspan="8">Listado de ordenes</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Orden</th>
                        <th>Tipo</th>
                        <th>Municipio</th>
                        <th>Datos</th>
                        <th>Descripcion</th>
                        <th>Estado</th>
                        <th>Procesos</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $num = 1;
                @endphp
                    @foreach ($ordenes as $item)
                        @php
                            $estado = $item->estado;
                        @endphp
                        <tr>
                            <td><?php echo $num;
                                $num++; ?></td>
                            <th>{{ $item->orden }}</th>
                            <td>{{ $item->t_orden }}</td>
                            <td>{{ $item->municipio }}</td>
                            <td>{{ $item->fecha->fecha}}, {{$item->tecnicos->nombre}}</td>
                            <td>{{ $item->descripcion }}</td>
                            <td style="text-align: center;font-size:20px;">@if ($estado === 1)
                                <i class="fas fa-check-circle" style="color: green"></i>
                            @else
                            <i class="fas fa-times" style="color: red"></i>
                            @endif</td>
                            <td style="width: 25%">
                                <form action="{{ route('updateEstado', $item->id) }}" style="display:inline;"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-info btn-sm" type="submit">Estado</button>
                                </form>
                                | 
                                <a href="{{ route('editorden', $item->id) }}"
                                    class="btn btn-warning btn-sm">Editar</a>
                                |
                                <form action="{{ route('eliminarorden', $item->id) }}" style="display:inline;"
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
@endsection
