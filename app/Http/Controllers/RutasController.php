<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App;
use DB;
use App\Models\unidades;
use App\Models\tecnicos;
use App\Models\User;
use App\Models\cronograma;
use App\Models\ordenes;
use App\Models\municipios;
use App\Models\nodos;
use App\Models\historial;
use app\Models\cobros;

class RutasController extends Controller
{
    public function inicio()
    {
        return view('login');
    }
    public function home()
    {
        return view('home');
    }
    public function unidades()
    {
        $unidades = App\Models\unidades::all();
        return view('unidades', compact('unidades'));
    }
    public function tecnicos()
    {
        $tecnico = App\Models\tecnicos::all();
        return view('tecnicos', compact('tecnico'));
    }
    public function ordenes()
    {
        $ordenes = App\Models\ordenes::all();
        return view('ordenes', compact('ordenes'));
    }
    public function addorden()
    {
        $programas = App\Models\cronograma::all();
        $municipios = App\Models\municipios::all();
        return view('addorden', compact('programas', 'municipios'));
    }
    public function saveorden(Request $request)
    {
        $request->validate([
            'numorden' => ['required', 'string'],
            'tipoOrden' => ['required', 'string'],
            'municipio' => ['required', 'string'],
            'fechayencargado' => ['required'],
            'descripcion' => ['required', 'string', 'max:100']
        ]);
        $check = ordenes::where('orden', '=', $request->input('numorden'))->first();
        $datos = cronograma::where('id', '=', $request->input('fechayencargado'))->first()->toArray();
        if ($check === null && $datos != null) {
            $query = DB::table('ordenes')->insert([
                'orden' => $request->input('numorden'),
                't_orden' => $request->input('tipoOrden'),
                'municipio' => $request->input('municipio'),
                'idprograma' => $request->input('fechayencargado'),
                'idtecnico' => $datos['idtecnico'],
                'descripcion' => $request->input('descripcion')
            ]);
        } else {
            return back()->with('failed', 'Error ingresa datos duplicados :(');
        }

        if ($query) {
            $nuevacantidad = $datos['cantidad'] + 1;
            $cantidaddupdate = App\Models\cronograma::findOrFail($request->input('fechayencargado'));
            $cantidaddupdate->cantidad = $nuevacantidad;
            $cantidaddupdate->save();
            
        } else {
            return back()->with('failed', 'Error al ingresar el nuevo registro :(');
        }
    }
    public function updateEstado($id)
    {
        $orden = App\Models\ordenes::findOrFail($id);
        $estado = $orden->estado;
        if ($estado === 0) {
            $nuevoestado = 1;
        } else {
            $nuevoestado = 0;
        }

        $orden->estado = $nuevoestado;
        $orden->save();
        return redirect('ordenes')->with('success', 'Orden ' . $orden->orden . ' Cambio de estado! :)');
    }
    public function editorden($id)
    {
        $orden = App\Models\ordenes::findOrFail($id);
        $programa = App\Models\cronograma::all();
        return view('editorden', compact('orden', 'programa'));
    }
    public function updateorden(Request $request, $id)
    {
        $ordenupdate = App\Models\ordenes::findOrFail($id);
        $request->validate([
            'numorden' => ['required', 'string'],
            'tipoOrden' => ['required', 'string'],
            'municipio' => ['required', 'string'],
            'fechayencargado' => ['required'],
            'descripcion' => ['required', 'string', 'max:100']
        ]);
        $check = ordenes::where('orden', '=', $request->input('numorden'))->where('id', '!=', $id)->first();
        $datos = cronograma::where('id', '=', $request->input('fechayencargado'))->first()->toArray();
        if ($ordenupdate->idprograma != $datos['id']) {
            $nuevo = App\Models\cronograma::findOrFail($datos['id']);
            $anterior = App\Models\cronograma::findOrFail($ordenupdate->idprograma);

            $nuevacantidad = $datos['cantidad'] + 1;
            $anteriorcantidad = $anterior->cantidad - 1;

            $nuevo->cantidad = $nuevacantidad;
            $anterior->cantidad = $anteriorcantidad;
            $nuevo->save();
            $anterior->save();
        }
        if ($check === null && $datos != null) {
            $ordenupdate->orden = $request->numorden;
            $ordenupdate->t_orden = $request->tipoOrden;
            $ordenupdate->municipio = $request->municipio;
            $ordenupdate->idprograma = $request->fechayencargado;
            $ordenupdate->idtecnico = $datos['idtecnico'];
            $ordenupdate->descripcion = $request->descripcion;

            $ordenupdate->save();
            return redirect('ordenes')->with('success', 'Editado correctamente! :)');
        } else {
            return back()->with('failed', 'Error ingresa datos duplicados :(');
        }
    }
    public function elimorden($id)
    {
        $ordeneliminar = App\Models\ordenes::findOrFail($id);
        $programaupdate = App\Models\cronograma::findOrFail($ordeneliminar->idprograma);
        $programaupdate->cantidad = $programaupdate->cantidad - 1;
        $programaupdate->save();
        $ordeneliminar->delete();
        return redirect('ordenes')->with('success', 'Orden eliminado correctamente! :)');
    }
    public function historialorden()
    {
        $programas = App\Models\cronograma::all();
        $ordenes = App\Models\ordenes::all();
        return view('historialorden', compact('programas', 'ordenes'));
    }
    public function reportes()
    {
        return view('reportes');
    }
    public function addunidad()
    {
        return view('addunidad');
    }
    public function addtecnico()
    {
        return view('addtecnico');
    }
    public function programacion()
    {
        $programa = App\Models\cronograma::all();
        return view('programacion', compact('programa'));
    }
    public function addprogramacion()
    {
        $tecnico = App\Models\tecnicos::all();
        $unidad = App\Models\unidades::all();
        return view('addprogramacion', compact('tecnico', 'unidad'));
    }
    public function saveprograma(Request $request)
    {
        $request->validate([
            'fecha' => ['required', 'string'],
            'encargado' => ['required'],
            'placa' => ['required'],
        ]);
        $check = cronograma::where('fecha', '=', $request->input('fecha'))->where('idtecnico', '=', $request->input('encargado'))->first();
        if ($check === null) {
            $query = DB::table('cronogramas')->insert([
                'fecha' => $request->input('fecha'),
                'idtecnico' => $request->input('encargado'),
                'idunidad' => $request->input('placa')

            ]);
        } else {
            return back()->with('failed', 'Error ingresa datos duplicados :(');
        }

        if ($query) {
            return redirect('programacion')->with('success', 'Registrado correctamente! :)');
        } else {
            return back()->with('failed', 'Error al ingresar el nuevo registro :(');
        }
    }
    public function editprograma($id)
    {
        $programa = App\Models\cronograma::findOrFail($id);
        $tecnico = App\Models\tecnicos::all();
        $unidad = App\Models\unidades::all();
        return view('editprograma', compact('programa', 'tecnico', 'unidad'));
    }
    public function updateprograma(Request $request, $id)
    {
        $programadupdate = App\Models\cronograma::findOrFail($id);
        $request->validate([
            'fecha' => ['required', 'string'],
            'encargado' => ['required'],
            'placa' => ['required'],
        ]);
        $check = cronograma::where('fecha', '=', $request->input('fecha'))->where('idtecnico', '=', $request->input('encargado'))->where('id', '!=', $id)->first();
        if ($check ===  null) {

            $programadupdate->fecha = $request->fecha;
            $programadupdate->idtecnico = $request->encargado;
            $programadupdate->idunidad = $request->placa;

            $programadupdate->save();
            return redirect('programacion')->with('success', 'Editado correctamente! :)');
        } else {
            return back()->with('failed', 'Error ingresa datos duplicados :(');
        }
    }
    public function elimprograma($id)
    {
        $programaeliminar = App\Models\cronograma::findOrFail($id);
        if ($programaeliminar->cantidad === 0) {
            $programaeliminar->delete();
            return redirect('programacion')->with('success', 'Programa eliminado correctamente! :)');
        }else{
            return redirect('programacion')->with('faile', 'No se puede eliminar, cantidad tiene que estar en cero! :)');
        }
       
    }

