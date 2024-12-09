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

Route::get('/', function () {
    return redirect('/kalendar');
});


 Route::middleware('auth')->group(function () {
    // KALENDAR
    Route::get('/kalendar', [App\Http\Controllers\CalendarController::class, 'calendar'])->name('kalendar');
    Route::post('/kalendar/apartName', [App\Http\Controllers\ApartmentController::class, 'getApartmentName'])->name('apartName'); 
    Route::post('/kalendar/reservations', [App\Http\Controllers\ReservationController::class, 'getReservations'])->name('getReservations');
    Route::post('/kalendar/updateGuestRegistered', [App\Http\Controllers\ReservationController::class, 'updateGuestRegistered'])->name('updateGuestRegistered');
    Route::post('/kalendar/updateGuestPaid', [App\Http\Controllers\ReservationController::class, 'updateGuestPaid'])->name('updateGuestPaid');
    Route::post('/kalendar/updateGuestHasCar', [App\Http\Controllers\ReservationController::class, 'updateGuestHasCar'])->name('updateGuestHasCar');

    // REZERVACIJE
    Route::get('/rezervacije', [App\Http\Controllers\ReservationController::class, 'reservations'])->name('rezervacije');
    Route::post('/rezervacije/reservationsTable', [App\Http\Controllers\ReservationController::class, 'reservationsTable'])->name('reservationsTable');
    Route::post('/rezervacije/newReservation', [App\Http\Controllers\ReservationController::class, 'newReservation'])->name('newReservation');
    Route::post('/rezervacije/filtersReservations', [App\Http\Controllers\ReservationController::class, 'filtersReservations'])->name('filtersReservations');
    Route::post('/rezervacije/editReservation', [App\Http\Controllers\ReservationController::class, 'editReservation'])->name('editReservation');
    Route::post('/rezervacije/getReservationDataForEdit', [App\Http\Controllers\ReservationController::class, 'getReservationDataForEdit'])->name('getReservationDataForEdit');
    Route::post('/rezervacije/getDisabledDates', [App\Http\Controllers\ReservationController::class, 'getDisabledDates'])->name('getDisabledDates');

    // NOTIFIKACIJE
    Route::post('/getCheckedNotifications', [App\Http\Controllers\NotificationController::class, 'getCheckedNotifications'])->name('getCheckedNotifications')->middleware('auth');
    Route::post('/getAllCheckedNotifications', [App\Http\Controllers\NotificationController::class, 'getAllCheckedNotifications'])->name('getAllCheckedNotifications')->middleware('auth');


    // APARTMANI
    Route::get('/lista-apartmana', [App\Http\Controllers\ApartmentController::class, 'apartmentListPage'])->name('lista-apartmana');
    Route::post('/lista-apartmana/apartmentList', [App\Http\Controllers\ApartmentController::class, 'apartmentList'])->name('apartmentList');
    Route::get('/dodaj-apartman', [App\Http\Controllers\ApartmentController::class, 'addApartmentPage'])->name('addApartmentPage');
    Route::post('/dodaj-apartman/addApartment', [App\Http\Controllers\ApartmentController::class, 'addApartment'])->name('addApartment');
    Route::post('/dodaj-apartman/uploadPhoto', [App\Http\Controllers\ApartmentController::class, 'uploadImage'])->name('uploadImage');
    Route::post('/getApartDeailedInfo', [App\Http\Controllers\ApartmentController::class, 'getApartDeailedInfo'])->name('getApartDeailedInfo');

    //FINANSIJE
    Route::get('/lista-prihoda', [App\Http\Controllers\IncomeController::class, 'incomeListPage'])->name('lista-prihoda');
    Route::post('/lista-prihoda/saveNewExpence', [App\Http\Controllers\IncomeController::class, 'saveNewExpence'])->name('saveNewExpence');
    Route::post('/lista-prihoda/exportInvoiceTxt', [App\Http\Controllers\IncomeController::class, 'exportInvoiceTxt'])->name('exportInvoiceTxt');

});
// SUPERADMIN MIDLEWARE
Route::middleware('checkrole')->group(function () {
    // ADMINISTRACIJA KORISNIKA SA
    Route::get('/administracija-korisnika', [App\Http\Controllers\UserAdministrationController::class, 'userAdministration'])->name('userAdministration');
    Route::post('/administracija-korisnika/getUserData', [App\Http\Controllers\UserAdministrationController::class, 'getUserData'])->name('getUserData');
    Route::post('/administracija-korisnika/deleteUser', [App\Http\Controllers\UserAdministrationController::class, 'deleteUser'])->name('deleteUser');
    Route::post('/administracija-korisnika/getUserDataForEdit', [App\Http\Controllers\UserAdministrationController::class, 'getUserDataForEdit'])->name('getUserDataForEdit');
    Route::post('/administracija-korisnika/editUser', [App\Http\Controllers\UserAdministrationController::class, 'editUser'])->name('editUser');
    Route::get('/administracija-korisnika/permisije/{id}', [App\Http\Controllers\Permissions::class, 'permissionsPage'])->name('permissionsPage');
    Route::post('/administracija-korisnika/permisije/savePermissionChanges', [App\Http\Controllers\Permissions::class, 'savePermissionChanges'])->name('savePermissionChanges');

    // REZERVACIJE SA
    Route::post('/rezervacije/allowReservation', [App\Http\Controllers\ReservationController::class, 'allowReservation'])->name('allowReservation');
    Route::post('/rezervacije/deleteReservation', [App\Http\Controllers\ReservationController::class, 'deleteReservation'])->name('deleteReservation');

});

Auth::routes();

Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

