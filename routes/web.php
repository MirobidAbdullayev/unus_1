<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthManagerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [HomeController::class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/redirect', [HomeController::class, 'redirect']);
Route::get('/view_category', [AdminController::class, 'view_category']);
Route::get('/login_view', [AuthManagerController::class, 'login_view'])->name('login_view');
Route::post('/login_view', [AuthManagerController::class, 'login_viewPost'])->name('login_view.post');
Route::get('/register_view', [AuthManagerController::class, 'register_view'])->name('register_view');
Route::post('/register_view', [AuthManagerController::class, 'register_viewPost'])->name('register_view.post');
Route::get('/logout_view', [AuthManagerController::class, 'logout_view'])->name('logout_view');
