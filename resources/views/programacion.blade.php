@extends('layout.plantilla')
@section('contenidoprincipal')
    <div class="container" style="padding-left: 150px;padding-top:50px;">
        <a href="{{ route('addprogramacion') }}" class="btn btn-outline-success btn-lg">Nuevo Registro</a>
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
                        <th colspan="6">Listado de programacion</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Responsable de unidad</th>
                        <th>Placa</th>
                        <th>Cantidad de trabajo</th>
                        <th>Procesos</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $num = 1;
                    @endphp
                    @foreach ($programa as $item)
                        <tr>
                            <td><?php echo $num;
                                $num++; ?></td>
                            <th>{{ $item->fecha }}</th>
                            <td>{{ $item->tecnicos->nombre}}</td>
                            <td>{{$item->unidades->placa}}</td>
                            <td style="text-align: center;font-weight:bold;font-size:20px">{{$item->cantidad}}</td>
                            <td><a href="{{ route('editprograma', $item->id) }}"
                                class="btn btn-warning btn-sm">Editar</a>
                            |
                            <form action="{{ route('eliminarprograma', $item->id) }}" style="display:inline;"
                                method="POST">
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
@endsection
