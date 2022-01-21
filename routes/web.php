<?php
use App\Http\Controllers\RutasController;
use App\Http\Controllers\ReportesController;

Route::get('/', [RutasController::class, 'inicio'])->middleware('guest');
Route::get('home',[RutasController::class,'home'])->name('home')->middleware('auth');
Route::get('unidades',[RutasController::class,'unidades'])->name('unidades')->middleware('auth');
Route::get('tecnicos',[RutasController::class,'tecnicos'])->name('tecnicos')->middleware('auth');

Route::get('ordenes',[RutasController::class,'ordenes'])->name('ordenes')->middleware('auth');
Route::get('addorden',[RutasController::class,'addorden'])->name('addorden')->middleware('auth');
Route::post('saveorden',[RutasController::class,'saveorden'])->name('saveorden')->middleware('auth');
Route::put('/updateEstado/{id}',[RutasController::class,'updateEstado'])->name('updateEstado')->middleware('auth');
Route::get('/editorden/{id}',[RutasController::class,'editorden'])->name('editorden')->middleware('auth');
Route::put('/editorden/{id}',[RutasController::class,'updateorden'])->name('updateorden')->middleware('auth');
Route::delete('/eliminarorden/{id}',[RutasController::class,'elimorden'])->name('eliminarorden')->middleware('auth');
Route::get('historialorden',[RutasController::class,'historialorden'])->name('historialorden')->middleware('auth');

Route::get('reportes',[RutasController::class,'reportes'])->name('reportes')->middleware('auth');
Route::get('addunidad',[RutasController::class,'addunidad'])->name('addunidad')->middleware('auth');
Route::get('addtecnico',[RutasController::class,'addtecnico'])->name('addtecnico')->middleware('auth');

Route::get('programacion',[RutasController::class,'programacion'])->name('programacion')->middleware('auth');
Route::get('addprogramacion',[RutasController::class,'addprogramacion'])->name('addprogramacion')->middleware('auth');
Route::post('saveprograma',[RutasController::class,'saveprograma'])->name('saveprograma')->middleware('auth');
Route::get('/editprograma/{id}',[RutasController::class,'editprograma'])->name('editprograma')->middleware('auth');
Route::put('/editprograma/{id}',[RutasController::class,'updateprograma'])->name('updateprograma')->middleware('auth');
Route::delete('eliminarprograma/{id}',[RutasController::class,'elimprograma'])->name('eliminarprograma')->middleware('auth');

Route::get('nodos',[RutasController::class,'nodos'])->name('nodos')->middleware('auth');
Route::get('addnodo',[RutasController::class,'addnodo'])->name('addnodo')->middleware('auth');
Route::post('savenodo',[RutasController::class,'savenodo'])->name('savenodo')->middleware('auth');
Route::get('/editnodo/{id}',[RutasController::class,'editnodo'])->name('editnodo')->middleware('auth');
Route::put('/editnodo/{id}',[RutasController::class,'updatenodo'])->name('updatenodo')->middleware('auth');
Route::delete('eliminarnodo/{id}',[RutasController::class,'elimnodo'])->name('eliminarnodo')->middleware('auth');

Route::get('historial',[RutasController::class,'historial'])->name('historial')->middleware('auth');
Route::get('addhistoria',[RutasController::class,'addhistoria'])->name('addhistoria')->middleware('auth');
Route::post('savehistoria',[RutasController::class,'savehistoria'])->name('savehistoria')->middleware('auth');
Route::get('/edithistoria/{id}',[RutasController::class,'edithistoria'])->name('edithistoria')->middleware('auth');
Route::put('/edithistoria/{id}',[RutasController::class,'updatehistoria'])->name('updatehistoria')->middleware('auth');
Route::delete('eliminarhistoria/{id}',[RutasController::class,'elimhistoria'])->name('eliminarhistoria')->middleware('auth');



Route::get('cobros',[RutasController::class,'cobros'])->name('cobros')->middleware('auth');
Route::get('addcobro',[RutasController::class,'addcobro'])->name('addcobro')->middleware('auth');
Route::post('savecobro',[RutasController::class,'savecobro'])->name('savecobro')->middleware('auth');
Route::put('/updateEstadoCobro/{id}',[RutasController::class,'updateestadocobro'])->name('updateEstadoCobro')->middleware('auth');
Route::get('/editcobro/{id}',[RutasController::class,'editcobro'])->name('editcobro')->middleware('auth');
Route::put('/editcobro/{id}',[RutasController::class,'updatecobro'])->name('updatecobro')->middleware('auth');
Route::delete('eliminarcobro/{id}',[RutasController::class,'elimcobro'])->name('eliminarcobro')->middleware('auth');

Route::post('saveunidad',[RutasController::class,'guardarunidad'])->name('saveunidad')->middleware('auth');
Route::get('/editunidad/{id}',[RutasController::class,'editunidad'])->name('editunidad')->middleware('auth');
Route::put('/editunidad/{id}',[RutasController::class,'updateunidad'])->name('updateunidad')->middleware('auth');
Route::delete('/eliminarunidad/{id}',[RutasController::class, 'elimunidad'])->name('eliminarunidad')->middleware('auth');

Route::post('savetecnico',[RutasController::class,'guardartecnico'])->name('savetecnico')->middleware('auth');
Route::get('/edittecnico/{id}',[RutasController::class, 'edittecnico'])->name('edittecnico')->middleware('auth');
Route::put('/edittecnico/{id}',[RutasController::class,'updatetecnico'])->name('updatetecnico')->middleware('auth');
Route::delete('/eliminartecnico/{id}',[RutasController::class, 'elimtecnico'])->name('eliminartecnico')->middleware('auth');

Route::post('saveusuario',[RutasController::class,'guardarusuario'])->name('saveusuario')->middleware('auth');

Route::post('/', [RutasController::class,'ingresar']);
Route::post('logout', [RutasController::class,'salir']);

Route::get('usuarios',[RutasController::class,'usuarios'])->name('usuarios')->middleware('auth');
Route::get('addusuario',[RutasController::class,'addusuario'])->name('addusuario')->middleware('auth');
Route::get('/editusuario/{id}', [RutasController::class,'editusuario'])->name('editusuario')->middleware('auth');
Route::put('/editarusuario/{id}',[RutasController::class,'updateusuario'])->name('updateusuario')->middleware('auth');
Route::delete('/eliminarusuario/{id}',[RutasController::class,'elimusuario'])->name('eliminarusuario')->middleware('auth');

Route::get('reportes',[ReportesController::class,'reportes'])->name('reportes')->middleware('auth');
Route::get('/imprimir/unidades',[ReportesController::class,'imprimirunidades'])->name('/unidades/imprimir')->middleware('auth');
Route::get('/imprimir/tecnicos',[ReportesController::class,'imprimirtecnicos'])->name('/tecnicos/imprimir')->middleware('auth');
Route::get('/imprimir/programas',[ReportesController::class,'imprimirprogramas'])->name('/programas/imprimir')->middleware('auth');
Route::post('/imprimir/ordenes',[ReportesController::class,'imprimirordenes'])->name('/ordenes/imprimir')->middleware('auth');
Route::get('/imprimir/nodos',[ReportesController::class,'imprimirnodos'])->name('/nodos/imprimir')->middleware('auth');
Route::get('/imprimir/historial',[ReportesController::class,'imprimirhistorial'])->name('/historial/imprimir')->middleware('auth');
Route::post('/imprimir/cobros',[ReportesController::class,'imprimircobros'])->name('/cobros/imprimir')->middleware('auth');