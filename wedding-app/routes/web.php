<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\WeddingController;
use App\Http\Controllers\WeddingRsvpController;
use App\Models\Template;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/templates', function () {
    $templates = Template::where('is_active', true)
        ->orderBy('sort_order')
        ->get()
        ->toArray();

    // dd($templates);

    return view('templates.index', compact('templates'));
})->name('templates.index');

Route::get('/templates/elegance-rose-gold/demo', function () {
    return view('templates.demos.elegance-rose-gold');
})->name('templates.elegance-rose-gold.demo');

Route::get('/templates/botanical-greenery/demo', function () {
    return view('templates.demos.botanical-greenery');
})->name('templates.botanical-greenery.demo');

Route::get('/templates/minimalist-aesthetic-white/demo', function () {
    return view('templates.demos.minimalist-aesthetic-white');
})->name('templates.minimalist-aesthetic-white.demo');

Route::get('/templates/javanese-heritage-traditional/demo', function () {
    return view('templates.demos.javanese-heritage-traditional');
})->name('templates.javanese-heritage-traditional.demo');

Route::middleware('guest')->group(function () {

    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');

    // Register
    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.process');
});

Route::middleware('auth')->group(function () {

    Route::get('/weddings/create', [WeddingController::class, 'create'])
        ->name('weddings.create');

    Route::get('/weddings', [WeddingController::class, 'index'])
        ->name('weddings.index');

    Route::post('/weddings', [WeddingController::class, 'store'])
        ->name('weddings.store');

    Route::get('/weddings/{wedding}/edit', [WeddingController::class, 'edit'])
        ->name('weddings.edit');

    Route::put('/weddings/{wedding}', [WeddingController::class, 'update'])
        ->name('weddings.update');

});

Route::get('/weddings/{wedding}', [WeddingController::class, 'show'])
    ->name('weddings.show');

Route::post('/weddings/{wedding}/rsvps', [WeddingRsvpController::class, 'store'])
    ->name('weddings.rsvps.store');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
