@extends('layouts.site')

@section('content')
<div class="px-4 md:px-10 mx-auto w-full">
<div class="flex flex-wrap">
<div class="block w-full mt-24">
    <div class="flex justify-between flex-wrap">
        <a href="" class="p-3 mb-5 mr-3 bg-gray-800 text-white rounded  hover:bg-gray-600 hover:font-semibold"><i class="fas fa-undo-alt"></i> Voltar</a>
        <a href="" class="p-3 mb-5 mr-3  bg-blue-400 text-white rounded  hover:bg-blue-600 hover:font-semibold"><i class="fas fa-edit"></i> Editar Contrato</a>
        <a href="" class="p-3 mb-5 bg-red-700 text-white rounded  hover:bg-red-600 hover:font-semibold"><i class="fas fa-trash-alt"></i></i> Deletar Contrato</a>
    </div>
    @if($acesso)
        <div class="">
            <h1 class="mt-5 text-2xl text-center font-bold"><i class="fas fa-file-contract"></i> Gerenciar Contrato {{$contract->description}} - {{$contract->provider->name}}</h1>
        </div>
    @endif
    <div class="flex justify-center flex-wrap">
        <a href="" class="p-3 mb-5 mr-3  bg-gray-800 text-white rounded  hover:bg-gray-600 hover:font-semibold"><i class="fas fa-plus"></i> Adicionar {{$title_items}}</a>
        <a href="" class="p-3 mb-5 bg-gray-800 text-white rounded  hover:bg-gray-600 hover:font-semibold"><i class="fas fa-pen-square"></i> Realizar {{$title_orders}}</a>
    </div>
@if($acesso)
    <div class="flex flex-wrap mx-auto">
        <div class="w-full rounded border shadow mt-3 p-3">
            <h1 class="my-5 mt-3 text-2xl text-center font-bold">
                {{$title_items}}
            </h1>
            <table class="border-collapse w-full">
                <thead>
                    <tr>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Descrição</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Valor Unitário</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Quantidade</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Unidade</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Valor Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                    <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                        <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Descrição</span>
                        {{$item->description}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Valor Unitário</span>
                            <span class="text-red-600 font-bold">R$ {{number_format($item->unitary_value, 2, ',', '.')}}</span>
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Quantidade</span>
                            {{$item->quantity}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Unidade</span>
                            {{$item->unity}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Valor Total</span>
                            <span class="text-red-600 font-bold">R$ {{number_format($item->total_value, 2, ',', '.')}}</span>
                        </td>
                    </tr>
                    @endforeach
                    @if($items->isEmpty())
                    <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static" colspan="5">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Sem Registro</span>
                        Nâo há {{$title_items}} nesse contrato!
                    </td>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="w-full rounded border shadow mt-3 p-3">
            <h1 class="mb-5 mt-3 text-2xl text-center font-bold">{{$title_orders}}</h1>
            <table class="border-collapse w-full mt-5">
                <thead>
                    <tr>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Data</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Descrição</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Servidor Responsável</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Valor total</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                        <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Data</span>
                        {{$order->date_order->format('d/m/Y')}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Descrição</span>
                            {{$order->description}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Servidor Responsável</span>
                            {{$order->responsible}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Valor Total</span>
                            <span class="text-green-500 font-bold">R$ {{number_format($order->amount, 2, ',', '.')}}</span>
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Status {{$title_order}}</span>
                            {{$order->status}}
                        </td>
                    </tr>
                    @endforeach
                    @if($orders->isEmpty())
                    <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static" colspan="5">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Sem Registro</span>
                        Nâo há {{$title_orders}} para esse contrato!
                    </td>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@else
    <div class="max-w-2xl">
        <p class="bg-red-300 p-4 font-bold leading-normal mb-3 mt-3 rounded-lg text-green-800">Você não tem acesso a esse contrato</p>
        <img src="{{asset('img/access_danied.png')}}" class="w-full">
    </div>
@endif

</div>
@endsection
            



