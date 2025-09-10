<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AttendeeController;



Route::resource('event', EventController::class);
Route::post('/events/{id}/register', [AttendeeController::class,'register']);
Route::get('/events/{id}/attendees', [AttendeeController::class,'list']);