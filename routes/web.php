<?php

use App\Http\Controllers\fazilatController;
use App\Http\Controllers\mutawassitahController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CertificateApplicationController;
use App\Http\Controllers\porductController;
use App\Http\Controllers\sanawiaController;
use App\Http\Controllers\takmilController;
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


Route::get('/Takmil/takmil', [takmilController::class, 'takmil'])->name('Takmil.takmil');
Route::get('/Takmil/sanawaiaDetailes/{Roll}/{reg_id}', [takmilController::class, 'details'])->name('Takmil.sanawaiaDetailes');

Route::put('/Takmil/update', [takmilController::class, 'update'])->name('Takmil.update');
Route::get('/Takmil/sanawiacirtificateProvide', [takmilController::class, 'sanawiacirtificateProvide'])->name('Takmil.sanawiacirtificateProvide');
Route::get('/Takmil/search', [takmilController::class, 'search'])->name('Takmil.search');
Route::get('/Takmil/searchBn', [takmilController::class, 'searchBn'])->name('Takmil.searchBn');
Route::get('/Takmil/searchElhaq', [takmilController::class, 'searchElhaq'])->name('Takmil.searchElhaq');
Route::get('/Takmil/certificate/{Roll}/{reg_id}', [takmilController::class, 'generatePdf'])->name('Takmil.certificate.pdf');












// fazilat

Route::get('/Fajilat/fazilat', [fazilatController::class, 'demo'])->name('Fajilat.fazilat');
Route::get('/Fajilat/fazilatDetailes/{Roll}/{reg_id}', [fazilatController::class, 'details'])->name('Fajilat.fazilatDetailes');
Route::put('/Fajilat/update', [fazilatController::class, 'update'])->name('Fajilat.update');
Route::get('/Fajilat/cirtificateProvide', [FazilatController::class, 'cirtificateProvide'])->name('Fajilat.cirtificateProvide');
Route::get('/Fajilat/search', [fazilatController::class, 'search'])->name('Fajilat.search');
Route::get('/Fajilat/searchBn', [fazilatController::class, 'searchBn'])->name('Fajilat.searchBn');
Route::get('/Fajilat/searchElhaq', [fazilatController::class, 'searchElhaq'])->name('Fajilat.searchElhaq');
Route::get('/Fajilat/certificate/{Roll}/{reg_id}', [fazilatController::class, 'generatePdf'])->name('Fajilat.certificate.pdf');


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


// mutawassitah

Route::get('/mutawassitah/Mutawassitah', [mutawassitahController::class, 'Mutawassitah'])->name('mutawassitah.Mutawassitah');
Route::get('/mutawassitah/mutawassitaDetailes/{Roll}/{reg_id}', [mutawassitahController::class, 'details'])->name('mutawassitah.mutawassitaDetailes');

Route::put('/mutawassitah/update', [mutawassitahController::class, 'update'])->name('mutawassitah.update');
Route::get('/mutawassitah/mutawassitahcirtificate', [mutawassitahController::class, 'mutawassitahcirtificate'])->name('mutawassitah.mutawassitahcirtificate');
Route::get('/mutawassitah/search', [mutawassitahController::class, 'search'])->name('mutawassitah.search');
Route::get('/mutawassitah/searchBn', [mutawassitahController::class, 'searchBn'])->name('mutawassitah.searchBn');
Route::get('/mutawassitah/searchElhaq', [mutawassitahController::class, 'searchElhaq'])->name('mutawassitah.searchElhaq');
Route::get('/mutawassitah/certificate/{Roll}/{reg_id}', [mutawassitahController::class, 'generatePdf'])->name('mutawassitah.certificate.pdf');




// Application route

// Route::middleware(['auth'])->group(function () {
//     Route::resource('applications', CertificateApplicationController::class);
//     Route::patch('applications/{application}/status', [CertificateApplicationController::class, 'updateStatus'])
//         ->name('applications.update-status');
// });

Route::middleware(['auth'])->group(function () {
    Route::resource('applications', CertificateApplicationController::class);
});


// Route::get('/fazilat/Division', [fazilatController::class, 'index'])->name('marhala.Division');










require __DIR__.'/auth.php';
