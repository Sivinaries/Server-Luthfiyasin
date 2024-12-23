<?php

use App\Events\MessageSent;
use App\Exports\MessagesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\DaerahController;
use App\Http\Controllers\SenderController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CategoryController;


//AUTH CONTROLLER
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/signin', [AuthController::class, 'signin'])->name('signin');

Route::middleware('auth')->group(function () {

    Route::get('/messages/export', function () {
        return Excel::download(new MessagesExport, 'messages.xlsx');
    })->name('export');
    
    //PAGES
    Route::get('/dashboard', [PagesController::class, 'dashboard'])->name('dashboard');
    Route::get('/search', [PagesController::class, 'search'])->name('search');
    Route::get('/barcode', [PagesController::class, 'barcode'])->name('barcode');

    //USER CONTROLLER
    Route::get('/users', [UserController::class, 'index'])->name('user');
    Route::get('/createuser', [UserController::class, 'create'])->name('adduser');
    Route::post('/postuser', [UserController::class, 'store'])->name('postuser');
    Route::delete('/user/{id}/delete', [UserController::class, 'destroy'])->name('deluser');

    //MESSAGE CONTROLLER
    Route::get('/message', [MessageController::class, 'index'])->name('message');
    Route::delete('/message/{id}/delete', [MessageController::class, 'destroy'])->name('delmessage');

    //SENDER CONTROLLER
    Route::get('/sender', [SenderController::class, 'index'])->name('sender');

    //CATEGORY CONTROLLER
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::get('/addcategory', [CategoryController::class, 'create'])->name('addcategory');
    Route::post('/postcategory', [CategoryController::class, 'store'])->name('postcategory');
    Route::get('/editcategory/{id}', [CategoryController::class, 'edit'])->name('editcategory');
    Route::put('/category/{id}/update', [CategoryController::class, 'update'])->name('updatecategory');
    Route::delete('/category/{id}/delete', [CategoryController::class, 'destroy'])->name('delcategory');

    //COUNTRY CONTROLLER
    Route::get('/country', [DaerahController::class, 'index'])->name('country');
    Route::get('/addcountry', [DaerahController::class, 'create'])->name('addcountry');
    Route::post('/postcountry', [DaerahController::class, 'store'])->name('postcountry');
    Route::get('/editcountry/{id}', [DaerahController::class, 'edit'])->name('editcountry');
    Route::put('/country/{id}/update', [DaerahController::class, 'update'])->name('updatecountry');
    Route::delete('/country/{id}/delete', [DaerahController::class, 'destroy'])->name('delcountry');


    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
