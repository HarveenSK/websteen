<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChiptuningDetailController;

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


Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/chiptuning', [HomeController::class, 'show'])->name('index.show');

Route::get('chiptuning/{brand}/{model?}/{generation?}/{motortype?}', [ChiptuningDetailController::class, 'index'])
    ->name('chiptuning.details.index');
