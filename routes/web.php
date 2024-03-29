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
    Route::post('/kalendar/updateGuestRegistered', [App\Http\Controllers\ReservationController::class, 'updateGuestRegistered'])->name('updateGuestRegistered');
    Route::post('/kalendar/updateGuestPaid', [App\Http\Controllers\ReservationController::class, 'updateGuestPaid'])->name('updateGuestPaid');
    Route::post('/kalendar/updateGuestHasCar', [App\Http\Controllers\ReservationController::class, 'updateGuestHasCar'])->name('updateGuestHasCar');


    Route::get('/rezervacije', [App\Http\Controllers\ReservationController::class, 'reservations'])->name('rezervacije');
    Route::post('/rezervacije/reservationsTable', [App\Http\Controllers\ReservationController::class, 'reservationsTable'])->name('reservationsTable');
    Route::post('/rezervacije/newReservation', [App\Http\Controllers\ReservationController::class, 'newReservation'])->name('newReservation');

    Route::post('/getCheckedNotifications', [App\Http\Controllers\NotificationController::class, 'getCheckedNotifications'])->name('getCheckedNotifications')->middleware('auth');
    Route::post('/getAllCheckedNotifications', [App\Http\Controllers\NotificationController::class, 'getAllCheckedNotifications'])->name('getAllCheckedNotifications')->middleware('auth');

});

Route::middleware('checkrole')->group(function () {
    Route::get('/administracija-korisnika', [App\Http\Controllers\UserAdministrationController::class, 'userAdministration'])->name('userAdministration');
    Route::post('/administracija-korisnika/getUserData', [App\Http\Controllers\UserAdministrationController::class, 'getUserData'])->name('getUserData');
    Route::post('/administracija-korisnika/deleteUser', [App\Http\Controllers\UserAdministrationController::class, 'deleteUser'])->name('deleteUser');
    Route::post('/administracija-korisnika/getUserDataForEdit', [App\Http\Controllers\UserAdministrationController::class, 'getUserDataForEdit'])->name('getUserDataForEdit');
    Route::post('/administracija-korisnika/editUser', [App\Http\Controllers\UserAdministrationController::class, 'editUser'])->name('editUser');

    Route::post('/rezervacije/allowReservation', [App\Http\Controllers\ReservationController::class, 'allowReservation'])->name('allowReservation');
    Route::post('/rezervacije/deleteReservation', [App\Http\Controllers\ReservationController::class, 'deleteReservation'])->name('deleteReservation');
});

Auth::routes();

Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

