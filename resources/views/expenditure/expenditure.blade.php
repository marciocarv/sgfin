@extends('layouts.site')

@section('content')
<div class="px-4 md:px-10 mx-auto w-full">
<div class="flex flex-wrap">
<div class="block w-full mt-24">
  <div class="flex justify-between flex-wrap">
    <a href="{{route('addExpenditure', ['id'=>$account->id])}}" class="p-3 mb-5 bg-gray-800 text-white rounded hover:bg-gray-600"><i class="fas fa-plus"></i> Registrar Despesas</a>
    <a href="{{route('fixedExpenditure', ['id'=>$account->id])}}" class="p-3 mb-5 bg-pink-900 text-white rounded hover:bg-gray-600"><i class="fas fa-thumbtack"></i> Despesas Fixas</a>
  </div>
<div class="">
  <h1 class="mt-5 text-2xl text-center font-bold">
    <i class="fas fa-file-contract"></i> Despesas - {{$account->description}}
    <a href="{{route('chooseAccount', ['movimento'=>'out'])}}" class="text-sm text-blue-500 hover:text-blue-700"><i class="fas fa-sync-alt"></i> Alterar Conta</a>
  </h1>
</div>
@if (session('msg'))
    <p class="bg-green-300 p-4 font-bold leading-normal mb-3 mt-3 rounded-lg text-green-800">{{ session('msg') }}</p>
@endif
<div class="mt-4">
  <form action="{{route('expenditure', ['id'=>$account->id])}}" method="GET" class="flex flex-wrap justify-center">
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
<div>
  <table class="border-collapse w-full mt-5">
    <thead>
        <tr>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Emissão</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Descrição</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Valor</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Natureza</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Vencimento</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Situação</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Ações</th>
        </tr>
        </tr>
    </thead>
    <tbody>
      @foreach ($expenditures as $expenditure)
        <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
            <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
              <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Emissão</span>
              {{$expenditure->date_expenditure->format('d/m/Y')}}
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
              <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Descrição</span>
              {{$expenditure->description}}
          </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Valor</span>
                <span class="text-red-500 font-bold">R$ {{number_format($expenditure->value, 2, ',', '.')}}</span>
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
              <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Natureza</span>
              {{$expenditure->nature}}
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
              <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Vencimento</span>
              {{$expenditure->expiration->format('d/m/Y')}}
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
              <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Situação</span>
              @if($expenditure->pay_id)
              <i class="far fa-check-circle text-green-400"></i> <a href="#" class="text-green-700 hover:text-green-600 font-bold">Paga {{date('d/m/Y', strtotime($expenditure->date_pay))}}</a>
              @else
              <i class="fas fa-exclamation text-orange-400"></i> Pendente
              @endif
            </td>
          <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Ações</span>
            @if(!$expenditure->pay_id)
            <a href="{{route('delExpenditure', ['id'=> $expenditure->id])}}" class="text-red-600 hover:text-red-400 underline mx-2" title="Excluir"><i class="fas fa-trash-alt"></i></a>
            <a href="{{route('upExpenditure', ['id'=> $expenditure->id])}}" class="text-gray-600 hover:text-gray-400 underline mx-2" title="Editar"><i class="fas fa-edit"></i></a>
            <a href="{{route('payExpenditure', ['id'=>$expenditure->id])}}" class="text-green-600 hover:text-green-400 underline mx-2" title="pagar"><i class="fas fa-comment-dollar"></i></a>
            @endif
            <a href="{{route('detailExpenditure', ['id'=> $expenditure->id])}}" class="text-gray-600 hover:text-gray-400 underline mx-2" title="detalhar"><i class="fas fa-eye"></i></a>
          </td>
        </tr>
        @endforeach
        @if($expenditures->isEmpty())
          <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static" colspan="8">
            Nâo há Despesas registradas, favor adicione uma nova despesa <a href="{{route('addIncome', ['id'=>$account->id])}}" class="text-green-500 hover:text-green-600">Registrar Despesa</a>
          </td>
        @endif
    </tbody>
</table>
<span>{{$expenditures->links()}}</span>
</div>
</div>
@endsection
            



