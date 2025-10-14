<?php

use App\Http\Controllers\TimeController;
use Illuminate\Support\Facades\Route;

Route::get("/time", [TimeController::class, 'show']);
