<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StatistiqueController;
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

Route::get('/', [DashboardController::class, 'dashboard']);

Route::prefix('stats')->group(function () {
    Route::get('/', [StatistiqueController::class, 'getDataSortedByEffectif'])->name('stats');
    Route::get('/age', [StatistiqueController::class, 'getDataSortedByAge'])->name('stats.age');
    Route::get('/region', [StatistiqueController::class, 'getDataSortedByRegion'])->name('stats.region');
    Route::get('/gender', [StatistiqueController::class, 'getDataSortedByGender'])->name('stats.gender');
    Route::get('/diplome-admission', [StatistiqueController::class, 'getDataSortedByDiplomeAdmission'])->name('stats.diplome-admission');
});
