@extends('layouts.site')

@section('content')
<div class="px-4 md:px-10 mx-auto w-full">
<div class="flex flex-wrap">
<div class="block w-full mt-24">
    <div class="flex justify-between flex-wrap">
        <a href="{{route('account')}}" class="p-3 mb-5 mr-3 bg-gray-800 text-white rounded  hover:bg-gray-600 hover:font-semibold"><i class="fas fa-undo-alt"></i> Voltar</a>
        <a href="{{route('upAccount', ['id'=>$account->id])}}" class="p-3 mb-5 mr-3  bg-blue-400 text-white rounded  hover:bg-blue-600 hover:font-semibold"><i class="fas fa-edit"></i> Editar Conta</a>
        <a href="{{route('delAccount', ['id'=>$account->id])}}" class="p-3 mb-5 bg-red-700 text-white rounded  hover:bg-red-600 hover:font-semibold"><i class="fas fa-trash-alt"></i></i> Deletar Conta</a>
    </div>
    <div>
        <form action="{{route('manageAcount', ['id'=>$account->id])}}" method="GET" class="flex flex-wrap justify-center">
            <div class="lg:w-auto"><label class="font-semibold m-2">Data Inicial:</label><input type="date" name="dataInicial" value="{{$dataInicial}}" class="px-3 py-2 m-1 text-gray-700 rounded text-sm shadow focus:outline-none focus:shadow-outline" /></div>
            <div class="lg:w-auto"><label class="font-semibold m-2">Data Final:</label><input type="date" name="dataFinal" value="{{$dataFinal}}" class="px-3 py-2 m-1 text-gray-700 rounded text-sm shadow focus:outline-none focus:shadow-outline" /></div>
            <div class="lg:w-auto"><button
                class="bg-gray-900 text-white active:bg-gray-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mx-3 w-full max-w-xs"
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
    <p class="bg-green-300 p-4 font-bold leading-normal mb-3 mt-3 rounded-lg text-green-800">{{ session('msg') }}</p>
@endif

<div class="flex flex-wrap justify-between rounded border shadow my-5">
    <p class="font-semibold text-2xl m-5">Saldo Anterior: <span class="font-bold">R$ {{number_format($previousBallance, 2, ',', '.')}}</span></p>
    <p class="font-semibold text-2xl m-5">Saldo Final: <span class="font-bold">R$ {{number_format($ballanceFinal, 2, ',', '.')}}</span></p>
</div>
<div class="flex flex-wrap justify-between rounded border shadow my-5">
    <p class="font-semibold text-2xl m-5"></p>
    <p class="font-semibold text-sm m-5">Saldo Capital: <span class="font-bold">R$ {{number_format($ballanceCapital, 2, ',', '.')}}</span>  | Saldo Custeio: <span class="font-bold">R$ {{number_format($ballanceCusteio, 2, ',', '.')}}</span></p>
