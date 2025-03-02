<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\AttendeeController;
use App\Http\Controllers\Api\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('events',EventController::class)->middleware('auth:sanctum');

Route::apiResource('events.attendees', AttendeeController::class)->except(['update'])->scoped();

Route::post('/login',[AuthController::class,'login']);  