    public function nodos(){
        $nodos  = App\Models\nodos::all();
        return view('nodos',compact('nodos'));
    }
    public function addnodo()
    {
        return view('addnodo');
    }
    public function savenodo(Request $request){
        $request->validate([
            'nombrenodo' => ['required', 'string'],
            'transmisor' => ['required', 'string'],
            'receptor' => ['required', 'string'],
            'coordenadas' => ['required', 'string'],
            'distancia' => ['required', 'string']
        ]);
        $nodo = nodos::where('nodo', '=', $request->input('nombrenodo'))->first();
        if ($nodo === null) {
            $query = DB::table('nodos')->insert([
                'nodo' => $request->input('nombrenodo'),
                'tranmisor' => $request->input('transmisor'),
                'receptor' => $request->input('receptor'),
                'coordenadas' => $request->input('coordenadas'),
                'distancia' => $request->input('distancia')

            ]);
        }else{
            return back()->with('failed', 'Error ingresa datos duplicados :(');
        }

        if ($query) {
            return redirect('nodos')->with('success', 'Registrado correctamente! :)');
        } else {
            return back()->with('failed', 'Error al ingresar el nuevo registro :(');
        }

    }
    public function editnodo($id){
        $nodo = App\Models\nodos::findOrFail($id);
        return view('editnodo', compact('nodo'));
    }
    public function updatenodo(Request $request, $id){
        $nodoupdate = App\Models\nodos::findOrFail($id);
        $request->validate([
            'nombrenodo' => ['required', 'string'],
            'transmisor' => ['required', 'string'],
            'receptor' => ['required', 'string'],
            'coordenadas' => ['required', 'string'],
            'distancia' => ['required', 'string']
        ]);
        $nodo = nodos::where('nodo', '=', $request->input('nombrenodo'))->where('id','!=',$id)->first();
        if ($nodo === null) {
            $nodoupdate->nodo = $request->nombrenodo;
            $nodoupdate->tranmisor = $request->transmisor;
            $nodoupdate->receptor = $request->receptor;
            $nodoupdate->coordenadas = $request->coordenadas;
            $nodoupdate->distancia = $request->distancia;

            $nodoupdate->save();
            return redirect('nodos')->with('success', 'Editado correctamente! :)');
        }else{
            return back()->with('failed', 'Error ingresa datos duplicados :(');
        }
    }
    public function elimnodo($id){
        $nodoeliminar = App\Models\nodos::findOrFail($id);
        $nodoeliminar->delete();
        return redirect('nodos')->with('success', 'Nodo eliminado correctamente! :)');
    }
    public function historial()
    {
        $historia = historial::all();
        return view('historial',compact('historia'));
    }
    public function addhistoria()
    {
        $tecnico = App\Models\tecnicos::all();
        $nodo = App\models\nodos::all();
        return view('addhistoria',compact('tecnico','nodo'));
    }
    public function savehistoria(Request $request){
        $request->validate([
            'nodo' => ['required'],
            'tecnico' => ['required'],
            'fecha' => ['required','string'],
            'problema' => ['required', 'string'],
            'solucion' => ['required', 'string'],
            'parametros' => ['required', 'string']
        ]);
        
        $query = DB::table('historials')->insert([
            'nodo' => $request->input('nodo'),
            'tecnico' => $request->input('tecnico'),
            'fecha' => $request->input('fecha'),
            'problema' => $request->input('problema'),
            'solucion' => $request->input('solucion'),
            'parametros' => $request->input('parametros'),    
        ]);

        if ($query) {
            return redirect('historial')->with('success', 'Registrado correctamente! :)');
        } else {
            return back()->with('failed', 'Error al ingresar el nuevo registro :(');
        }

    }
    public function edithistoria($id){
        $historia = App\Models\historial::findOrFail($id);
        $nodo = nodos::all();
        $tecnico = tecnicos::all(); 
        return view('edithistoria', compact('historia','nodo','tecnico'));
    }
    public function updatehistoria(Request $request, $id){
        $historiaupdate = App\Models\historial::findOrFail($id);
        $request->validate([
            'nodo' => ['required'],
            'tecnico' => ['required'],
            'fecha' => ['required','string'],
            'problema' => ['required', 'string'],
            'solucion' => ['required', 'string'],
            'parametros' => ['required', 'string']
        ]);
        $historiaupdate->nodo = $request->nodo;
        $historiaupdate->tecnico = $request->tecnico;
        $historiaupdate->fecha = $request->fecha;
        $historiaupdate->problema = $request->problema;
        $historiaupdate->solucion = $request->solucion;
        $historiaupdate->parametros = $request->parametros;

        $historiaupdate->save();
        return redirect('historial')->with('success', 'Editado correctamente! :)');
    }
    public function elimhistoria($id){
        $historiaeliminar = App\Models\historial::findOrFail($id);
        $historiaeliminar->delete();
        return redirect('historial')->with('success', 'Historia eliminada correctamente! :)');
    }
    public function cobros()
    {
        $cobros = App\Models\cobros::all();
        return view('cobros', compact('cobros'));
    }
    public function addcobro()
    {
        return view('addcobro');
    }
    public function savecobro(Request $request){
        $request->validate([
            'codigo' => ['required', 'string'],
            'fecha' => ['required', 'string'],
        ]);
        $cobros = App\Models\cobros::where('codigo','=',$request->input('codigo'))->where('fecha','=',$request->input('fecha'))->first();
        if ($cobros === null) {
            $query = DB::table('cobros')->insert([
                'codigo' => $request->input('codigo'),
                'fecha' => $request->input('fecha'),
            ]);
        }else{
            return back()->with('failed', 'Error ingresa datos duplicados :(');
        }

        if ($query) {
            return redirect('cobros')->with('success', 'Registrado correctamente! :)');
        } else {
            return back()->with('failed', 'Error al ingresar el nuevo registro :(');
        }
    }
    public function updateestadocobro($id){
        $cobro = App\Models\cobros::findOrFail($id);
        $estado = $cobro->estado;
        if ($estado === 0) {
            $nuevoestado = 1;
        } else {
            $nuevoestado = 0;
        }

        $cobro->estado = $nuevoestado;
        $cobro->save();
        return redirect('cobros')->with('success', 'Cobro del codigo ' . $cobro->codigo . ' Cambio de estado! :)');
    }
    public function editcobro($id){
        $cobro = App\Models\cobros::findOrFail($id);
        return view('editcobro', compact('cobro'));
    }
    public function updatecobro(Request $request, $id){
        $cobroupdate = App\Models\cobros::findOrFail($id);

        $request->validate([
            'codigo' => ['required', 'string'],
            'fecha' => ['required', 'string'],
        ]);
        $cobros = App\Models\cobros::where('codigo','=',$request->input('codigo'))->where('fecha','=',$request->input('fecha'))->where('id','!=',$id)->first();
        if ($cobros === null) {
            $cobroupdate->codigo = $request->codigo;
            $cobroupdate->fecha = $request->fecha;
            $cobroupdate->save();
            return redirect('cobros')->with('success', 'Editado correctamente! :)');
        }else{
            return back()->with('failed', 'Error ingresa datos duplicados :('); 
        }
    }
    public function elimcobro($id){
        $cobroeliminar = App\Models\cobros::findOrFail($id);
        $cobroeliminar->delete();
        return redirect('cobros')->with('success', 'Cobro eliminado correctamente! :)');
    }
    public function usuarios()
    {
        $usuarios = App\Models\User::all();
        return view('usuarios', compact('usuarios'));
    }
    public function addusuario()
    {
        return view('addusuario');
    }

