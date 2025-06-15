<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\RoleController;
use App\Http\Controllers\Admin\PermisoUsuarioController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Auth\RedirectController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

 Route::middleware(['auth'])->group(function () {
    Route::resource('roles', RoleController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard'); // o cualquier vista que uses
    })->name('admin.dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/empleado/dashboard', function () {
        return view('empleado.dashboard'); // o cualquier vista que uses
    })->name('empleado.dashboard');
});

Route::get('/settings', function (\Illuminate\Http\Request $request) {
    return redirect($request->input('settings'));
})->name('settings');


Route::middleware(['auth'])->group(function () {
    Route::resource('permisos', PermissionController::class);
});





Route::get('/usuarios', [PermisoUsuarioController::class, 'index'])->name('admin.usuarios.index');
Route::get('/usuarios/{user}/edit', [PermisoUsuarioController::class, 'edit'])->name('admin.usuarios.edit');
Route::put('/usuarios/{user}/roles', [PermisoUsuarioController::class, 'update'])->name('admin.usuarios.updateRoles');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin/usuarios/permisos')->name('admin.usuarios.permisos.')->middleware(['auth'])->group(function () {
    Route::get('/', [PermisoUsuarioController::class, 'index'])->name('index');
    Route::put('/{user}', [PermisoUsuarioController::class, 'update'])->name('update');
});

Route::get('/redirect-by-role', [RedirectController::class, 'redirectByRole'])->name('redirect.by.role');

require __DIR__.'/auth.php';
