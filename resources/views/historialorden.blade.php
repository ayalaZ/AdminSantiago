@php
use App\Models\cronograma;
use App\Models\ordenes;
@endphp
@extends('layout.plantilla')
@section('contenidoprincipal')
    <div class="container" style="padding-left: 150px;padding-top:50px;">
        <h3>Historial de ordenes</h3>
        <hr>
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav nav flex-column" style="width: 100%!important">
                        @foreach ($programas as $item)
                            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">{{ $item->tecnicos->nombre }}, {{ $item->fecha }}   <span class="badge badge-primary badge-pill" style="background-color: #000;float: right;">{{ $item->cantidad}}</span></a>
                               <ul class="dropdown-menu" style="width: 100%;position: relative;">
                                @foreach ($ordenes as $item2)
                                @if ($item2->idprograma === $item->id)
                                    <li><a class="dropdown-item" href="#">{{ $item2->orden }} | {{ $item2->t_orden }} |
                                        {{ $item2->municipio }} | {{ $item2->descripcion }} |
                                        @php
                                            $estado = $item2->estado;
                                        @endphp
                                        @if ($estado === 1)
                                            <i class="fas fa-check-circle" style="color: green"></i>
                                        @else
                                            <i class="fas fa-times" style="color: red"></i>
                                        @endif</a></li>
                                @endif
                                @endforeach
                                </ul> 
                            </li>
                        @endforeach
                    </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
@endsection
