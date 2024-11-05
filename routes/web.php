<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\voituresController;
use App\Http\Controllers\offresController;

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

Route:: get ('/', [voituresController::class, 'index']);

// Route pour l'autocomplétion
Route::get('/voitures/autocomplete', [voituresController::class, 'autocomplete'])->name('voitures.autocomplete');


Route::resources([
    'voitures' => voituresController::class,
    'offres' => offresController::class,
]);
