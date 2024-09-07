<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\MasterController;

Route::middleware('auth')->group(function () {
	Route::get('/master',[MasterController::class, 'list'])->name('master');
	Route::post('/master-edit',[MasterController::class, 'edit'])->name('master');
});