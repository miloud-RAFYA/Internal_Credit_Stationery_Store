<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\UserController;

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//     Route::resource('/manager', ManagerController::class);
//     Route::resource('admin/products', ProduitController::class);
//     Route::get('admin/finance/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
//     Route::get('admin/utilisateurs', [UserController::class, 'index'])->name('admin.utilisateurs.index');
//     Route::get('/admin/dashborad', [UserController::class, 'create'])->name('admin.utilisateurs.create');
//     Route::post('/admin/dashborad', [UserController::class, 'store'])->name('admin.utilisateurs.store');
//     Route::get('/admin/dashborad', [UserController::class, 'edit'])->name('admin.utilisateurs.edit');

// });

//  Route::get('/', function () {
//     return view('auth.login');
// });

// Route::get('/login', function () {
//     return view('auth.login'); 
// })->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('admin/finance/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::resource('admin/products', ProduitController::class);

    Route::resource('/manager', ManagerController::class);

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
});


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

require __DIR__ . '/auth.php';
