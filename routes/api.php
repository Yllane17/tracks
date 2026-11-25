<?php

use App\Http\Controllers\Api\SalleApiController;
use Illuminate\Support\Facades\Route;

// Toutes les routes de ce fichier sont automatiquement préfixées par /api
// et reçoivent le groupe de middlewares "api" (pas de session, pas de CSRF).

Route::get('/ping', fn () => response()->json([
    'application' => config('app.name'),
    'statut'      => 'ok',
    'date'        => now()->toIso8601String(),

]));

// Salles : les 5 routes REST (index, store, show, update, destroy)
Route::apiResource('salles', SalleApiController::class);
