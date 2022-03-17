@extends('layouts.site')

@section('content')
<div class="w-full px-4 mx-auto md:px-10">
<div class="flex flex-wrap">
<div class="block w-full mt-24">
    <div class="flex flex-wrap justify-between">
        <a href="{{route('account')}}" class="p-3 mb-5 mr-3 text-white bg-gray-800 rounded hover:bg-gray-600 hover:font-semibold"><i class="fas fa-undo-alt"></i> Voltar</a>
        <a href="{{route('upAccount', ['id'=>$account->id])}}" class="p-3 mb-5 mr-3 text-white bg-blue-400 rounded hover:bg-blue-600 hover:font-semibold"><i class="fas fa-edit"></i> Editar Conta</a>
        <a href="{{route('delAccount', ['id'=>$account->id])}}" class="p-3 mb-5 text-white bg-red-700 rounded hover:bg-red-600 hover:font-semibold"><i class="fas fa-trash-alt"></i></i> Deletar Conta</a>
    </div>
    <div>
        <form action="{{route('manageAcount', ['id'=>$account->id])}}" method="GET" class="flex flex-wrap justify-center">
            <div class="lg:w-auto"><label class="m-2 font-semibold">Data Inicial:</label><input type="date" name="dataInicial" value="{{$dataInicial}}" class="px-3 py-2 m-1 text-sm text-gray-700 rounded shadow focus:outline-none focus:shadow-outline" /></div>
            <div class="lg:w-auto"><label class="m-2 font-semibold">Data Final:</label><input type="date" name="dataFinal" value="{{$dataFinal}}" class="px-3 py-2 m-1 text-sm text-gray-700 rounded shadow focus:outline-none focus:shadow-outline" /></div>
            <div class="lg:w-auto"><button
                class="w-full max-w-xs px-6 py-3 mx-3 text-sm font-bold text-white uppercase bg-gray-900 rounded shadow outline-none active:bg-gray-700 hover:shadow-lg focus:outline-none"
                type="submit"
                id="btn-submit"
                style="transition: all 0.15s ease 0s;"
                >
                Aplicar
            </button>
            </div>
        </form>
    </div>
@if (session('msg'))
    <p class="p-4 mt-3 mb-3 font-bold leading-normal text-green-800 bg-green-300 rounded-lg">{{ session('msg') }}</p>
@endif

<div class="flex flex-wrap justify-between my-5 border rounded shadow">
    <p class="m-5 text-2xl font-semibold">Saldo Anterior: <span class="font-bold">R$ {{number_format($previousBallance, 2, ',', '.')}}</span></p>
    <p class="m-5 text-2xl font-semibold">Saldo Final: <span class="font-bold">R$ {{number_format($ballanceFinal, 2, ',', '.')}}</span></p>
</div>
<div class="flex flex-wrap justify-between my-5 border rounded shadow">
    <p class="m-5 text-2xl font-semibold"></p>
    <p class="m-5 text-sm font-semibold">Saldo Capital: <span class="font-bold">R$ {{number_format($ballanceCapital, 2, ',', '.')}}</span>  | Saldo Custeio: <span class="font-bold">R$ {{number_format($ballanceCusteio, 2, ',', '.')}}</span></p>
