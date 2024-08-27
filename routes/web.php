<?php

use App\Http\Controllers\ExpeditionController;
use App\Models\expedition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
                  // web.php


Route::get('/pdf/generate/{id}', [ExpeditionController::class, 'generate'])->name('generate-pdf');
Route::get('/print-ids-by-date/{startDate}/{endDate}', [ExpeditionController::class, 'printIdsByDate'])
  ->name('print-ids-by-date');

Route::get('/expeditions/print', function () {$expeditions = Expedition::all();
return view('print', compact('expeditions'));})
->name('print');

Route::post('/run-command', [CommandController::class, 'runCommand'])->name('run.command');

