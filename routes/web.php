<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\EmployeeDashboardController;



Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::get('admin/finance/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('admin/products', ProduitController::class);
    Route::get('manager/approvals', [ManagerController::class, 'approvals'])->name('manager.approvals');
    Route::resource('/manager', ManagerController::class);
    Route::resource('commandes', CommandeController::class);
    Route::patch('commandes/{commande}/valider', [ManagerController::class, 'valider'])->name('commandes.valider');

    Route::get('admin/utilisateurs', [UserController::class, 'index'])
        ->name('admin.utilisateurs.index');

    Route::get('admin/utilisateurs/create', [UserController::class, 'create'])
        ->name('admin.utilisateurs.create');

    Route::post('admin/utilisateurs', [UserController::class, 'store'])
        ->name('admin.utilisateurs.store');

    Route::get('admin/utilisateurs/{id}/edit', [UserController::class, 'edit'])
        ->name('admin.utilisateurs.edit');

    Route::put('admin/utilisateurs/{id}', [UserController::class, 'update'])
        ->name('admin.utilisateurs.update');

    Route::delete('admin/utilisateurs/{id}', [UserController::class, 'destroy'])
        ->name('admin.utilisateurs.destroy');
    Route::resource('shop', EmployeController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('shop', EmployeController::class);
    Route::get('shop.cart', [EmployeController::class, 'cart'])->name('shop.cart');

    Route::get('shop.dashboard', [EmployeeDashboardController::class, 'index'])->name('shop.dashboard');
    Route::resource('products', ProduitController::class);
    Route::get('admin/finance/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/commande', [CommandeController::class, 'store'])
        ->name('commande.store');
    Route::get('/commande', [CommandeController::class, 'show'])
        ->name('commande.show');

    // Route::get('admin.finance.reports', [AdminController::class, 'reports'])->name('admin.finance.reports');
    // Route::get('admin/utilisateurs', [UserController::class, 'index'])->name('admin.utilisateurs.index');
    // Route::get('admin.dashboard', [UserController::class, 'create'])->name('admin.utilisateurs.create');
    // Route::post('/admin/dashborad', [UserController::class, 'store'])->name('admin.utilisateurs.store');

});

require __DIR__ . '/auth.php';

// Route::get('auth.login', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {

//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

//     // Manager routes
//     Route::get('manager/approvals', [ManagerController::class, 'approvals'])->name('manager.approvals');
//     Route::resource('/manager', ManagerController::class);
//     Route::patch('commandes/{commande}/valider', [ManagerController::class, 'valider'])->name('commandes.valider');

//     // Commandes routes
//     Route::get('commandes/pending', [CommandeController::class, 'pendantes'])->name('commandes.pendantes');
//     Route::resource('commandes', CommandeController::class);

//     // Employee routes
//     Route::get('shop/cart', [EmployeController::class,'cart'])->name('shop.cart');
//     Route::get('shop/dashboard', [EmployeeDashboardController::class,'index'])->name('shop.dashboard');
//     Route::resource('shop', EmployeController::class);

//     // Products routes
//     Route::resource('products', ProduitController::class);

//     // Admin routes
//     Route::get('admin/finance/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
//     Route::get('admin.finance.reports', [AdminController::class, 'reports'])->name('admin.finance.reports');
//     Route::get('admin/utilisateurs', [UserController::class, 'index'])->name('admin.utilisateurs.index');
//     Route::get('admin.dashboard', [UserController::class, 'create'])->name('admin.utilisateurs.create');
//     Route::post('/admin/dashborad', [UserController::class, 'store'])->name('admin.utilisateurs.store');

// });


// =======
// use App\Http\Controllers\EmployeeDashboardController;

// Route::get('/', function () {
//     return view('welcome');
// });



// Route::middleware('auth ')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//     Route::resource('/manager', ManagerController::class);

//     Route::resource('shop', EmployeController::class);

//     Route::resource('products', ProduitController::class);

//     Route::get('admin/finance/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
//     Route::get('admin/finance/reports', [AdminController::class, 'reports'])->name('admin.finance');
//     Route::get('admin/utilisateurs', [UserController::class, 'index'])->name('admin.utilisateurs.index');
//     Route::get('admin.dashboard', [UserController::class, 'create'])->name('admin.utilisateurs.create');
//     Route::post('/admin/dashborad', [UserController::class, 'store'])->name('admin.utilisateurs.store');
// });

// >>>>>>> 1074f4e52609a369555b52b23d4c495519d013dc


