@extends('layout.plantilla')
@section('contenidoprincipal')
    <div class="container" style="padding-left: 150px;padding-top:50px;">
        <a href="{{ route('addcobro')}}" class="btn btn-outline-success btn-lg">Nuevo Registro</a>
        <hr>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
            <div class="table-responsive">
                <table class="table" id="tabla">
                    <thead>
                        <tr>
                            <th colspan="6">Cobros gestionados</th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Codigo</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Procesos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $num = 1; @endphp
                        @foreach ($cobros as $item)
                        @php $estado = $item->estado;@endphp
                            <tr>
                                <td><?php echo $num; $num++;?></td>
                                <td>{{$item->codigo}}</td>
                                <td>{{$item->fecha}}</td>
                                <td style="text-align:center;font-size:25px;">
                                    @if ($estado === 1)
                                        <i class="fas fa-dollar-sign" style="color:green"></i>
                                    @else
                                        <i class="fab fa-creative-commons-nc" style="color: red;margin:auto;"></i>
                                    @endif
                                </td>
                                <td style="width: 25%">
                                    <form action="{{ route('updateEstadoCobro', $item->id) }}" style="display:inline;"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-info btn-sm" type="submit">Estado</button>
                                    </form>
                                    | 
                                    <a href="{{ route('editcobro', $item->id) }}"
                                        class="btn btn-warning btn-sm">Editar</a>
                                    |
                                    <form action="{{ route('eliminarcobro', $item->id) }}" style="display:inline;"
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