<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('backend.dashboard');
})->middleware(['auth', 'verified', 'can:dashboard.permission'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'can:permission.permission'])->group(function () {
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index')->middleware('can:permission.list');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create')->middleware('can:permission.create');
    Route::post('/permissions/store', [PermissionController::class, 'store'])->name('permissions.store')->middleware('can:permission.create');
    Route::get('/permissions/edit/{id}', [PermissionController::class, 'edit'])->name('permissions.edit')->middleware('can:permission.edit');
    Route::put('/permissions/update/{id}', [PermissionController::class, 'update'])->name('permissions.update')->middleware('can:permission.edit');
    Route::delete('/permissions/delete/{id}', [PermissionController::class, 'delete'])->name('permissions.delete')->middleware('can:permission.delete');
});

Route::middleware(['auth', 'can:role.permission'])->group(function () {
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index')->middleware('can:role.list');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create')->middleware('can:role.create');
    Route::post('/roles/store', [RoleController::class, 'store'])->name('roles.store')->middleware('can:role.create');
    Route::get('/roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit')->middleware('can:role.edit');
    Route::put('/roles/update/{id}', [RoleController::class, 'update'])->name('roles.update')->middleware('can:role.edit');
    Route::delete('/roles/delete/{id}', [RoleController::class, 'delete'])->name('roles.delete')->middleware('can:role.delete');
});

Route::middleware(['auth', 'can:user.permission'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware('can:user.list');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create')->middleware('can:user.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store')->middleware('can:user.create');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit')->middleware('can:user.edit');
    Route::put('/users/update/{id}', [UserController::class, 'update'])->name('users.update')->middleware('can:user.edit');
    Route::delete('/users/delete/{id}', [UserController::class, 'delete'])->name('users.delete')->middleware('can:user.delete');
});

Route::middleware(['auth', 'can:activity-log.permission'])->group(function () {
    Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index')->middleware('can:activity-log.list');
});

require __DIR__ . '/auth.php';
