<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('auth.login', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
    

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/manager', ManagerController::class);
    Route::resource('admin/products', ProduitController::class);
    Route::resource('shop', EmployeController::class);
    Route::get('shop.cart', [EmployeController::class,'cart'])->name('shop.cart');
    Route::get('admin/finance/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('admin.finance.reports', [AdminController::class, 'reports'])->name('admin.finance.reports');
    Route::get('admin/utilisateurs', [UserController::class, 'index'])->name('admin.utilisateurs.index');
    Route::get('admin.dashboard', [UserController::class, 'create'])->name('admin.utilisateurs.create');
    Route::post('/admin/dashborad', [UserController::class, 'store'])->name('admin.utilisateurs.store');
});




// Route::get('/admin/dashboard', function(){
//     return view('/admin/dashboard');
// });


require __DIR__ . '/auth.php';
