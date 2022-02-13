<?php

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

use App\Http\Controllers\EventController;

Route::get('/', [EventController::class, 'index'])->name('events');

Route::get('/events/create', [EventController::class, 'create'])->name('events.create')->middleware('auth');
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show')->where('id', '[0-9]+');
Route::post('/events/store', [EventController::class, 'store'])->name('events.store');
Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy')->where('id', '[0-9]+')->middleware('auth');
Route::get('/events/edit/{id}', [EventController::class, 'edit'])->name('events.edit')->where('id', '[0-9]+')->middleware('auth');
Route::put('/events/update/{id}', [EventController::class, 'update'])->name('events.update')->where('id', '[0-9]+')->middleware('auth');
Route::post('/events/join/{id}', [EventController::class, 'join'])->name('events.join')->where('id', '[0-9]+')->middleware('auth');
Route::delete('/events/leave/{id}', [EventController::class, 'leave'])->name('events.leave')->where('id', '[0-9]+')->middleware('auth');

Route::get('/dashboard', [EventController::class, 'dashboard'])->name('dashboard')->middleware('auth');

/*Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');*/
