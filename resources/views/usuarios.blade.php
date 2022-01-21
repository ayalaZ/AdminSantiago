@extends('layout.plantilla')
@section('contenidoprincipal')
    @php
    $user = Auth::user();
    $tipouser = $user->tipouser;
    @endphp
    @if ($tipouser === 1)
        <div class="container" style="padding-left: 150px;padding-top:50px;">
            <a href="{{ route('addusuario') }}" class="btn btn-outline-success btn-lg">Nuevo Registro</a>
            <hr>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="table-responsive">
                <table class="table" id="tabla">
                    <thead>
                        <tr>
                            <th colspan="6">Listado de usuarios</th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Nickname</th>
                            <th>Email</th>
                            <th>Tipo de usuario</th>
                            <th>Procesos</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $num = 1;
                        @endphp
                        @foreach ($usuarios as $item)
                            @php
                                $tipo = $item->tipouser;
                            @endphp
                            <tr>
                                <td><?php echo $num;
                                $num++; ?></td>
                                <th>{{ $item->name }}</th>
                                <td>{{ $item->email }}</td>
                                @if ($tipo == 1)
                                    <td>Administrador</td>
                                @else
                                    @if ($tipo == 2)
                                        <td>Monitor</td>
                                    @else
                                        <td>Usuario</td>
                                    @endif
                                @endif
                                <td><a href="{{ route('editusuario', $item->id) }}"
                                        class="btn btn-warning btn-sm">Editar</a>
                                    |
                                    <form action="{{ route('eliminarusuario', $item->id) }}" style="display:inline;"
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
