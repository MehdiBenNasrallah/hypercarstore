<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\voituresController;
use App\Http\Controllers\offresController;
use App\Http\Controllers\LocalizationController;

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

Route::get('/info', function () {
    return view('info');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [voituresController::class, 'index']);

// Route pour l'autocomplétion
Route::get('/voitures/autocomplete', [voituresController::class, 'autocomplete'])->name('voitures.autocomplete');

// Route pour la localisation
Route::get('/lang/{locale}', [LocalizationController::class, 'index'])->name('lang');

Route::controller(voituresController::class)->group(function () {
    Route::get('/voitures/{id}', 'show');
});

Route::post('offres', [offresController::class, 'store'])->name('offres.store');

Route::resources([
    //'voitures' => voituresController::class,
    'offres' => offresController::class,
]);

Auth::routes();

Route:: get ('admin/voitures', [voituresController::class, 'index'])->middleware('auth', 'admin')->name('voitures.index');
Route:: get ('admin/voitures/create', [voituresController::class, 'create'])->middleware('auth', 'admin')->name('voitures.create');
Route:: post ('admin/voitures', [voituresController::class, 'store'])->middleware('auth', 'admin')->name('voitures.store');
Route:: get ('admin/voitures/{id}/edit', [voituresController::class, 'edit'])->middleware('auth', 'admin')->name('voitures.edit');
Route:: put ('admin/voitures/{id}', [voituresController::class, 'update'])->middleware('auth', 'admin')->name('voitures.update');
Route:: delete ('admin/voitures/{id}', [voituresController::class, 'destroy'])->middleware('auth', 'admin')->name('voitures.destroy');
Route:: get ('admin/voitures/{id}', [voituresController::class, 'show'])->middleware('auth', 'admin')->name('voitures.show');

