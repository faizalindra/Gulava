<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\ProdukGradeController;
use App\Http\Controllers\ProduksController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserProfileController;


Route::get('/', function () {
	return redirect('/dashboard');
})->middleware('auth');
// Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
// Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
// Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
// Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
// Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
// Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::group(['middleware' => ['auth', 'web']], function () {
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::get('/inventory', [PageController::class, 'inventory'])->name('inventory');
	
	Route::get('/product', [PageController::class, 'product'])->name('product');
	Route::get('/produks/{id}', [PageController::class, 'produksDetail'])->name('produks.detail');
	Route::post('/produks', [ProduksController::class, 'create'])->name('produks.create');
	Route::post('/produks/{id}/update', [ProduksController::class, 'update'])->name('produks.update');
	Route::post('/produk/{id}/disable',[ProduksController::class, 'disable'])->name('produk.disable');
	Route::post('/produk-grade',[ProdukGradeController::class, 'create'])->name('produk.grade.create');

	Route::get('raw-material', [PageController::class, 'rawMaterial'])->name('raw-material');
	Route::get('raw-material/{id}', [PageController::class, 'rawMaterial'])->name('raw-material.detail');

	Route::get('/outgoing', [PageController::class, 'outgoing'])->name('outgoing');

	Route::get('/production',[PageController::class, 'production'])->name('production');
	Route::post('/production',[ProductionController::class, 'create'])->name('production.create');
	
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static');
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');

	// Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	// Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	// Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	// Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static'); 
});
