<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::middleware('auth')->group(function () {
    Route::get('/kalendar', [App\Http\Controllers\CalendarController::class, 'calendar'])->name('kalendar');
    Route::post('/kalendar/apartName', [App\Http\Controllers\ApartmentController::class, 'getApartmentName'])->name('apartName');
    Route::post('/kalendar/reservations', [App\Http\Controllers\ReservationController::class, 'getReservations'])->name('getReservations');
});

Route::middleware('checkrole')->group(function () {
    Route::get('/administracija-korisnika', [App\Http\Controllers\UserAdministrationController::class, 'userAdministration'])->name('userAdministration');
    Route::post('/administracija-korisnika/getUserData', [App\Http\Controllers\UserAdministrationController::class, 'getUserData'])->name('getUserData');
    Route::post('/administracija-korisnika/deleteUser', [App\Http\Controllers\UserAdministrationController::class, 'deleteUser'])->name('deleteUser');
});

Auth::routes();

Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

