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
@if (session('msg'))
    <p class="bg-green-300 p-4 font-bold leading-normal mb-3 mt-3 rounded-lg text-green-800">{{ session('msg') }}</p>
@endif
<div class="w-full mt-5">
  <div class="flex flex-wrap">

    <div class="w-full xl:w-6/12 px-4 mt-5">
      <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
        <p class="font-bold text-center text-2xl text-gra-600">Recursos recebidos</p>
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
                  <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                  <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Data</span>
                  {{$income->date_income->format('d/m/Y')}}
                  </td>
                  <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                      <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Descrição</span>
                      {{$income->description}}
                  </td>
                  <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                      <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Valor</span>
                      {{$income->amount}}
                  </td>
              </tr>
              @endforeach
              @if($incomes->isEmpty())
              <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static" colspan="5">
                  <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Valor Total</span>
                  Nâo há Receitas! <a href="" class="text-green-500 hover:text-green-800 font-semibold">Cadastrar Receita</a>
              </td>
              @endif
          </tbody>
      </table>
      </div>
    </div>
    <div class="w-full xl:w-6/12 px-4 mt-5">
      <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
        <p class="font-bold text-center text-2xl text-gra-600">Despesas</p>
        <table class="border-collapse w-full mt-5">
          <thead>
              <tr>
                  <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Vencimento</th>
                  <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Descrição</th>
                  <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Valor</th>
              </tr>
          </thead>
          <tbody>
              @foreach($expenditures as $expenditure)
              <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                  <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                  <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Vencimento</span>
                  {{$expenditure->expiration->format('d/m/Y')}}
                  </td>
                  <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                      <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Descrição</span>
                      {{$expenditure->description}}
                  </td>
                  <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                      <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Valor</span>
                      {{$expenditure->value}}
                  </td>
              </tr>
              @endforeach
              @if($expenditures->isEmpty())
              <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static" colspan="5">
                  <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Valor Total</span>
                  Nâo há Despesas! <a href="" class="text-green-500 hover:text-green-800 font-semibold">Cadastrar Despesa</a>
              </td>
              @endif
          </tbody>
      </table>
      </div>
    </div>

</div>
</div>
</div>
@endsection
            



