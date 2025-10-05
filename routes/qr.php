<?php
use Illuminate\Support\Facades\Route;
use Services\QrScanner\Http\Controllers\ScanController;

if (!config('qr.enabled')) return;

Route::middleware(['web','auth'])
  ->prefix(config('qr.route_prefix'))
  ->name('qr.')
  ->group(function () {
    Route::get('/health', [ScanController::class,'health'])->name('health');
    Route::post('/scan',  [ScanController::class,'scan'])->name('scan');
  });
