<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ChiptuningController;
//use App\Http\Controllers\TestChiptuningController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/brands', [ChiptuningController::class, 'brands'])->name('chiptuning.brands.index');
Route::get('/models/{brand}', [ChiptuningController::class, 'models'])->name('chiptuning.models.index');
Route::get('/generations/{brand}/{model}', [ChiptuningController::class, 'generations'])->name('chiptuning.generations.index');
Route::get('/motortypes/{brand}/{model}/{generation}', [ChiptuningController::class, 'motortypes'])->name('chiptuning.motortypes.index');
