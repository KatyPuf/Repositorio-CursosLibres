<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Crud;
use App\Http\Livewire\EstudianteComponent;
use App\Http\Controllers\HomeController;
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
//Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/prueba', [App\Http\Controllers\HomeController::class, 'prueba'])->name('prueba');

Route::get('/NuevaInscripcion/{id}', [App\Http\Livewire\Planificaciones::class, 'newInscripcion'])->name('Inscripcion');
Route::get('/sendemail', [App\Http\Controllers\HomeController::class, 'sendEmail']);
//Route::get('validar/{tri}/{id}', [App\Http\Livewire\Inscripciones::class, 'validar']);


Route::group(['middleware'=> ['role:Administrador|Super-admin|Editor']], function () {
   

	Route::view('empresas_telefonicas', 'livewire.empresas-telefonicas.index')->middleware('auth');
	Route::view('aula_curso_profesor', 'livewire.aula-curso-profesors.index')->middleware('auth');
	Route::view('cursos_ejecutados', 'livewire.cursos-ejecutados.index')->middleware('auth');
	Route::view('inscripciones', 'livewire.inscripciones.index')->middleware('auth');
	Route::view('inscripciones2', 'livewire.inscripciones2.index')->middleware('auth');
	Route::view('anyos_lectivos', 'livewire.anyos-lectivos.index')->middleware('auth');
	Route::view('trimestres', 'livewire.trimestres.index')->middleware('auth');
	Route::view('modalidades', 'livewire.modalidades.index')->middleware('auth');
	Route::view('aulas', 'livewire.aulas.index')->middleware('auth');
	Route::view('cursos', 'livewire.cursos.index')->middleware('auth');
	Route::view('profesores', 'livewire.profesores.index')->middleware('auth');
	Route::view('estudiantes', 'livewire.estudiantes.index')->middleware('auth');
	Route::view('CopiaSeguridad', 'livewire.backups.index')->middleware('auth');
	Route::view('restaurar', 'livewire.restaurars.index' )->middleware('auth');

	Route::get('/exportar/{id}', [App\Http\Controllers\HomeController::class, 'export']);
	Route::get('/bienvenida', [App\Http\Controllers\HomeController::class, 'generatePDF']);
	Route::match(['get', 'post'], '/botman', [App\Http\Controllers\BotManController::class, 'handle']);
	Route::get('/image-upload', [App\Http\Livewire\Planificaciones::class, 'createForm']);
	Route::get('/VerificarEstudianteInscrito/{id}', [App\Http\Livewire\Planificaciones::class, 'VerificarEstudianteInscrito']);
	Route::post('/image-upload', [App\Http\Livewire\Planificaciones::class, 'fileUpload'])->name('imageUpload');
	//Route::view('reportes', 'livewire.reportes.index')->middleware('auth');
	});
	Route::group(['middleware'=> ['role:Super-admin']], function () {
		Route::view('usuarios', 'livewire.usuarios.index')->middleware('auth');
		Route::view('roles', 'livewire.roles.index')->middleware('auth');
		Route::view('permisos', 'livewire.permisos.index')->middleware('auth');
	});

	Route::group(['middleware'=> ['role:Administrador|Super-admin|Consultor|Editor']], function () {
		Route::view('reportes', 'livewire.reportes.index')->middleware('auth');

	});

	Route::view('mis_cursos', 'livewire.mis-cursos.index')->middleware('auth');
	Route::view('planificaciones', 'livewire.planificaciones.index')->middleware('auth');
	Route::get('/backup_database', [App\Http\Controllers\HomeController::class, 'backup_database']) ->name('backup_database');
    Route::post('/restoreDatabase', [App\Http\Controllers\HomeController::class, 'restoreDatabase']) ->name('restoreDatabase');
	

	Route::get('/backup', function() {
		$exit  = Artisan::call('backup:run --disable-notifications');
		return Artisan::output();
	});

	Route::get('/backup-partial', function() {
		$exit  = Artisan::call('backup:run --only-db --disable-notifications');
		
		return Artisan::output();
	});

	Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');