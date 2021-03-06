<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdinanceController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenditureController;
use App\Http\Controllers\FixedExpenditureController;
use App\Http\Controllers\testeController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\BankIncomeController;
use App\Http\Controllers\AccountabilityController;
use App\Http\Controllers\TenancyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AceController;
use App\Http\Controllers\DocumentController;
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

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

Route::get('/perfil', [TenancyController::class, 'show'])->name('profile')->middleware('checkSchool');

Route::get('/perfil/editar/{id}', [UserController::class, 'setUpdate'])->name('upUser')->middleware('checkSchool');
Route::post('/perfil/editar', [UserController::class, 'update'])->name('upUserPost');

Route::get('/escola', [SchoolController::class, 'create'])->middleware('checkTen');
Route::post('/escola', [SchoolController::class, 'create'])->name('addSchool');
Route::get('/escola/editar/{id}', [SchoolController::class, 'setUpdate'])->name('upSchool')->middleware('checkSchool');
Route::post('/escola/editar', [SchoolController::class, 'update'])->name('upSchoolPost');

Route::get('/ace/editar/{id}', [AceController::class, 'setUpdate'])->name('upAce')->middleware('checkSchool');
Route::post('/ace/editar', [AceController::class, 'update'])->name('upAcePost');

Route::get('/portaria', [OrdinanceController::class, 'show'])->middleware('checkSchool')->name('ordinance');
Route::get('/portaria/add', [OrdinanceController::class, 'create'])->name('addOrdinance')->middleware('checkSchool');
Route::post('/portaria/add', [OrdinanceController::class, 'create'])->name('addOrdinancePost');
Route::get('/portaria/delete/{id}', [OrdinanceController::class, 'delete'])->name('delOrdinance')->middleware('checkSchool');
Route::get('/portaria/alterar/{id}', [OrdinanceController::class, 'setUpdate'])->name('upOrdinance')->middleware('checkSchool');
Route::post('/portaria/alterar', [OrdinanceController::class, 'update'])->name('upOrdinancePost');
Route::get('/portaria/detalhe/{id}', [OrdinanceController::class, 'detail'])->name('detailOrdinance')->middleware('checkSchool');

Route::get('/conta', [AccountController::class, 'show'])->name('account')->middleware('checkSchool');
Route::get('/conta/gerenciar/{id}', [AccountController::class, 'manage'])->name('manageAcount')->middleware('checkSchool');
Route::get('/conta/add', [AccountController::class, 'create'])->name('addAccount')->middleware('checkSchool');
Route::post('/conta/add', [AccountController::class, 'create'])->name('addAccountPost');
Route::get('/conta/delete/{id}', [AccountController::class, 'delete'])->name('delAccount')->middleware('checkSchool');
Route::get('/conta/alterar/{id}', [AccountController::class, 'setUpdate'])->name('upAccount')->middleware('checkSchool');
Route::post('/conta/alterar', [AccountController::class, 'update'])->name('upAccountPost');
Route::get('/conta/escolher/{movimento}', [AccountController::class, 'choose'])->name('chooseAccount')->middleware('checkSchool');

Route::get('/receita/{id}', [IncomeController::class, 'show'])->name('income')->middleware('checkSchool');
Route::get('/receita/add/{id}', [IncomeController::class, 'setCreate'])->name('addIncome')->middleware('checkSchool');
Route::post('/receita/add', [IncomeController::class, 'create'])->name('addIncomePost');
Route::get('/receita/delete/{id}', [IncomeController::class, 'delete'])->name('delIncome')->middleware('checkSchool');
Route::get('/receita/alterar/{id}', [IncomeController::class, 'setUpdate'])->name('upIncome')->middleware('checkSchool');
Route::post('/receita/alterar', [IncomeController::class, 'update'])->name('upIncomePost');

Route::get('/despesa/{id}', [ExpenditureController::class, 'show'])->name('expenditure')->middleware('checkSchool');
Route::get('/despesa/add/{id}', [ExpenditureController::class, 'setCreate'])->name('addExpenditure')->middleware('checkSchool');
Route::post('/despesa/add', [ExpenditureController::class, 'create'])->name('addExpenditurePost');
Route::get('/despesa/delete/{id}', [ExpenditureController::class, 'delete'])->name('delExpenditure')->middleware('checkSchool');
Route::get('/despesa/alterar/{id}', [ExpenditureController::class, 'setUpdate'])->name('upExpenditure')->middleware('checkSchool');
Route::post('/despesa/alterar', [ExpenditureController::class, 'update'])->name('upExpenditurePost');
Route::get('/despesa/detalhe/{id}', [ExpenditureController::class, 'detail'])->name('detailExpenditure')->middleware('checkSchool');

