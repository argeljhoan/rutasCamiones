<?php

use App\Http\Controllers\Usuarios\GestionController;
use App\Http\Controllers\Vehiculos\VehiculoGestionController;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/Usuarios/Gestion', [GestionController::class, 'index'])->name('Users.Gestion');
Route::get('/Usuarios/Registrar', [GestionController::class, 'create'])->name('Users.Registro');
Route::post('/Usuarios/Registrar', [GestionController::class,'store'])->name('Users.store');
Route::get('/Usuarios/Editar/{user}', [GestionController::class,'edit'])->name('Users.Editar');
Route::put('/Usuarios/Editar/{user}', [GestionController::class,'update'])->name('Users.Actualizar');
Route::delete('/Usuarios/Eliminar/{user}', [GestionController::class,'destroy'])->name('Users.Destroy');



Route::get('/Vehiculos/Gestion', [VehiculoGestionController::class, 'index'])->name('Vehiculos.Gestion');
Route::get('/Vehiculos/Registrar', [VehiculoGestionController::class, 'create'])->name('Vehiculos.Registro');
Route::post('/Vehiculos/Registrar', [VehiculoGestionController::class,'store'])->name('Vehiculos.store');
Route::put('/Vehiculos/Editar/{camion}', [VehiculoGestionController::class,'update'])->name('Vehiculos.Actualizar');
Route::put('/Vehiculos/Asignar/{camion}', [VehiculoGestionController::class,'asignar'])->name('Vehiculos.Asignar');