</div>
<div class="w-full mt-5">
    <div class="flex flex-wrap rounded border shadow py-3">
        <div class="w-full xl:w-6/12 px-4 mt-5">
            <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                <p class="font-bold text-center text-xl text-gray-600">Recursos recebidos - {{date('d/m/Y', strtotime($dataInicial))}} à {{date('d/m/Y', strtotime($dataFinal))}}</p>
                <table class="border-collapse w-full mt-5">
                    <thead>
                        <tr>
                            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Data</th>
                            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Descrição</th>
                            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($incomes as $income)
                    <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                        <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Data</span>
                        {{$income->date_income->format('d/m/Y')}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Descrição</span>
                            {{$income->description}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Valor</span>
                            <span class="text-green-600 font-bold">R$ {{number_format($income->amount, 2, ',', '.')}}</span>
                        </td>
                    </tr>
                    @endforeach
                    @if($incomes->isEmpty())
                    <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static" colspan="3">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Valor Total</span>
                        Nâo há Receitas! <a href="{{route('income', ['id'=>$account->id])}}" class="text-green-500 hover:text-green-800 font-semibold">Cadastrar Receita</a>
                    </td>
                    @endif
                    <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                        <td class="bg-gray-200 w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static" colspan="2">
                            <span class="text-gray-900 font-semibold">Total de receitas do período:</span>
                        </td>
                        <td class="bg-gray-200 w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                            <span class="text-green-900 font-bold">$ {{number_format($fullIncomes, 2, ',', '.')}}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="w-full xl:w-6/12 px-4 mt-5">
        <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
            <p class="font-bold text-center text-xl text-gray-600">Pagamentos - {{date('d/m/Y', strtotime($dataInicial))}} à {{date('d/m/Y', strtotime($dataFinal))}}</p>
            <table class="border-collapse w-full mt-5">
                <thead>
                    <tr>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Data de Pagamento</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Descrição</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($expenditures as $expenditure)
                    <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                        <td class="w-full lg:w-auto p-3 text-gray-800  border border-b text-center block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Data de Pagamento</span>
                        {{date('d/m/Y', strtotime($expenditure->date_pay))}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Descrição</span>
                            {{$expenditure->description}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Valor</span>
                            <span class="text-red-600 font-bold">R$ {{number_format($expenditure->value + $expenditure->interest, 2, ',', '.')}}</span>
                        </td>
                    </tr>
                    @endforeach
                    @if($expenditures->isEmpty())
                    <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static" colspan="3">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase"></span>
                        Nâo há Despesas! <a href="{{route('expenditure', ['id'=>$account->id])}}" class="text-green-500 hover:text-green-800 font-semibold">Cadastrar Despesa</a>
                    </td>
                    @endif
                    <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                        <td class="bg-gray-200 w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static" colspan="2">
                            <span class="text-gray-900 font-semibold">Total de despesas do período:</span>
                        </td>
                        <td class="bg-gray-200 w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                            <span class="text-red-900 font-bold">$ {{number_format($fullExpenditures, 2, ',', '.')}}</span>
                        </td>
                    </tr>
                </tbody>
        </table>
        </div>
    </div>
    <div class="w-full xl:w-6/12 px-4 mt-5">
        <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
            <p class="font-bold text-center text-xl text-gray-600">Rendimentos - {{date('d/m/Y', strtotime($dataInicial))}} à {{date('d/m/Y', strtotime($dataFinal))}}</p>
            <table class="border-collapse w-full mt-5">
                <thead>
                    <tr>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Data</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Valor</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($bankIncomes as $bankIncome)
                <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                    <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Data</span>
                    {{$bankIncome->date_bank_income->format('d/m/Y')}}
                    </td>
                    <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Valor</span>
                        <span class="text-green-600 font-bold">R$ {{number_format($bankIncome->value, 2, ',', '.')}}</span>
                    </td>
                </tr>
                @endforeach
                @if($bankIncomes->isEmpty())
                <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static" colspan="2">
                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase"></span>
                    Nâo há Rendimentos! <a href="{{route('addBankIncome', ['id'=>$account->id])}}" class="text-green-500 hover:text-green-800 font-semibold">Cadastrar Rendimento</a>
                </td>
                @endif
                <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                    <td class="bg-gray-200 w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                        <span class="text-gray-900 font-semibold">Total de rendimentos do período:</span>
                    </td>
                    <td class="bg-gray-200 w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                        <span class="text-green-900 font-bold">$ {{number_format($fullBankIncomes, 2, ',', '.')}}</span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="w-full xl:w-6/12 px-4 mt-5">
        <div class="relative flex flex-col min-w-0 break-words bg-teal-100 rounded mb-6 xl:mb-0 shadow-lg">
            <p class="font-bold text-center text-xl text-blue-800">Gerenciamento de Rendimentos</p>
            <p class="flex justify-center my-5">
                <a href="{{route('addBankIncome', ['id'=>$account->id])}}" class="p-3 mb-5 mr-3 bg-gray-800 text-white rounded text-center  hover:bg-gray-600 hover:font-semibold w-36"><i class="far fa-list-alt"></i> Cadastrar</a>
            </p>
        </div>
    </div>
</div>
</div>
</div>
@endsection


