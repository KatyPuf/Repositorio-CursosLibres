<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Crud;
use App\Http\Livewire\EstudianteComponent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/home', function () {
    return view('home');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/NuevaInscripcion/{id}', [App\Http\Livewire\Planificaciones::class, 'newInscripcion'])->name('Inscripcion');
Route::get('/sendemail', [App\Http\Controllers\HomeController::class, 'sendEmail']);
//Route::get('validar/{tri}/{id}', [App\Http\Livewire\Inscripciones::class, 'validar']);

//Route Hooks - Do not delete//
Route::group(['middleware' => 'Administrador'], function () {
   

	Route::view('empresas_telefonicas', 'livewire.empresas-telefonicas.index')->middleware('auth');
	Route::view('aula_curso_profesor', 'livewire.aula-curso-profesors.index')->middleware('auth');
	Route::view('cursos_ejecutados', 'livewire.cursos-ejecutados.index')->middleware('auth');
	Route::view('inscripciones', 'livewire.inscripciones.index')->middleware('auth');
	Route::view('anyos_lectivos', 'livewire.anyos-lectivos.index')->middleware('auth');
	Route::view('trimestres', 'livewire.trimestres.index')->middleware('auth');
	Route::view('modalidades', 'livewire.modalidades.index')->middleware('auth');
	Route::view('aulas', 'livewire.aulas.index')->middleware('auth');
	Route::view('cursos', 'livewire.cursos.index')->middleware('auth');
	Route::view('profesores', 'livewire.profesores.index')->middleware('auth');
	Route::view('estudiantes', 'livewire.estudiantes.index')->middleware('auth');
	Route::view('usuarios', 'livewire.usuarios.index')->middleware('auth');
	Route::view('roles', 'livewire.roles.index')->middleware('auth');
	Route::get('/exportar/{id}', [App\Http\Controllers\HomeController::class, 'export']);
	Route::match(['get', 'post'], '/botman', [App\Http\Controllers\BotManController::class, 'handle']);
	Route::get('/image-upload', [App\Http\Livewire\Planificaciones::class, 'createForm']);
	Route::get('/VerificarEstudianteInscrito/{id}', [App\Http\Livewire\Planificaciones::class, 'VerificarEstudianteInscrito']);
	Route::post('/image-upload', [App\Http\Livewire\Planificaciones::class, 'fileUpload'])->name('imageUpload');

	});
	Route::view('mis_cursos', 'livewire.mis-cursos.index')->middleware('auth');
	Route::view('planificaciones', 'livewire.planificaciones.index')->middleware('auth');
	