    public function guardarunidad(Request $request)
    {
        $request->validate([
            'placa' => ['required', 'string'],
            'marca' => ['required', 'string'],
            'descripcion' => ['required', 'string'],
        ]);
        $placa = unidades::where('placa', '=', $request->input('placa'))->first();
        if ($placa === null) {
            $query = DB::table('unidades')->insert([
                'placa' => $request->input('placa'),
                'marca' => $request->input('marca'),
                'doble' => $request->input('doble'),
                'descripcion' => $request->input('descripcion')
            ]);
        } else {
            return back()->with('failed', 'Error ingresa datos duplicados :(');
        }

        if ($query) {
            return redirect('unidades')->with('success', 'Registrado correctamente! :)');
        } else {
            return back()->with('failed', 'Error al ingresar el nuevo registro :(');
        }
    }
    public function editunidad($id)
    {
        $unidad = App\Models\unidades::findOrFail($id);
        return view('editunidad', compact('unidad'));
    }
    public function updateunidad(Request $request, $id)
    {
        $unidadupdate = App\Models\unidades::findOrFail($id);

        $request->validate([
            'placa' => ['required', 'string'],
            'marca' => ['required', 'string'],
            'descripcion' => ['required', 'string'],
        ]);
        $placa = unidades::where('placa', '=', $request->input('placa'))->where('id', "!=", $id)->first();
        if ($placa === null) {
            $unidadupdate->placa = $request->placa;
            $unidadupdate->marca = $request->marca;
            $unidadupdate->doble = $request->doble;
            $unidadupdate->descripcion = $request->descripcion;

            $unidadupdate->save();
            return redirect('unidades')->with('success', 'Editado correctamente! :)');
        } else {
            return back()->with('failed', 'Error ingresa datos duplicados :(');
        }
    }
    public function elimunidad($id)
    {
        $unidadeliminar = App\Models\unidades::findOrFail($id);
        $programas = cronograma::where("idunidad",'=',$id)->first();
        if ($programas === null) {
            $unidadeliminar->delete();
            return redirect('unidades')->with('success', 'Unidad eliminada correctamente! :)');
        }else{
            return redirect('unidades')->with('faile', 'No se pudo eliminar; elementos relacionados! :)');
        }
        
    }

