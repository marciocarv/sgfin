@extends('layouts.site')

@section('content')
<div class="px-4 md:px-10 mx-auto w-full">
<div class="flex flex-wrap">
<div class="block w-full mt-24">
    @if($acesso)
        <div class="">
            <h1 class="mb-5 text-2xl font-bold"><i class="fas fa-file-contract"></i> Detalhes da portaria Nº {{number_format($ordinance->number, 0, '', '.')}}</h1>
        </div>
    @endif
<a href="{{route('ordinance')}}" class="p-3 mb-5 bg-gray-800 text-white rounded"><i class="fas fa-undo-alt"></i> Voltar</a>
@if($acesso)
    <div>
        <table class="border-collapse w-full mt-5">
            <tr>
                <th class="p-2 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 lg:table-cell">Data</th>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 lg:table-cell">Número</th>
            </tr>
            <tr>
                <td class="w-full lg:w-auto p-2 text-gray-800 text-center border border-b lg:table-cell lg:static text-2xl">{{$ordinance->date_ordinance->format('d/m/Y')}}</td>
                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b lg:table-cell lg:static text-2xl">{{number_format($ordinance->number, 0, '', '.')}}</td>
            </tr>
            <tr>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 lg:table-cell" colspan="2">Descrição</th>
            </tr>
            <tr>
                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b lg:table-cell lg:static text-2xl" colspan="2">{{$ordinance->description}}</td>
            </tr>
            <tr>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 lg:table-cell" colspan="2">Valor</th>
            </tr>
            <tr>
                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b lg:table-cell lg:static text-2xl" colspan="2">R$ {{number_format($ordinance->amount, 2, ',', '.')}}</td>
            </tr>
            <tr>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 lg:table-cell">Número do Diário</th>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 lg:table-cell">Número do Processo</th>
            </tr>
            <tr>
                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b lg:table-cell lg:static text-2xl">{{number_format($ordinance->number_diario, 0, '', '.')}}</td>
                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b lg:table-cell lg:static text-2xl">{{number_format($ordinance->number_process, 0, '', '.')}}</td>
            </tr>
            </tr>
            <tr>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 lg:table-cell">Natureza</th>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 lg:table-cell">Fonte</th>
            </tr>
            <tr>
                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b lg:table-cell lg:static text-2xl">{{$ordinance->nature}}</td>
                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b lg:table-cell lg:static text-2xl">{{$ordinance->source}}</td>
            </tr>
        </table>
    </div>
    <div class="flex flex-wrap mx-auto">
        <div class="w-full">
            <h1 class="mb-5 mt-13 text-2xl font-bold">Entrada de Recursos da Portaria Nº {{number_format($ordinance->number, 0, '', '.')}}</h1>
            <table class="border-collapse w-full mt-5">
                <thead>
                    <tr>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Data</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Descrição</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Valor Custeio</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Valor Capital</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Valor Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($incomes as $income)
                    <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Data</span>
                        {{$income->date_income->format('d/m/Y')}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Descrição</span>
                            {{$income->description}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Valor Custeio</span>
                            R$ {{number_format($income->value_custeio, 2, ',', '.')}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Valor Capital</span>
                        R$ {{number_format($income->value_capital, 2, ',', '.')}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Valor Total</span>
                            R$ {{number_format($income->amount, 2, ',', '.')}}
                        </td>
                    </tr>
                    @endforeach
                    @if($incomes->isEmpty())
                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static" colspan="5">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Valor Total</span>
                        Nâo há Entradas para essa portaria!
                    </td>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="w-full">
            <h1 class="mb-5 mt-13 text-2xl font-bold">Licitação da Portaria Nº {{number_format($ordinance->number, 0, '', '.')}}</h1>
            <table class="border-collapse w-full mt-5">
                <thead>
                    <tr>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Processo</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Objeto</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Tipo</th>
                    </tr>
                </thead>
                <tbody>
                    @if($bidding)
                    <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Processo</span>
                        {{$bidding->num_process}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Objeto</span>
                            {{$bidding->object}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Tipo</span>
                            {{$bidding->tipe}}
                        </td>
                    </tr>
                    @else
                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static" colspan="5">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Valor Total</span>
                        Nâo há Licitação Vinculada a essa portaria!
                    </td>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@else
    <div class="max-w-2xl">
        <p class="bg-red-300 p-4 font-bold leading-normal mb-3 mt-3 rounded-lg text-green-800">Você não tem acesso a essa Portaria</p>
        <img src="{{asset('img/access_danied.png')}}" class="w-full">
    </div>
@endif

</div>
@endsection
            



