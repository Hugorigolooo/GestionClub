<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
//use Symfony\Component\Routing\Annotation\Route;

Route::get('/', function () {
    return view('/bienvenue');
});

Route::get('/dashboard', function () {
    return view('/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/apropos', function (){
    return view('/pages/apropos');
});

Route::get('/contact', function (){
    return view('/pages/contact');
});

Route::get('/auth/login', function () {
    return view('/login');
});

Route::get('/auth/register', function () {
    return view('/register');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
//
//Route::get('/users', [UsersController::class, 'index'])->middleware(['auth',
//    'admin'])->name('users');
//
//Route::delete('/users/{id}', [UsersController::class,
//    'destroy'])->middleware(['auth', 'admin'])->name('users.destroy');

Route::get('/dashboard', function () { return view('dashboard');} )
    ->middleware(['auth'])->name('dashboard');

Route::get('/users', [UsersController::class, 'index'])->middleware(['auth',
    'admin'])->name('users');

Route::get('/users/profile/{user}', [UsersController::class, 'show'])
    ->name('users.show');

Route::get('/users/{user}', [UsersController::class, 'edit'])
    ->middleware(['auth'])->name('users.edit');

Route::put('/users/{user}', [UsersController::class, 'update'])
    ->middleware(['auth'])->name('users.update');

Route::delete('/users/{user}', [UsersController::class, 'destroy'])
    ->middleware(['auth', 'admin'])->name('users.destroy');
