<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdinanceController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ExpenditureController;
use App\Http\Controllers\FixedExpenditureController;
use App\Http\Controllers\testeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\BankIncomeController;
use App\Http\Controllers\AccountabilityController;
use App\Http\Controllers\TenancyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AceController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ContractController;


Route::get('/teste', [DocumentController::class, 'teste']);

//Rotas de página inicial e dashboad


Route::get('/', function () {
    if(session('school')){
        return redirect()->route('dashboard');
    }else{
        return view('welcome');
    }
    
});

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

Route::prefix('perfil')->group(function(){
    Route::get('/', [TenancyController::class, 'show'])->name('profile')->middleware('checkSchool');
    Route::get('/editar/{id}', [UserController::class, 'setUpdate'])->name('upUser')->middleware('checkSchool');
    Route::post('/editar', [UserController::class, 'update'])->name('upUserPost');
});

Route::prefix('escola')->group(function(){
    Route::get('/', [SchoolController::class, 'create'])->middleware('checkTen');
    Route::post('/', [SchoolController::class, 'create'])->name('addSchool');
    Route::get('/editar/{id}', [SchoolController::class, 'setUpdate'])->name('upSchool')->middleware('checkSchool');
    Route::post('/editar', [SchoolController::class, 'update'])->name('upSchoolPost');

});

Route::prefix('ace')->group(function(){
    Route::get('/editar/{id}', [AceController::class, 'setUpdate'])->name('upAce')->middleware('checkSchool');
    Route::post('/editar', [AceController::class, 'update'])->name('upAcePost');
});

Route::prefix('portaria')->group(function(){
    Route::get('/', [OrdinanceController::class, 'show'])->middleware('checkSchool')->name('ordinance');
    Route::get('/add', [OrdinanceController::class, 'setCreate'])->name('addOrdinance')->middleware('checkSchool');
    Route::post('/add', [OrdinanceController::class, 'create'])->name('addOrdinancePost');
    Route::get('/delete/{id}', [OrdinanceController::class, 'delete'])->name('delOrdinance')->middleware('checkSchool');
    Route::get('/alterar/{id}', [OrdinanceController::class, 'setUpdate'])->name('upOrdinance')->middleware('checkSchool');
    Route::post('/alterar', [OrdinanceController::class, 'update'])->name('upOrdinancePost');
    Route::get('/detalhe/{id}', [OrdinanceController::class, 'detail'])->name('detailOrdinance')->middleware('checkSchool');
});

Route::prefix('conta')->group(function(){
    Route::get('/', [AccountController::class, 'show'])->name('account')->middleware('checkSchool');
    Route::get('/gerenciar/{id}', [AccountController::class, 'manage'])->name('manageAcount')->middleware('checkSchool');
    Route::get('/add', [AccountController::class, 'setCreate'])->name('addAccount')->middleware('checkSchool');
    Route::post('/add', [AccountController::class, 'create'])->name('addAccountPost');
    Route::get('/delete/{id}', [AccountController::class, 'delete'])->name('delAccount')->middleware('checkSchool');
    Route::get('/alterar/{id}', [AccountController::class, 'setUpdate'])->name('upAccount')->middleware('checkSchool');
    Route::post('/alterar', [AccountController::class, 'update'])->name('upAccountPost');
    Route::get('/escolher/{movimento}', [AccountController::class, 'choose'])->name('chooseAccount')->middleware('checkSchool');

    //Rotas de Conta/Rendimento

    Route::get('/rendimento/{id}', [BankIncomeController::class, 'setCreate'])->name('addBankIncome')->middleware('checkSchool');
    Route::post('/rendimento', [BankIncomeController::class, 'create'])->name('addBankIncomePost');
    Route::get('/rendimento/delete/{id}', [BankIncomeController::class, 'delete'])->name('delBankIncome')->middleware('checkSchool');
    Route::get('/rendimento/alterar/{id}', [BankIncomeController::class, 'setUpdate'])->name('upBankIncome')->middleware('checkSchool');
    Route::post('/rendimento/alterar', [BankIncomeController::class, 'update'])->name('upBankIncomePost');
});

Route::prefix('receita')->group(function(){
    Route::get('/{id}', [IncomeController::class, 'show'])->name('income')->middleware('checkSchool');
    Route::get('/add/{id}', [IncomeController::class, 'setCreate'])->name('addIncome')->middleware('checkSchool');
    Route::post('/add', [IncomeController::class, 'create'])->name('addIncomePost');
    Route::get('/delete/{id}', [IncomeController::class, 'delete'])->name('delIncome')->middleware('checkSchool');
    Route::get('/alterar/{id}', [IncomeController::class, 'setUpdate'])->name('upIncome')->middleware('checkSchool');
    Route::post('/alterar', [IncomeController::class, 'update'])->name('upIncomePost');
});

Route::prefix('despesa')->group(function(){
    Route::get('/{id}', [ExpenditureController::class, 'show'])->name('expenditure')->middleware('checkSchool');
    Route::get('/add/{id}', [ExpenditureController::class, 'setCreate'])->name('addExpenditure')->middleware('checkSchool');
    Route::post('/add', [ExpenditureController::class, 'create'])->name('addExpenditurePost');
    Route::get('/delete/{id}', [ExpenditureController::class, 'delete'])->name('delExpenditure')->middleware('checkSchool');
    Route::get('/alterar/{id}', [ExpenditureController::class, 'setUpdate'])->name('upExpenditure')->middleware('checkSchool');
    Route::post('/alterar', [ExpenditureController::class, 'update'])->name('upExpenditurePost');
    Route::get('/detalhe/{id}', [ExpenditureController::class, 'detail'])->name('detailExpenditure')->middleware('checkSchool');
    Route::post('/gerar', [ExpenditureController::class, 'GerExpenditureByOrder'])->name('gerExpenditureByOrder');
});

