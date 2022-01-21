<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use PDF;
use DB;

class ReportesController extends Controller
{
    public function reportes(){
        return view('reportes');
    }
    public function imprimirunidades(){
        $unidades = App\Models\unidades::all();
        date_default_timezone_set('America/El_Salvador');
        $fecha = date('d/m/Y');
        $data = compact('unidades','fecha');
        $pdf = PDF::loadView('pdf.reporteunidades', $data);
        return $pdf->stream();
    }
    public function imprimirtecnicos(){
        $tecnicos = App\Models\tecnicos::all();
        date_default_timezone_set('America/El_Salvador');
        $fecha = date('d/m/Y');
        $data = compact('tecnicos','fecha');
        $pdf = PDF::loadView('pdf.reportetecnico', $data);
        return $pdf->stream();
    }
    public function imprimirprogramas(){
        $programa = App\Models\cronograma::all();
        date_default_timezone_set('America/El_Salvador');
        $fecha = date('d/m/Y');
        $data = compact('programa','fecha');
        $pdf = PDF::loadView('pdf.reporteprogramas', $data);
        return $pdf->stream();
    }
    public function imprimirordenes(Request $request){
        $ordenes = App\Models\ordenes::where('idprograma','=', $request->fechayencargado)->get();
        $programa = App\Models\cronograma::findOrFail($request->fechayencargado);
        date_default_timezone_set('America/El_Salvador');
        $fecha = date('d/m/Y');
        $data = compact('ordenes','fecha','programa');
        $pdf = PDF::loadView('pdf.reporteordenes', $data);
        return $pdf->stream();
    }
    public function imprimirnodos(){
        $nodos = App\Models\nodos::all();
        date_default_timezone_set('America/El_Salvador');
        $fecha = date('d/m/Y');
        $data = compact('nodos','fecha');
        $pdf = PDF::loadView('pdf.reportenodos', $data);
        return $pdf->stream();
    }
    public function imprimirhistorial(){
        $historias = App\Models\historial::all();
        date_default_timezone_set('America/El_Salvador');
        $fecha = date('d/m/Y');
        $data = compact('historias','fecha');
        $pdf = PDF::loadView('pdf.reportehistorias', $data);
        return $pdf->stream();
    }
    public function imprimircobros(Request $request){
        $cobros = App\Models\cobros::where('fecha','=', $request->fecha)->get();
        date_default_timezone_set('America/El_Salvador');
        $fecha = date('d/m/Y');
        $data = compact('cobros','fecha');
        $pdf = PDF::loadView('pdf.reportecobros', $data);
        return $pdf->stream();
    }
}
