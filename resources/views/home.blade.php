@extends('layout.plantilla')
@section('contenidoprincipal')
    @php
    use App\Models\cronograma;
    use App\Models\ordenes;
    use App\Models\tecnicos;
    use App\Models\cobros;
    @endphp
    <div class="container" style="padding-left: 150px;padding-top:10px;">
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-dark text-white mb-4">
                    <div class="card-body" style="text-align: center;border-bottom: 2px solid red; padding:5px;">
                        <h4>ORDENES</h4>
                    </div>
                    <div class="card-footer align-items-center justify-content-between" style="text-align: center">
                        @php
                            $ordenes = App\Models\ordenes::all()->count();
                        @endphp
                        <h4>{{ $ordenes }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-dark text-white mb-4">
                    <div class="card-body" style="text-align: center;border-bottom: 2px solid red; padding:5px;">
                        <h4>UNIDADES</h4>
                    </div>
                    <div class="card-footer align-items-center justify-content-between" style="text-align: center">
                        @php
                            $unidades = App\Models\unidades::all()->count();
                        @endphp
                        <h4>{{ $unidades }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-dark text-white mb-4">
                    <div class="card-body" style="text-align: center;border-bottom: 2px solid red; padding:5px;">
                        <h4>TECNICOS</h4>
                    </div>
                    <div class="card-footer align-items-center justify-content-between" style="text-align: center">
                        @php
                            $tecnicos = App\Models\tecnicos::all()->count();
                        @endphp
                        <h4>{{ $tecnicos }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-dark text-white mb-4">
                    <div class="card-body" style="text-align: center;border-bottom: 2px solid red; padding:5px;">
                        <h4>NODOS</h4>
                    </div>
                    <div class="card-footer align-items-center justify-content-between" style="text-align: center">
                        @php
                            $nodos = App\Models\nodos::all()->count();
                        @endphp
                        <h4>{{ $nodos }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @php
                date_default_timezone_set('America/El_Salvador');
                $fecha = date('Y-m-d');
                $cronograma = cronograma::all();
                $hoy = cronograma::where('fecha','=',$fecha)->first();
            @endphp
            @foreach ($cronograma as $item)
                @if ($item->fecha == $fecha)
                    @php
                        $tecnico = App\Models\tecnicos::findOrFail($item->idtecnico);
                        $ordenes = App\Models\ordenes::all();
                    @endphp
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th colspan="6">{{ $tecnico->nombre }}, {{ $item->fecha }}</th>
                                </tr>
                                <tr>
                                    <th>#</th>
                                    <th>Orden</th>
                                    <th>Tipo</th>
                                    <th>Municipio</th>
                                    <th>Descripcion</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $num = 1;
                                @endphp
                                @foreach ($ordenes as $item2)
                                    @php
                                        $estado = $item2->estado;
                                    @endphp
                                    @if ($item2->idprograma === $item->id)
                                        <tr>
                                            <td><?php echo $num;
                                            $num++; ?></td>
                                            <th>{{ $item2->orden }}</th>
                                            <td>{{ $item2->t_orden }}</td>
                                            <td>{{ $item2->municipio }}</td>
                                            <td>{{ $item2->descripcion }}</td>
                                            <td style="text-align: center;font-size:20px;">
                                                @if ($estado === 1)
                                                    <i class="fas fa-check-circle" style="color: green"></i>
                                                @else
                                                    <i class="fas fa-times" style="color: red"></i>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            @endforeach
            @if ($hoy === null)
                <div class="table-reponsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th colspan="6">No hay ordenes programada para hoy</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            @endif
        </div>
        <div class="row">
            @php
                date_default_timezone_set('America/El_Salvador');
                $fecha = date('Y-m-d');
                $cobros = cobros::all();
                $hoy = cobros::where('fecha','=',$fecha)->first();
            @endphp
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th colspan="3">Cobros para Hoy</th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Codigo</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
            @foreach ($cobros as $item)
                @if ($item->fecha === $fecha)
                @php $estado = $item->estado;@endphp
                    
                            
                                <tr>
                                    @php
                                        $num = 1;
                                    @endphp
                                    <td><?php echo $num;
                                        $num++; ?></td>
                                    <td>{{ $item->codigo }}</td>
                                    <td style="font-size:25px;">
                                        @if ($estado === 1)
                                            <i class="fas fa-dollar-sign" style="color:green"></i>
                                        @else
                                            <i class="fab fa-creative-commons-nc" style="color: red;margin:auto;"></i>
                                        @endif
                                    </td>
                                </tr>
                            
                        
                @endif
            @endforeach
        </tbody>
        </table>
    </div>
            @if ($hoy === null)
                <div class="table-reponsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th colspan="2">No hay cobros para hoy</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            @endif
        </div>
        <div class="row">
            @php
                $totalOrdenes = ordenes::all()->count();
                $ordenesRealizadas = ordenes::where('estado','=','1')->count();
                $porcentaje = round(($ordenesRealizadas * 100) / $totalOrdenes,2);
            @endphp
            <div class="alert alert-dark" role="alert">
                <h5>Porcentaje de ordenes realizadas; <strong>{{$porcentaje}}%</strong></h5>
                <div class="progress" style="padding: 0px!important;">
                    <div class="progress-bar bg-success" data-toggle='tooltip' data-placement='top' title='{{$ordenesRealizadas}} Ordenes ya realizadas' style='width:{{$porcentaje}}%;' aria-valuenow="{{$porcentaje}}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <div class="row">
            @php
                $totalCobros = cobros::all()->count();
                $cobrosReportados = cobros::where('estado','=','1')->count();
                $porcentaje = round(($cobrosReportados * 100) / $totalCobros,2);
            @endphp
            <div class="alert alert-dark" role="alert">
                <h5>Porcentaje de cobros reportados; <strong>{{$porcentaje}}%</strong></h5>
                <div class="progress" style="padding: 0px!important;">
                    <div class="progress-bar bg-danger" data-toggle="tooltip" data-placement="top" title="{{$cobrosReportados}} Cobros ya reportados" style='width:{{$porcentaje}}%;' aria-valuenow="{{$porcentaje}}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
