<?php

use App\Http\Controllers\Fare\FareController;
use App\Http\Controllers\Operator\OperatorController;
use Illuminate\Support\Facades\Route;

Route::resource('operators',OperatorController::class)->names('operator')->parameters(['operadoras'=>'operator']);

Route::post('fare/store', [FareController::class, 'store'])->name('fare.store');
Route::get('fare/update-status/{fare}', [FareController::class, 'updateStatus'])->name('update-status');
