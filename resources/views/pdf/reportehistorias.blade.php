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

    <h2 style="text-align: center;">LISTADO DE PROBLEMAS EN NODO</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nodo</th>
                <th>Tecnico</th>
                <th>Fecha</th>
                <th>Problema</th>
                <th>Solucion</th>
                <th>Parametros</th>
            </tr>
        </thead>
        <tbody>
            @php $num = 1; @endphp
            @foreach ($historias as $item)
                <tr>
                    <td><?php echo $num; $num++;?></td>
                    <td>{{$item->nodos->nodo}}</td>
                    <td>{{$item->tecnicos->nombre}}</td>
                    <td>{{$item->fecha}}</td>
                    <td>{{$item->problema}}</td>
                    <td>{{$item->solucion}}</td>
                    <td>{{$item->parametros}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <footer>
        <p style="text-align: right">{{$user->name}} <strong>{{$fecha}}</strong></p>
    </footer>
</body>
</html>