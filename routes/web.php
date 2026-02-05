<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManagerController;


Route::get('/', function () {
    return view('auth/login');
});

Route::get('/admin/dashboard', [HomeController::class, 'adminDashboard'])
    ->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//     Route::resource('/manager',ManagerController::class);
// });

// Route::get('/admin/dashboard', function(){
//     return view('/admin/dashboard');
// });

require __DIR__ . '/auth.php';
