<?php

use App\Http\Controllers\fazilatController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\porductController;
use App\Http\Controllers\sanawiaController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/marhala/products', function () {
//     return Inertia::render('marhala/products');
// })->middleware(['auth', 'verified'])->name('products');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// others routers
// fazilat Router

// Route::get('/marhala/fazilat', [fazilatController::class, 'demo'])->name('marhala.fazilat');
//  Route::get('/student-count', [FazilatController::class, 'count'])->name('student.count');
//  Route::post('/search-student', [fazilatController::class, 'search'])->name('search-student.post');

Route::get('/marhala/fazilat', [fazilatController::class, 'demo'])->name('marhala.fazilat');


Route::get('/marhala/sanawaia', [sanawiaController::class, 'sanawia'])->name('marhala.sanawaia');












require __DIR__.'/auth.php';
