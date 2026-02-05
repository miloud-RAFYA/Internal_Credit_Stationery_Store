<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
Route::get('/', function () {
    return view('/admin/products/index');
});
Route::get('/admin/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');

Route::get('/admin/produits', [HomeController::class, 'showProduitsInAdminDashboard'])->name('admin.dashboard');

Route::get('/admin/utilisateurs', [HomeController::class, 'showUtilisateurInAdminDashboard']);
