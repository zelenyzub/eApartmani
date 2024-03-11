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
    return view('welcome');
});

Route::get('/kalendar', [App\Http\Controllers\CalendarController::class, 'calendar'])->name('kalendar');
Route::post('/kalendar/apartName', [App\Http\Controllers\ApartmentController::class, 'getApartmentName'])->name('apartName');

