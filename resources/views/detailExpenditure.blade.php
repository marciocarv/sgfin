@extends('layouts.site')

@section('content')
<div class="px-4 md:px-10 mx-auto w-full">
<div class="flex flex-wrap">
<div class="block w-full mt-24">
    <div class="flex justify-between flex-wrap">
        <a href="{{route('expenditure', ['id'=>$account->id])}}" class="p-3 mb-5 mr-3 bg-gray-800 text-white rounded  hover:bg-gray-600 hover:font-semibold"><i class="fas fa-undo-alt"></i> Voltar</a>
        <a href="{{route('upAccount', ['id'=>$account->id])}}" class="p-3 mb-5 mr-3  bg-blue-400 text-white rounded  hover:bg-blue-600 hover:font-semibold"><i class="fas fa-comment-dollar"></i> Pagar Conta</a>
    </div>
    @if($acesso)
        <div class="">
            <h1 class="mb-5 text-2xl font-bold"><i class="fas fa-file-contract"></i> Detalhes da Despesa</h1>
        </div>
    @endif
@if($acesso)
    <div>
        <table class="border-collapse w-full mt-5">
            <tr>
                <th class="p-2 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 lg:table-cell">Data</th>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 lg:table-cell">Conta</th>
            </tr>
            <tr>
                <td class="w-full lg:w-auto p-2 text-gray-800 text-center border border-b lg:table-cell lg:static text-2xl">{{$expenditure->date_expenditure->format('d/m/Y')}}</td>
                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b lg:table-cell lg:static text-2xl">{{$expenditure->account->description}}</td>
            </tr>
            <tr>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 lg:table-cell" colspan="2">Descrição</th>
            </tr>
            <tr>
                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b lg:table-cell lg:static text-2xl" colspan="2">{{$expenditure->description}}</td>
            </tr>
            <tr>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 lg:table-cell" colspan="2">Vencimento</th>
            </tr>
            <tr>
                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b lg:table-cell lg:static text-2xl" colspan="2">{{$expenditure->expiration->format('d/m/Y')}}</td>
            </tr>
            <tr>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 lg:table-cell" colspan="2">Valor</th>
            </tr>
            <tr>
                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b lg:table-cell lg:static text-2xl" colspan="2">R$ {{number_format($ordinance->value, 2, ',', '.')}}</td>
            </tr>
            <tr>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 lg:table-cell">Natureza da despesa</th>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 lg:table-cell">Fornecedor</th>
            </tr>
            <tr>
                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b lg:table-cell lg:static text-2xl">{{$expenditure->nature}}</td>
                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b lg:table-cell lg:static text-2xl">{{$expenditure->provider->name}}</td>
            </tr>
            <tr>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 lg:table-cell" colspan="2">Dados do pagamento</th>
            </tr>
            <tr>
                <th class="p-2 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 lg:table-cell">Status</th>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 lg:table-cell">Data de Pagamento</th>
            </tr>
            <tr>
                <td class="w-full lg:w-auto p-2 text-gray-800 text-center border border-b lg:table-cell lg:static text-2xl">status</td>
                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b lg:table-cell lg:static text-2xl">{{$expenditure->pay->date_pay->format('d/m/Y')}}</td>
            </tr>
            <tr>
                <th class="p-2 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 lg:table-cell">Número Nota Fiscal - Emissão</th>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 lg:table-cell">Método de Pagamento</th>
            </tr>
            <tr>
                <td class="w-full lg:w-auto p-2 text-gray-800 text-center border border-b lg:table-cell lg:static text-2xl">{{$expenditure->pay->number_invoice}} - {{$expenditure->pay->emission_invoice}}</td>
                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b lg:table-cell lg:static text-2xl">{{$expenditure->pay->payment_method}}</td>
            </tr>
        </table>
    </div>
@else
    <div class="max-w-2xl">
        <p class="bg-red-300 p-4 font-bold leading-normal mb-3 mt-3 rounded-lg text-green-800">Você não tem acesso a essa Despesa</p>
        <img src="{{asset('img/access_danied.png')}}" class="w-full">
    </div>
@endif

</div>
@endsection
            



