<?php

use App\Http\Controllers\ReactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/reaction', [ReactionController::class, 'index'])->name('reaction.index');