</div>
<div class="w-full mt-5">
    <div class="flex flex-wrap py-3 border rounded shadow">
        <div class="w-full px-4 mt-5 xl:w-6/12">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white rounded shadow-lg xl:mb-0">
                <p class="text-xl font-bold text-center text-gray-600">Recursos recebidos - {{date('d/m/Y', strtotime($dataInicial))}} à {{date('d/m/Y', strtotime($dataFinal))}}</p>
                <table class="w-full mt-5 border-collapse">
                    <thead>
                        <tr>
                            <th class="hidden p-3 font-bold text-gray-600 uppercase bg-gray-200 border border-gray-300 lg:table-cell">Data</th>
                            <th class="hidden p-3 font-bold text-gray-600 uppercase bg-gray-200 border border-gray-300 lg:table-cell">Descrição</th>
                            <th class="hidden p-3 font-bold text-gray-600 uppercase bg-gray-200 border border-gray-300 lg:table-cell">Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($incomes as $income)
                    <tr class="flex flex-row flex-wrap mb-10 bg-white lg:hover:bg-gray-100 lg:table-row lg:flex-row lg:flex-no-wrap lg:mb-0">
                        <td class="relative block w-full p-3 text-xs text-center text-gray-800 border border-b lg:w-auto lg:table-cell lg:static">
                        <span class="absolute top-0 left-0 px-2 py-1 text-xs font-bold uppercase bg-blue-200 lg:hidden">Data</span>
                        {{$income->date_income->format('d/m/Y')}}
                        </td>
                        <td class="relative block w-full p-3 text-xs text-center text-gray-800 border border-b lg:w-auto lg:table-cell lg:static">
                            <span class="absolute top-0 left-0 px-2 py-1 text-xs font-bold uppercase bg-blue-200 lg:hidden">Descrição</span>
                            {{$income->description}}
                        </td>
                        <td class="relative block w-full p-3 text-xs text-center text-gray-800 border border-b lg:w-auto lg:table-cell lg:static">
                            <span class="absolute top-0 left-0 px-2 py-1 text-xs font-bold uppercase bg-blue-200 lg:hidden">Valor</span>
                            <span class="font-bold text-green-600">R$ {{number_format($income->amount, 2, ',', '.')}}</span>
                        </td>
                    </tr>
                    @endforeach
                    @if($incomes->isEmpty())
                    <td class="relative block w-full p-3 text-center text-gray-800 border border-b lg:w-auto lg:table-cell lg:static" colspan="3">
                        <span class="absolute top-0 left-0 px-2 py-1 text-xs font-bold uppercase bg-blue-200 lg:hidden">Valor Total</span>
                        Nâo há Receitas! <a href="{{route('income', ['id'=>$account->id])}}" class="font-semibold text-green-500 hover:text-green-800">Cadastrar Receita</a>
                    </td>
                    @endif
                    <tr class="flex flex-row flex-wrap mb-10 bg-white lg:hover:bg-gray-100 lg:table-row lg:flex-row lg:flex-no-wrap lg:mb-0">
                        <td class="relative block w-full p-3 text-xs text-center text-gray-800 bg-gray-200 border border-b lg:w-auto lg:table-cell lg:static" colspan="2">
                            <span class="font-semibold text-gray-900">Total de receitas do período:</span>
                        </td>
                        <td class="relative block w-full p-3 text-xs text-center text-gray-800 bg-gray-200 border border-b lg:w-auto lg:table-cell lg:static">
                            <span class="font-bold text-green-900">R$ {{number_format($fullIncomes, 2, ',', '.')}}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="w-full px-4 mt-5 xl:w-6/12">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white rounded shadow-lg xl:mb-0">
            <p class="text-xl font-bold text-center text-gray-600">Pagamentos - {{date('d/m/Y', strtotime($dataInicial))}} à {{date('d/m/Y', strtotime($dataFinal))}}</p>
            <table class="w-full mt-5 border-collapse">
                <thead>
                    <tr>
                        <th class="hidden p-3 font-bold text-gray-600 uppercase bg-gray-200 border border-gray-300 lg:table-cell">Data</th>
                        <th class="hidden p-3 font-bold text-gray-600 uppercase bg-gray-200 border border-gray-300 lg:table-cell">Descrição</th>
                        <th class="hidden p-3 font-bold text-gray-600 uppercase bg-gray-200 border border-gray-300 lg:table-cell">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($expenditures as $expenditure)
                    <tr class="flex flex-row flex-wrap mb-10 bg-white lg:hover:bg-gray-100 lg:table-row lg:flex-row lg:flex-no-wrap lg:mb-0">
                        <td class="relative block w-full p-3 text-xs text-center text-gray-800 border border-b lg:w-auto lg:table-cell lg:static">
                        <span class="absolute top-0 left-0 px-2 py-1 text-xs font-bold uppercase bg-blue-200 lg:hidden">Data</span>
                        {{date('d/m/Y', strtotime($expenditure->date_pay))}}
                        </td>
                        <td class="relative block w-full p-3 text-xs text-center text-gray-800 border border-b lg:w-auto lg:table-cell lg:static">
                            <span class="absolute top-0 left-0 px-2 py-1 text-xs font-bold uppercase bg-blue-200 lg:hidden">Descrição</span>
                            {{$expenditure->description}}
                        </td>
                        <td class="relative block w-full p-3 text-xs text-center text-gray-800 border border-b lg:w-auto lg:table-cell lg:static">
                            <span class="absolute top-0 left-0 px-2 py-1 text-xs font-bold uppercase bg-blue-200 lg:hidden">Valor</span>
                            <span class="font-bold text-red-600">R$ {{number_format($expenditure->value + $expenditure->interest, 2, ',', '.')}}</span>
                        </td>
                    </tr>
                    @endforeach
                    @if($expenditures->isEmpty())
                    <td class="relative block w-full p-3 text-center text-gray-800 border border-b lg:w-auto lg:table-cell lg:static" colspan="3">
                        <span class="absolute top-0 left-0 px-2 py-1 text-xs font-bold uppercase bg-blue-200 lg:hidden"></span>
                        Nâo há Despesas! <a href="{{route('expenditure', ['id'=>$account->id])}}" class="font-semibold text-green-500 hover:text-green-800">Cadastrar Despesa</a>
                    </td>
                    @endif
                    <tr class="flex flex-row flex-wrap mb-10 bg-white lg:hover:bg-gray-100 lg:table-row lg:flex-row lg:flex-no-wrap lg:mb-0">
                        <td class="relative block w-full p-3 text-xs text-center text-gray-800 bg-gray-200 border border-b lg:w-auto lg:table-cell lg:static" colspan="2">
                            <span class="font-semibold text-gray-900">Total de despesas do período:</span>
                        </td>
                        <td class="relative block w-full p-3 text-xs text-center text-gray-800 bg-gray-200 border border-b lg:w-auto lg:table-cell lg:static">
                            <span class="font-bold text-red-900">R$ {{number_format($fullExpenditures, 2, ',', '.')}}</span>
                        </td>
                    </tr>
                </tbody>
        </table>
        </div>
    </div>
    <div class="w-full px-4 mt-5 xl:w-6/12">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white rounded shadow-lg xl:mb-0">
            <p class="text-xl font-bold text-center text-gray-600">Rendimentos - {{date('d/m/Y', strtotime($dataInicial))}} à {{date('d/m/Y', strtotime($dataFinal))}}</p>
            <table class="w-full mt-5 border-collapse">
                <thead>
                    <tr>
                        <th class="hidden p-3 font-bold text-gray-600 uppercase bg-gray-200 border border-gray-300 lg:table-cell">Data</th>
                        <th class="hidden p-3 font-bold text-gray-600 uppercase bg-gray-200 border border-gray-300 lg:table-cell">Valor</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($bankIncomes as $bankIncome)
                <tr class="flex flex-row flex-wrap mb-10 bg-white lg:hover:bg-gray-100 lg:table-row lg:flex-row lg:flex-no-wrap lg:mb-0">
                    <td class="relative block w-full p-3 text-xs text-center text-gray-800 border border-b lg:w-auto lg:table-cell lg:static">
                    <span class="absolute top-0 left-0 px-2 py-1 text-xs font-bold uppercase bg-blue-200 lg:hidden">Data</span>
                    {{$bankIncome->date_bank_income->format('d/m/Y')}}
                    </td>
                    <td class="relative block w-full p-3 text-xs text-center text-gray-800 border border-b lg:w-auto lg:table-cell lg:static">
                        <span class="absolute top-0 left-0 px-2 py-1 text-xs font-bold uppercase bg-blue-200 lg:hidden">Valor</span>
                        <span class="font-bold text-green-600">R$ {{number_format($bankIncome->value, 2, ',', '.')}}</span>
                    </td>
                </tr>
                @endforeach
                @if($bankIncomes->isEmpty())
                <td class="relative block w-full p-3 text-center text-gray-800 border border-b lg:w-auto lg:table-cell lg:static" colspan="2">
                    <span class="absolute top-0 left-0 px-2 py-1 text-xs font-bold uppercase bg-blue-200 lg:hidden"></span>
                    Nâo há Rendimentos! <a href="{{route('addBankIncome', ['id'=>$account->id])}}" class="font-semibold text-green-500 hover:text-green-800">Cadastrar Rendimento</a>
                </td>
                @endif
                <tr class="flex flex-row flex-wrap mb-10 bg-white lg:hover:bg-gray-100 lg:table-row lg:flex-row lg:flex-no-wrap lg:mb-0">
                    <td class="relative block w-full p-3 text-xs text-center text-gray-800 bg-gray-200 border border-b lg:w-auto lg:table-cell lg:static">
                        <span class="font-semibold text-gray-900">Total de rendimentos do período:</span>
                    </td>
                    <td class="relative block w-full p-3 text-xs text-center text-gray-800 bg-gray-200 border border-b lg:w-auto lg:table-cell lg:static">
                        <span class="font-bold text-green-900">R$ {{number_format($fullBankIncomes, 2, ',', '.')}}</span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="w-full px-4 mt-5 xl:w-6/12">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-teal-100 rounded shadow-lg xl:mb-0">
            <p class="text-xl font-bold text-center text-blue-800">Gerenciamento de Rendimentos</p>
            <p class="flex justify-center my-5">
                <a href="{{route('addBankIncome', ['id'=>$account->id])}}" class="p-3 mb-5 mr-3 text-center text-white bg-gray-800 rounded hover:bg-gray-600 hover:font-semibold w-36"><i class="far fa-list-alt"></i> Cadastrar</a>
            </p>
        </div>
    </div>
</div>
</div>
</div>
@endsection


