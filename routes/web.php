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


// takmil


Route::get('/takmil/takmil', [sanawiaController::class, 'takmil'])->name('takmil.takmil');
Route::get('/takmil/sanawaiaDetailes/{Roll}/{reg_id}', [sanawiaController::class, 'details'])->name('takmil.sanawaiaDetailes');

Route::put('/takmil/update', [sanawiaController::class, 'update'])->name('takmil.update');
Route::get('/takmil/sanawiacirtificateProvide', [sanawiaController::class, 'sanawiacirtificateProvide'])->name('takmil.sanawiacirtificateProvide');
Route::get('/takmil/search', [sanawiaController::class, 'search'])->name('takmil.search');
Route::get('/takmil/searchBn', [sanawiaController::class, 'searchBn'])->name('takmil.searchBn');
Route::get('/takmil/searchElhaq', [sanawiaController::class, 'searchElhaq'])->name('takmil.searchElhaq');
Route::get('/takmil/certificate/{Roll}/{reg_id}', [sanawiaController::class, 'generatePdf'])->name('takmil.certificate.pdf');












// fazilat

Route::get('/fazilat/fazilat', [fazilatController::class, 'demo'])->name('fazilat.fazilat');
Route::get('/fazilat/fazilatDetailes/{Roll}/{reg_id}', [fazilatController::class, 'details'])->name('fazilat.fazilatDetailes');
Route::put('/fazilat/update', [fazilatController::class, 'update'])->name('fazilat.update');
Route::get('/fazilat/cirtificateProvide', [FazilatController::class, 'cirtificateProvide'])->name('fazilat.cirtificateProvide');
Route::get('/fazilat/search', [fazilatController::class, 'search'])->name('fazilat.search');
Route::get('/fazilat/searchBn', [fazilatController::class, 'searchBn'])->name('fazilat.searchBn');
Route::get('/fazilat/searchElhaq', [fazilatController::class, 'searchElhaq'])->name('fazilat.searchElhaq');
Route::get('/fazilat/certificate/{Roll}/{reg_id}', [fazilatController::class, 'generatePdf'])->name('fazilat.certificate.pdf');


Route::get('/applicationForm', function () {
    return inertia::render('applicationForm');
})->name('applicationForm');


// sanawia

Route::get('/sanawia/sanawaia', [sanawiaController::class, 'sanawia'])->name('sanawia.sanawaia');
Route::get('/sanawia/sanawaiaDetailes/{Roll}/{reg_id}', [sanawiaController::class, 'details'])->name('sanawia.sanawaiaDetailes');

Route::put('/sanawia/update', [sanawiaController::class, 'update'])->name('sanawia.update');
Route::get('/sanawia/sanawiacirtificateProvide', [sanawiaController::class, 'sanawiacirtificateProvide'])->name('sanawia.sanawiacirtificateProvide');
Route::get('/sanawia/search', [sanawiaController::class, 'search'])->name('sanawia.search');
Route::get('/sanawia/searchBn', [sanawiaController::class, 'searchBn'])->name('sanawia.searchBn');
Route::get('/sanawia/searchElhaq', [sanawiaController::class, 'searchElhaq'])->name('sanawia.searchElhaq');
Route::get('/fazilat/certificate/{Roll}/{reg_id}', [sanawiaController::class, 'generatePdf'])->name('fazilat.certificate.pdf');












// Route::get('/fazilat/Division', [fazilatController::class, 'index'])->name('marhala.Division');










require __DIR__.'/auth.php';
