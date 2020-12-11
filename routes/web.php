<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdinanceController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenditureController;
use App\Http\Controllers\testeController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\PayController;

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
    if(session('school')){
        return redirect()->route('dashboard');
    }else{
        return view('welcome');
    }
    
});

Route::get('/teste', [testeController::class, 'teste']);

/*Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');*/


Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

Route::get('/escola', [SchoolController::class, 'create'])->middleware('checkTen');
Route::post('/escola', [SchoolController::class, 'create'])->name('addSchool');

Route::get('/portaria', [OrdinanceController::class, 'show'])->middleware('checkSchool')->name('ordinance');
Route::get('/portaria/add', [OrdinanceController::class, 'create'])->name('addOrdinance')->middleware('checkSchool');
Route::post('/portaria/add', [OrdinanceController::class, 'create'])->name('addOrdinancePost');
Route::get('/portaria/delete/{id}', [OrdinanceController::class, 'delete'])->name('delOrdinance')->middleware('checkSchool');
Route::get('/portaria/update/{id}', [OrdinanceController::class, 'setUpdate'])->name('upOrdinance')->middleware('checkSchool');
Route::post('/portaria/update', [OrdinanceController::class, 'update'])->name('upOrdinancePost');
Route::get('/portaria/detail/{id}', [OrdinanceController::class, 'detail'])->name('detailOrdinance')->middleware('checkSchool');

Route::get('/conta', [AccountController::class, 'show'])->name('account')->middleware('checkSchool');
Route::get('/GerenciarConta/{id}', [AccountController::class, 'manage'])->name('manageAcount')->middleware('checkSchool');
Route::get('/conta/add', [AccountController::class, 'create'])->name('addAccount')->middleware('checkSchool');
Route::post('/conta/add', [AccountController::class, 'create'])->name('addAccountPost');
Route::get('/conta/delete/{id}', [AccountController::class, 'delete'])->name('delAccount')->middleware('checkSchool');
Route::get('/conta/update/{id}', [AccountController::class, 'setUpdate'])->name('upAccount')->middleware('checkSchool');
Route::post('/conta/update', [AccountController::class, 'update'])->name('upAccountPost');
Route::get('/conta/escolher/{movimento}', [AccountController::class, 'choose'])->name('chooseAccount')->middleware('checkSchool');

Route::get('/receita/{id}', [IncomeController::class, 'show'])->name('income')->middleware('checkSchool');
Route::get('/receita/add/{id}', [IncomeController::class, 'setCreate'])->name('addIncome')->middleware('checkSchool');
Route::post('/receita/add', [IncomeController::class, 'create'])->name('addIncomePost');
Route::get('/receita/delete/{id}', [IncomeController::class, 'delete'])->name('delIncome')->middleware('checkSchool');
Route::get('/receita/update/{id}', [IncomeController::class, 'setUpdate'])->name('upIncome')->middleware('checkSchool');
Route::post('/receita/update', [IncomeController::class, 'update'])->name('upIncomePost');

Route::get('/despesa/{id}', [ExpenditureController::class, 'show'])->name('expenditure')->middleware('checkSchool');
Route::get('/despesa/add/{id}', [ExpenditureController::class, 'setCreate'])->name('addExpenditure')->middleware('checkSchool');
Route::post('/despesa/add', [ExpenditureController::class, 'create'])->name('addExpenditurePost');
Route::get('/despesa/delete/{id}', [ExpenditureController::class, 'delete'])->name('delExpenditure')->middleware('checkSchool');
Route::get('/despesa/update/{id}', [ExpenditureController::class, 'setUpdate'])->name('upExpenditure')->middleware('checkSchool');
Route::post('/despesa/update', [ExpenditureController::class, 'update'])->name('upExpenditurePost');
Route::get('/despesa/detail/{id}', [ExpenditureController::class, 'detail'])->name('detailExpenditure')->middleware('checkSchool');

Route::get('/pagamento/pagar/{id}', [PayController::class, 'setPay'])->name('payExpenditure')->middleware('checkSchool');
Route::post('/pagamento/pagar/add', [PayController::class, 'create'])->name('addPay');
Route::get('/pagamento/cancelar/{id}', [Paycontroller::class, 'delete'])->name('delPay')->middleware('checkSchool');

Route::get('/provider', [ProviderController::class, 'show'])->name('provider')->middleware('checkSchool');
Route::get('/provider/add', [ProviderController::class, 'setCreate'])->name('addProvider')->middleware('checkSchool');
Route::post('/provider/add', [ProviderController::class, 'create'])->name('addProviderPost');
Route::get('/provider/delete/{id}', [ProviderController::class, 'delete'])->name('delProvider')->middleware('checkSchool');
Route::get('/provider/update/{id}', [ProviderController::class, 'setUpdate'])->name('upProvider')->middleware('checkSchool');
Route::post('/provider/update', [ProviderController::class, 'update'])->name('upProviderPost');
Route::get('/provider/detail/{id}', [ProviderController::class, 'detail'])->name('detailProvider')->middleware('checkSchool');


