<?php

use App\Http\Controllers\ProfileController;
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