    public function guardartecnico(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string'],
            'apellido' => ['required', 'string'],
        ]);
        $query = DB::table('tecnicos')->insert([
            'nombre' => $request->input('nombre'),
            'apellido' => $request->input('apellido')
        ]);

        if ($query) {
            return redirect('tecnicos')->with('success', 'Registrado correctamente! :)');
        } else {
            return back()->with('failed', 'Error al ingresar el nuevo registro :(');
        }
    }
    public function edittecnico($id)
    {
        $tecnico = App\Models\tecnicos::findOrFail($id);
        return view('edittecnico', compact('tecnico'));
    }
    public function updatetecnico(Request $request, $id)
    {
        $tecnicoupdate = App\Models\tecnicos::findOrFail($id);
        $request->validate([
            'nombre' => ['required', 'string'],
            'apellido' => ['required', 'string'],
        ]);

        $tecnicoupdate->nombre = $request->nombre;
        $tecnicoupdate->apellido = $request->apellido;
        $tecnicoupdate->save();
        return redirect('tecnicos')->with('success', 'Editado correctamente! :)');
    }
    public function elimtecnico($id)
    {
        $tecnicoeliminar = App\Models\tecnicos::findOrFail($id);
        $programas = cronograma::where("idtecnico",'=',$id)->first();
        if ($programas === null) {
            $tecnicoeliminar->delete();
            return redirect('tecnicos')->with('success', 'Tecnico eliminado correctamente! :)');
        }else{
            return redirect('tecnicos')->with('faile', 'No se pudo eliminar; elementos relacionados! :)');
        }
        
    }
    public function guardarusuario(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'string'],
            'password' => ['required', 'string'],
            'tipouser' => ['required']
        ]);
        $nickname = User::where('name', "=", $request->input('name'))->first();
        $email = User::where('email', "=", $request->input('email'))->first();

        if ($nickname === null) {
            if ($email === null) {
                $query = DB::table('usuarios')->insert([
                    "name" => $request->input('name'),
                    "email" => $request->input('email'),
                    "password" => md5($request->input('password')),
                    'tipouser' => $request->input('tipouser')
                ]);
            } else {
                return back()->with('failed', 'Error ingresa datos duplicados :(');
            }
        } else {
            return back()->with('failed', 'Error ingresa datos duplicados :(');
        }

        if ($query) {
            return redirect('usuarios')->with('success', 'Registrado correctamente! :)');
        } else {
            return back()->with('failed', 'Error al ingresar el nuevo registro :(');
        }
    }

    public function ingresar(Request $request)
    {
        $credenciales =  $request->validate([
            'name' => ['required', 'string'],
            'password' => ['required', 'string']
        ]);

        $user = User::where('name', $request->only('name'))->first();
        if ($user === null) {
            return redirect('/')->with('status', 'Fallo al ingresar');
        } else {
            if ($user->password === md5($request->password)) {
                Auth::login($user);
                $user->update(['password' => Hash::make($request->password)]);
                $request->session()->regenerate();
                return redirect('home')->with('status', 'Bienvenido ');
            }
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                $request->session()->regenerate();
                return redirect('home')->with('status', 'Bienvenido ');
            }
        }
        throw ValidationException::withMessages([
            'name' => __('auth.failed'),
            'password' => __('auth.failed')
        ]);
    }
    public function salir()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/')->with('status', 'Vuelve Pronto');
    }
    public function editusuario($id)
    {
        $usuario = App\Models\User::findOrFail($id);
        return view('editusuario', compact('usuario'));
    }
    public function updateusuario(Request $request, $id)
    {
        $usuarioupdate = App\Models\User::findOrFail($id);
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'string'],
            'password' => ['required', 'string'],
            'tipouser' => ['required']
        ]);
        $nickname = User::where('name', "=", $request->input('name'))->where('id', "!=", $id)->first();
        $email = User::where('email', "=", $request->input('email'))->where('id', "!=", $id)->first();

        if ($nickname === null) {
            if ($email === null) {
                $usuarioupdate->name = $request->name;
                $usuarioupdate->email = $request->email;
                $usuarioupdate->password = md5($request->password);
                $usuarioupdate->tipouser = $request->tipouser;

                $usuarioupdate->save();
                return redirect('usuarios')->with('success', 'Editado correctamente! :)');
            } else {
                return back()->with('failed', 'Error ingresa datos duplicados :(');
            }
        } else {
            return back()->with('failed', 'Error ingresa datos duplicados :(');
        }
    }
    public function elimusuario($id)
    {
        $usuarioeliminar = App\Models\User::findOrFail($id);
        $usuarioeliminar->delete();
        return redirect('usuarios')->with('success', 'Usuario eliminado correctamente! :)');
    }
}
