<?php use App\Http\Controllers\Api\DriverController;

Route::get('/drivers', [DriverController::class, 'index']);
