<?php
use Illuminate\Support\Facades\Auth;
$user = Auth::user();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reportes de unidades</title>
    <style>
        table{
            font-family: Arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        td, th{
            border: none;
            text-align: left;
            padding: 8px;
        }
        th{
            border-bottom: 1px solid #dddddd;
        }
        tr:nth-child(even){
            background-color: #dddddd;
        }
    </style>
</head>
<body>

    <h2 style="text-align: center;">LISTADO DE TECNICOS</h2>
    <p style="text-align: center;">{{$programa->tecnicos->nombre}}, {{$programa->fecha}} </p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Orden</th>
                <th>Tipo</th>
                <th>Descripcion</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @php $num = 1; @endphp
            @foreach ($ordenes as $item)
            @php
            $estado = $item->estado;
        @endphp
                <tr>
                    <td><?php echo $num; $num++;?></td>
                    <td>{{$item->orden}}</td>
                    <td>{{$item->t_orden}}</td>
                    <td>{{$item->descripcion}}</td>
                    <td>
                        @if ($estado === 1)
                        Realizada
                        @else
                        No realizada
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <footer>
        <p style="text-align: right">{{$user->name}} <strong>{{$fecha}}</strong></p>
    </footer>
</body>
</html>