Route::prefix('despesa_fixa')->group(function(){
    Route::get('/{id}', [FixedExpenditureController::class, 'show'])->name('fixedExpenditure')->middleware('checkSchool');
    Route::get('/gerar/{id}', [FixedExpenditureController::class, 'setGerar'])->name('gerExpenditure')->middleware('checkSchool');
    Route::post('/gerar', [FixedExpenditureController::class, 'Gerar'])->name('gerExpenditurePost')->middleware('checkSchool');
    Route::get('/delete/{id}', [FixedExpenditureController::class, 'delete'])->name('delFixedExpenditure')->middleware('checkSchool');
    Route::get('/alterar/{id}', [FixedExpenditureController::class, 'setUpdate'])->name('upFixedExpenditure')->middleware('checkSchool');
    Route::post('/alterar', [FixedExpenditureController::class, 'update'])->name('upFixedExpenditurePost')->middleware('checkSchool');
});

Route::prefix('pagamento')->group(function(){
    Route::get('/pagar/{id}', [PayController::class, 'setPay'])->name('payExpenditure')->middleware('checkSchool');
    Route::post('/pagar/add', [PayController::class, 'create'])->name('addPay');
    Route::get('/cancelar/{id}', [Paycontroller::class, 'delete'])->name('delPay')->middleware('checkSchool');
});

Route::prefix('provider')->group(function(){
    Route::get('/', [ProviderController::class, 'show'])->name('provider')->middleware('checkSchool');
    Route::get('/add', [ProviderController::class, 'setCreate'])->name('addProvider')->middleware('checkSchool');
    Route::post('r/add', [ProviderController::class, 'create'])->name('addProviderPost');
    Route::get('/delete/{id}', [ProviderController::class, 'delete'])->name('delProvider')->middleware('checkSchool');
    Route::get('/alterar/{id}', [ProviderController::class, 'setUpdate'])->name('upProvider')->middleware('checkSchool');
    Route::post('/alterar', [ProviderController::class, 'update'])->name('upProviderPost');
    Route::get('/detalhe/{id}', [ProviderController::class, 'detail'])->name('detailProvider')->middleware('checkSchool');
});

Route::prefix('prestacao')->group(function(){
    Route::get('/', [AccountabilityController::class, 'show'])->name('accountability')->middleware('checkSchool');
    Route::get('/add', [AccountabilityController::class, 'setCreate'])->name('addAccountability')->middleware('checkSchool');
    Route::post('/add', [AccountabilityController::class, 'create'])->name('addAccountabilityPost');
    Route::get('/gerenciar/{id}', [AccountabilityController::class, 'manage'])->name('manageAccountability')->middleware('checkSchool');
    Route::get('/capa/{id}', [DocumentController::class, 'setPdfCapa'])->name('capa')->middleware('checkSchool');
    Route::get('/rerd/{id}', [DocumentController::class, 'setPdfRerd'])->name('rerd')->middleware('checkSchool');
    Route::get('/relPagamento/{id}', [DocumentController::class, 'setPdfRelPagamento'])->name('relPagamento')->middleware('checkSchool');
});

Route::prefix('contrato')->group(function(){
    Route::get('/', [ContractController::class, 'show'])->name('contract')->middleware('checkSchool');
    Route::get('/add', [ContractController::class, 'setCreate'])->name('addContract')->middleware('checkSchool');
    Route::post('/add', [ContractController::class, 'create'])->name('addContractPost');
    Route::get('/alterar/{id}', [ContractController::class, 'setUpdate'])->name('upContract')->middleware('checkSchool');
    Route::post('/alterar', [ContractController::class, 'update'])->name('upContractPost');
    Route::get('/delete/{id}', [ContractController::class, 'delete'])->name('delContract')->middleware('checkSchool');
    Route::get('/gerenciar/{id}', [ContractController::class, 'manage'])->name('manageContract')->middleware('checkSchool');

});

Route::prefix('item')->group(function(){
    Route::post('/add', [ItemController::class, 'create'])->name('addItem');
    Route::get('/delete/{id}', [ItemController::class, 'delete'])->name('delItem')->middleware('checkSchool');
});

Route::prefix('pedido')->group(function(){
    Route::get('/add/{id}', [OrderController::class, 'setCreate'])->name('addOrder')->middleware('checkSchool');
    Route::post('/add', [OrderController::class, 'create'])->name('addOrderPost');
    Route::get('/detail/{id}', [OrderController::class, 'detail'])->name('detailOrder')->middleware('checkSchool');
    Route::get('/delete/{id}', [OrderController::class, 'delete'])->name('delOrder')->middleware('checkSchool');
    Route::get('/alterar/{id}', [OrderController::class, 'setUpdate'])->name('upOrder')->middleware('checkSchool');
    Route::post('/alterar', [OrderController::class, 'update'])->name('upOrderPost')->middleware('checkSchool');
    Route::get('/gerar_despesa/{id}', [OrderController::class, 'setGerExpenditure'])->name('gerExpenditureByOrder')->middleware('checkSchool');
});
