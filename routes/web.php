<?php

use App\Http\Controllers\UserRessourcesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/users_r', [UserRessourcesController::class, 'index']);
