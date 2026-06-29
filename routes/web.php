<?php

use App\Http\Controllers\DetectionController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [DetectionController::class, 'index'])->name('home');
Route::get('/deteksi', [DetectionController::class, 'showForm'])->name('deteksi.form');
Route::post('/deteksi', [DetectionController::class, 'process'])->name('deteksi.proses');

