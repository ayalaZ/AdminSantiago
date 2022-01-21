@extends('layout.plantilla')

@section('contenidoprincipal')
@php
    $user = Auth::user();
    $tipouser = $user->tipouser;
    @endphp
    @if ($tipouser == 1 || $tipouser === 2)
    <div class="container" style="padding-left: 150px;padding-top:50px;">
        <a href="{{ route('addtecnico')}}" class="btn btn-outline-success btn-lg">Nuevo Registro</a>
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
                            <th colspan="6">Listado de tecnicos</th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Procesos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $num = 1;
                    @endphp
                        @foreach ($tecnico as $item)
                            <tr>
                                <td><?php echo $num;
                                    $num++; ?></td>
                                <th>{{ $item->nombre}}</th>
                                <td>{{ $item->apellido}}</td>
                                <td style="width: 20%"><a href="{{ route('edittecnico', $item->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                    |
                                    <form action="{{ route('eliminartecnico', $item->id) }}" style="display:inline!important;" method="POST" class="d-inline">
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