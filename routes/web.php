<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdinanceController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\IncomeController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/teste', function () {
    return view('formteste');
});

/*Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');*/


Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

Route::get('/escola', [SchoolController::class, 'create'])->middleware('checkTen');
Route::post('/escola', [SchoolController::class, 'create'])->name('addSchool');

Route::get('/portaria', [OrdinanceController::class, 'show'])->name('ordinance');
Route::get('/portaria/add', [OrdinanceController::class, 'create'])->name('addOrdinance');
Route::post('/portaria/add', [OrdinanceController::class, 'create'])->name('addOrdinancePost');
Route::get('/portaria/delete/{id}', [OrdinanceController::class, 'delete'])->name('delOrdinance');
Route::get('/portaria/update/{id}', [OrdinanceController::class, 'setUpdate'])->name('upOrdinance');
Route::post('/portaria/update', [OrdinanceController::class, 'update'])->name('upOrdinancePost');
Route::get('/portaria/detail/{id}', [OrdinanceController::class, 'detail'])->name('detailOrdinance');

Route::get('/conta', [AccountController::class, 'show'])->name('account');
Route::get('/GerenciarConta/{id}', [AccountController::class, 'manage'])->name('manageAcount');
Route::get('/conta/add', [AccountController::class, 'create'])->name('addAccount');
Route::post('/conta/add', [AccountController::class, 'create'])->name('addAccountPost');
Route::get('/conta/delete/{id}', [AccountController::class, 'delete'])->name('delAccount');
Route::get('/conta/update/{id}', [AccountController::class, 'setUpdate'])->name('upAccount');
Route::post('/conta/update', [AccountController::class, 'update'])->name('upAccountPost');
Route::get('/conta/escolher/{movimento}', [AccountController::class, 'choose'])->name('chooseAccount');

Route::get('/receita/{id}', [IncomeController::class, 'show'])->name('income');
Route::get('/receita/add/{id}', [IncomeController::class, 'setCreate'])->name('addIncome');
Route::post('/receita/add', [IncomeController::class, 'create'])->name('addIncomePost');
Route::get('/receita/delete/{id}', [IncomeController::class, 'delete'])->name('delIncome');
Route::get('/receita/update/{id}', [IncomeController::class, 'setUpdate'])->name('upIncome');
Route::post('/receita/update', [IncomeController::class, 'update'])->name('upIncomePost');

Route::get('/despesa/{id}', [IncomeController::class, 'show'])->name('expenditure');