Route::get('/despesa_fixa/{id}', [FixedExpenditureController::class, 'show'])->name('fixedExpenditure')->middleware('checkSchool');
Route::get('/despesa_fixa/gerar/{id}', [FixedExpenditureController::class, 'setGerar'])->name('gerExpenditure')->middleware('checkSchool');
Route::post('/despesa_fixa/gerar', [FixedExpenditureController::class, 'Gerar'])->name('gerExpenditurePost')->middleware('checkSchool');
Route::get('/despesa_fixa/delete/{id}', [FixedExpenditureController::class, 'delete'])->name('delFixedExpenditure')->middleware('checkSchool');
Route::get('/despesa_fixa/alterar/{id}', [FixedExpenditureController::class, 'setUpdate'])->name('upFixedExpenditure')->middleware('checkSchool');
Route::post('/despesa_fixa/alterar', [FixedExpenditureController::class, 'update'])->name('upFixedExpenditurePost')->middleware('checkSchool');

Route::get('/pagamento/pagar/{id}', [PayController::class, 'setPay'])->name('payExpenditure')->middleware('checkSchool');
Route::post('/pagamento/pagar/add', [PayController::class, 'create'])->name('addPay');
Route::get('/pagamento/cancelar/{id}', [Paycontroller::class, 'delete'])->name('delPay')->middleware('checkSchool');

Route::get('/provider', [ProviderController::class, 'show'])->name('provider')->middleware('checkSchool');
Route::get('/provider/add', [ProviderController::class, 'setCreate'])->name('addProvider')->middleware('checkSchool');
Route::post('/provider/add', [ProviderController::class, 'create'])->name('addProviderPost');
Route::get('/provider/delete/{id}', [ProviderController::class, 'delete'])->name('delProvider')->middleware('checkSchool');
Route::get('/provider/alterar/{id}', [ProviderController::class, 'setUpdate'])->name('upProvider')->middleware('checkSchool');
Route::post('/provider/alterar', [ProviderController::class, 'update'])->name('upProviderPost');
Route::get('/provider/detalhe/{id}', [ProviderController::class, 'detail'])->name('detailProvider')->middleware('checkSchool');

Route::get('/conta/rendimento/{id}', [BankIncomeController::class, 'setCreate'])->name('addBankIncome')->middleware('checkSchool');
Route::post('/conta/rendimento', [BankIncomeController::class, 'create'])->name('addBankIncomePost');
Route::get('/conta/rendimento/delete/{id}', [BankIncomeController::class, 'delete'])->name('delBankIncome')->middleware('checkSchool');
Route::get('/conta/rendimento/alterar/{id}', [BankIncomeController::class, 'setUpdate'])->name('upBankIncome')->middleware('checkSchool');
Route::post('/conta/rendimento/alterar', [BankIncomeController::class, 'update'])->name('upBankIncomePost');

Route::get('/prestacao', [AccountabilityController::class, 'show'])->name('accountability')->middleware('checkSchool');
Route::get('/prestacao/add', [AccountabilityController::class, 'setCreate'])->name('addAccountability')->middleware('checkSchool');
Route::post('/prestacao/add', [AccountabilityController::class, 'create'])->name('addAccountabilityPost');
Route::get('/prestacao/gerenciar/{id}', [AccountabilityController::class, 'manage'])->name('manageAccountability')->middleware('checkSchool');

Route::get('/prestacao/capa/{id}', [DocumentController::class, 'setPdfCapa'])->name('capa')->middleware('checkSchool');
Route::get('/prestacao/rerd/{id}', [DocumentController::class, 'setPdfRerd'])->name('rerd')->middleware('checkSchool');
Route::get('/prestacao/relPagamento/{id}', [DocumentController::class, 'setPdfRelPagamento'])->name('relPagamento')->middleware('checkSchool');

