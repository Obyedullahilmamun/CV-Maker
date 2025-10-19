<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Barryvdh\DomPDF\Facade\Pdf;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CV Maker Pages
    Route::view('/form', 'pages.form')->name('form');
    Route::post('/submit-form', [FormController::class, 'submit'])->name('form.submit');
    Route::get('/index', [FormController::class, 'index'])->name('index');
    Route::get('/form/view/{id}', [FormController::class, 'view'])->name('form.view');
    Route::get('/form/edit/{id}', [FormController::class, 'edit'])->name('form.edit');
    Route::put('/form/update/{id}', [FormController::class, 'update'])->name('form.update');
    Route::delete('/form/delete/{id}', [FormController::class, 'delete'])->name('form.delete');

    // PDF Download
    Route::get('/cv/pdf/{user}', function ($user) {
        $user = App\Models\User::findOrFail($user);
        $pdf = Pdf::loadView('pdf.cv', ['user' => $user]);
        return $pdf->download($user->full_name . '.pdf');
    })->name('cv.pdf');

    // User Management
    // Route::resource('users', UserController::class);
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show'); // Show
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit'); // Edit
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update'); // Update
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy'); // Delete


    // Role Management
    Route::resource('roles', RoleController::class);
});

require __DIR__ . '/auth.php';
