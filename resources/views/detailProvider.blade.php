@extends('layouts.site')

@section('content')
<div class="px-4 md:px-10 mx-auto w-full">
<div class="flex flex-wrap">
<div class="block w-full mt-24">
    <a href="{{route('provider')}}" class="p-3 mb-5 bg-gray-800 text-white rounded"><i class="fas fa-undo-alt"></i> Voltar</a>
    @if($acesso)
        <div class="">
            <h1 class="mt-5 text-2xl text-center font-bold"><i class="fas fa-file-contract"></i> Detalhes do Fornecedor Nº {{$provider->name}}</h1>
        </div>
    @endif
@if($acesso)
    <div>
        <table class="border-collapse w-full mt-5">
            <tr>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 lg:table-cell" colspan="2">Nome</th>
            </tr>
            <tr>
                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b lg:table-cell lg:static text-2xl" colspan="2">{{$provider->name}}</td>
            </tr>
            @if($provider->person_type === 'Jurídica')
            <tr>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 lg:table-cell" colspan="2">Razão Social</th>
            </tr>
            <tr>
                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b lg:table-cell lg:static text-2xl" colspan="2">{{$provider->company_name}}</td>
            </tr>
            @endif
            <tr>
                <th class="p-2 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 lg:table-cell">CPF / CNPJ</th>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 lg:table-cell">Telefone</th>
            </tr>
            <tr>
                <td class="w-full lg:w-auto p-2 text-gray-800 text-center border border-b lg:table-cell lg:static text-2xl">{{$provider->cpf}}{{$provider->cnpj}}</td>
                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b lg:table-cell lg:static text-2xl">{{$provider->phone}}</td>
            </tr>
            <tr>
                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 lg:table-cell" colspan="2">Endereço</th>
            </tr>
            <tr>
                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b lg:table-cell lg:static text-2xl" colspan="2">{{$provider->adress}}</td>
            </tr>
        </table>
    </div>
    <div class="flex flex-wrap mx-auto">
        <div class="w-full rounded border shadow mt-3 p-3">
            <h1 class="my-5 mt-3 text-2xl text-center font-bold">Despesas pendentes com o fornecedor: {{$provider->name}}</h1>
            <table class="border-collapse w-full">
                <thead>
                    <tr>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Data de execução</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Descrição</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Valor</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Data de vencimento</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expenditures as $expenditure)
                    <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                        <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Data</span>
                        {{$expenditure->date_expenditure->format('d/m/Y')}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Descrição</span>
                            {{$expenditure->description}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Valor Custeio</span>
                            R$ {{number_format($expenditure->value, 2, ',', '.')}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Data</span>
                            {{$expenditure->expiration->format('d/m/Y')}}
                            </td>
                    </tr>
                    @endforeach
                    @if($expenditures->isEmpty())
                    <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static" colspan="5">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Sem Registro</span>
                        Nâo há despesas pendentes com o fornecedor!
                    </td>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="w-full rounded border shadow mt-3 p-3">
            <h1 class="mb-5 mt-3 text-2xl text-center font-bold">Despesas faturadas com o fornecedor: {{$provider->name}}</h1>
            <table class="border-collapse w-full mt-5">
                <thead>
                    <tr>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Data de execução</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Descrição</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Valor</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Data de pagamento</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expenditures as $expenditure)
                    <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                        <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Data</span>
                        {{$expenditure->date_expenditure->format('d/m/Y')}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Descrição</span>
                            {{$expenditure->description}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Valor Custeio</span>
                            R$ {{number_format($expenditure->value, 2, ',', '.')}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Data Pagamento</span>
                            {{$expenditure->expiration->format('d/m/Y')}}
                            </td>
                    </tr>
                    @endforeach
                    @if($expenditures->isEmpty())
                    <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static" colspan="5">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Sem Registro</span>
                        Nâo há despesas pendentes com o fornecedor!
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
            



