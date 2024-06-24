<?php

use App\Http\Controllers\ListCallController;
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

Route::get('/', function () { return view('welcome'); })->name('welcome');

Route::get('/dashboard', [ListCallController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('/list')->group(function(){
    Route::post('/get', [ListCallController::class, 'index']);
    Route::put('/save', [ListCallController::class, 'store']);
    Route::patch('/{id}', [ListCallController::class, 'update']);
    Route::delete('/{id}', [ListCallController::class, 'destroy']);
});

Auth::routes();
