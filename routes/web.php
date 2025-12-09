<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConductorController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LicenciaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\Recarga_CombustibleController;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\Tipo_VehiculoController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\ViajeController;

/*
|--------------------------------------------------------------------------
| Rutas Públicas
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
})->name('welcome');

Auth::routes();

/*
|--------------------------------------------------------------------------
| Rutas Protegidas (Requieren Autenticación)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Dashboard / Home
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Conductores
    Route::resource('conductores', ConductorController::class);
    Route::post('conductores/cambio-estado/{conductor}', [ConductorController::class, 'cambioEstado'])
        ->name('conductores.cambioEstado');

    // Contratos
    Route::resource('contratos', ContratoController::class);
    Route::post('contratos/{contrato}/cambio-estado', [ContratoController::class, 'cambioEstado'])
        ->name('contratos.cambio-estado');

    // Empresas
    Route::resource('empresas', EmpresaController::class);
    Route::post('empresas/{empresa}/cambio-estado', [EmpresaController::class, 'cambioEstado'])
        ->name('empresas.cambio-estado');

    // Licencias
    Route::resource('licencias', LicenciaController::class);
    Route::post('licencias/{licencia}/cambio-estado', [LicenciaController::class, 'cambioEstado'])
        ->name('licencias.cambio-estado');

    // Marcas
    Route::resource('marcas', MarcaController::class);
    Route::post('marcas/{marca}/cambio-estado', [MarcaController::class, 'cambioEstado'])
        ->name('marcas.cambio-estado');

    // Recarga de Combustibles
    Route::resource('recarga_combustibles', Recarga_CombustibleController::class);
    Route::post('recarga_combustibles/{recarga_combustible}/cambio-estado', [Recarga_CombustibleController::class, 'cambioEstado'])
        ->name('recarga_combustibles.cambio-estado');

    // Rutas (de viaje)
    Route::resource('rutas', RutaController::class);
    Route::post('rutas/{ruta}/cambio-estado', [RutaController::class, 'cambioEstado'])
        ->name('rutas.cambio-estado');

    // Tipos de Vehículo
    Route::resource('tipo_vehiculos', Tipo_VehiculoController::class);
    Route::post('tipo_vehiculos/{tipo_vehiculo}/cambio-estado', [Tipo_VehiculoController::class, 'cambioEstado'])
        ->name('tipo_vehiculos.cambio-estado');

    // Vehículos
    Route::resource('vehiculos', VehiculoController::class);
    Route::post('vehiculos/{id}/toggle-status', [VehiculoController::class, 'toggleStatus']);

    // Toggle status routes for all modules
    Route::post('marcas/{id}/toggle-status', [MarcaController::class, 'toggleStatus']);
    Route::post('conductores/{id}/toggle-status', [ConductorController::class, 'toggleStatus']);
    Route::post('contratos/{id}/toggle-status', [ContratoController::class, 'toggleStatus']);
    Route::post('empresas/{id}/toggle-status', [EmpresaController::class, 'toggleStatus']);
    Route::post('licencias/{id}/toggle-status', [LicenciaController::class, 'toggleStatus']);
    Route::post('tipo_vehiculos/{id}/toggle-status', [Tipo_VehiculoController::class, 'toggleStatus']);
    Route::post('recarga_combustibles/{id}/toggle-status', [Recarga_CombustibleController::class, 'toggleStatus']);
    Route::post('rutas/{id}/toggle-status', [RutaController::class, 'toggleStatus']);
    Route::post('viajes/{id}/toggle-status', [ViajeController::class, 'toggleStatus']);
    Route::post('vehiculos/{vehiculo}/cambio-estado', [VehiculoController::class, 'cambioEstado'])
        ->name('vehiculos.cambio-estado');

    // Viajes
    Route::resource('viajes', ViajeController::class);
    Route::post('viajes/{viaje}/cambio-estado', [ViajeController::class, 'cambioEstado'])
        ->name('viajes.cambio-estado');

    Route::get('/probar404', function () {
        abort(404);
    });

    Route::get('/probar500', function () {
        abort(500);
    });
    Route::get('/probar403', function () {
        abort(403);
    });
    Route::get('/probar419', function () {
        abort(419);
    });
});

/*
|--------------------------------------------------------------------------
| Fallback 404
|--------------------------------------------------------------------------
| Esta ruta captura cualquier URL no definida y muestra la página 404
*/

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});