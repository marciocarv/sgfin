@extends('layouts.site')

@section('content')
<div class="px-4 md:px-10 mx-auto w-full">
<div class="flex flex-wrap">
<div class="block w-full mt-24">
    <a href="{{route('manageContract', ['id'=>$order->contract_id])}}" class="p-3 mb-5 bg-gray-800 text-white rounded"><i class="fas fa-undo-alt"></i> Voltar</a>
    
    <div class="">
        <h1 class="mt-5 text-2xl text-center font-bold"><i class="fas fa-file-contract"></i> Detalhes do Pedido / Ordem de Serviço {{$order->description}}</h1>
    </div>

    <div>
        <table class="border-collapse w-full mt-5">
            <thead>
                <tr>
                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Data :  <span class="text-green-500">{{$order->date_order->format('d/m/Y')}}</span></th>
                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Descrição : <span class="text-green-500">{{$order->description}}</span></th>
                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Responsável : <span class="text-green-500">{{$order->responsible}}</span></th>
                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Status: <span class="text-green-500">{{$order->status}}</span></th>
                </tr>
                <tr>
                    <td class="p-3 font-bold uppercase text-gray-600 border border-gray-300 hidden lg:table-cell text-center" colspan="4">Produtos / Serviços</td>
                </tr>
                <tr>
                    <td class="p-3 font-bold uppercase text-gray-600 border border-gray-300 hidden lg:table-cell text-center">Descrição</td>
                    <td class="p-3 font-bold uppercase text-gray-600 border border-gray-300 hidden lg:table-cell text-center">Valor Unitário</td>
                    <td class="p-3 font-bold uppercase text-gray-600 border border-gray-300 hidden lg:table-cell text-center">Quantidade</td>
                    <td class="p-3 font-bold uppercase text-gray-600 border border-gray-300 hidden lg:table-cell text-center">Valor</td>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                    <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Descrição</span>
                    {{$item->description}}
                    </td>
                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">valor Unitário</span>
                        R$ {{number_format($item->unitary_value, 2, ',', '.')}}
                    </td>
                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Quantidade</span>
                        {{$item->pivot->quantity}}
                    </td>
                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">valor</span>
                        R$ {{number_format($item->unitary_value * $item->pivot->quantity, 2, ',', '.')}}
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td class="p-3 font-bold uppercase text-gray-600 border border-gray-300 hidden lg:table-cell text-center" colspan="3">Total</td>
                    <td class="p-3 font-bold uppercase text-gray-600 border border-gray-300 hidden lg:table-cell text-center">R$ {{number_format($order->amount, 2, ',', '.')}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
            



