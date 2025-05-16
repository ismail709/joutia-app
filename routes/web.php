<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Models\Ad;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $categories = Category::whereNull("parent_id")->limit(10)->get();
    $ads = Ad::approved()->with('images')->paginate(10);
    return view('welcome', ['categories' => $categories, 'ads' => $ads]);
})->name('home');


Route::prefix('ads')->name('ads.')->group(function () {
    Route::get('/search', [AdController::class,'search'])->name('search');
    Route::get('/create', [AdController::class,'create'])->name('create')->middleware('auth');
    Route::get('/edit/{ad}', [AdController::class,'edit'])->name('edit')->middleware('auth');
    Route::post('/', [AdController::class,'store'])->name('store')->middleware('auth');
    Route::get('/{ad}', [AdController::class, 'show'])->name('show');
    Route::put('/{ad}', [AdController::class, 'update'])->name('update')->middleware('auth');
    Route::delete('/{ad}', [AdController::class, 'destroy'])->name('destroy')->middleware('auth');
});

Route::prefix('categories')->name('categories.')->group(function () {
    Route::get('/all',[CategoryController::class,'list'])->name('list');
    Route::get('/{category}',[CategoryController::class,'show'])->name('show');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'register_form'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
    Route::get('/login', [AuthController::class, 'login_form'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile',[UserController::class,'edit'])->name('profile');
    Route::get('/myads',[UserController::class,'myAds'])->name('myads');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// users profiles
Route::get('/user/{user}',[UserController::class,'show'])->name('user.show');
Route::put('/user/{user}',[UserController::class,'update'])->name('user.update')->middleware('auth');