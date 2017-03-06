<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Route::group(['middleware' => ['auth', 'Administrador']], function(){
	Route::resource('usuario', 'usuarioController');
	Route::resource('persona', 'personaController');
	Route::resource('empleado', 'empleadoController');
	Route::resource('formacion', 'formacionController');
	Route::resource('familiar', 'familiarController');
	Route::resource('curso', 'cursoController');

	Route::get('persona/{indicador}/create', 'personaController@create')->name('persona.create');
	Route::get('persona/{indicador}/edit_withdown_save', 'personaController@edit_withdown_save')->name('persona.edit_withdown_save');
	Route::put('persona/{id}/update_withdown_save', 'personaController@update_withdown_save')->name('persona.update_withdown_save');

	Route::put('usuario/{indicador}/update_withdown_save', 'usuarioController@update_withdown_save')->name('usuario.update_withdown_save');
	Route::get('usuario/{indicador}/edit_withdown_save', 'usuarioController@edit_withdown_save')->name('usuario.edit_withdown_save');

	Route::get('empleado/{indicador}/create', 'empleadoController@create')->name('empleado.create');
	Route::get('formacion/{indicador}/create', 'formacionController@create')->name('formacion.create');
	Route::get('formacion/{indicador}/showToEdit', 'formacionController@showToEdit')->name('formacion.showToEdit');
	Route::get('familiar/{indicador}/create', 'familiarController@create')->name('familiar.create');
	Route::get('curso/{indicador}/create', 'cursoController@create')->name('curso.create');

	Route::get('usuario/{id}/destroy', 'usuarioController@destroy')->name('usuario.destroy');
});

Route::group(['middleware' => ['auth', 'Gerente']], function(){
	Route::resource('reunion', 'reunionController');
	Route::resource('actividad', 'actividadController');
	Route::resource('apoyo', 'apoyoController');
	Route::resource('inspeccion', 'inspeccionController');
	Route::resource('asignacion', 'asignacionController');
	Route::resource('documento', 'documentoController');
	Route::resource('actividad_empleado', 'actividad_empleadoController');

	Route::get('apoyo/{id_actividad}/create', 'apoyoController@create')->name('apoyo.create');
	Route::get('inspeccion/{id_actividad}/create', 'inspeccionController@create')->name('inspeccion.create');
	Route::get('asignacion/{id_actividad}/create', 'asignacionController@create')->name('asignacion.create');
	Route::get('documento/{id_actividad}/create', 'documentoController@create')->name('documento.create');
	Route::get('reunion/{id_actividad}/create', 'reunionController@create')->name('reunion.create');
	Route::get('actividad/{id}/destroy', 'actividadController@destroy')->name('actividad.destroy');
	Route::get('tareas/index', 'actividadController@index_gerente')->name('tareas.index');

});

Route::group(['middleware' => ['auth']], function(){
	Route::get('reunion/show/{id_actividad}', 'reunionController@show')->name('reunion.show');
	Route::get('apoyo/show/{id_actividad}', 'apoyoController@show')->name('apoyo.show');
	Route::get('inspeccion/show/{id_actividad}', 'inspeccionController@show')->name('inspeccion.show');
	Route::get('asignacion/show/{id_actividad}', 'asignacionController@show')->name('asignacion.show');
	Route::get('documento/show/{id_actividad}', 'documentoController@show')->name('documento.show');
	Route::get('tareas/{indicador}/index', 'actividadController@index')->name('empleado.tareas.index');
	Route::get('tareas/{id}/show/{tipo}', 'actividadController@show')->name('empleado.tareas.show');
	Route::get('/home', 'HomeController@index');
	
	Route::resource('publicacion', 'publicacionController');
	Route::resource('archivo', 'archivoController');
	Route::resource('notificacion', 'notificacionController');
	Route::resource('publico', 'publicoController');
	Route::resource('perfil', 'perfilController');
	Route::resource('comentario', 'comentarioController');
	Route::get('notificacion/{id}/update/{tipo}', 'notificacionController@update')->name('notificacion.update');
	Route::get('notificacion/destroy/{id_actividad}/{tipo}/{tipo_notificacion}', 'notificacionController@destroy')->name('notificacion.destroy');

	Route::get('archivo/destroy/{id_archivo}', 'archivoController@destroy')->name('archivo.destroy');

	Route::get('perfil/datos/show', 'perfilController@datos')->name('perfil.datos');
	
	Route::get('publicacion/destroy/{id_publicacion}', 'publicacionController@destroy')->name('publicacion.destroy');

	Route::get('archivo/subidos/{indicador}', 'archivoController@subidos')->name('archivo.subidos');
	
	Route::get('calendario/actividades/{indicador}/', 'actividadController@getAll')->name('actividad.getAll');

	Route::get('actividad/showModal/{id_actividad}/', 'actividadController@showModal')->name('actividad.showModal');

	Route::get('archivo/descargar/{url}', 'archivoController@descargar')->name('archivo.descargar');

});
Route::auth();

