@extends('layouts.site')

@section('content')
<div class="px-4 md:px-10 mx-auto w-full">
<div class="flex flex-wrap">
<div class="block w-full mt-24">
  <a href="{{route('addIncome', ['id'=>$account->id])}}" class="p-3 mb-5 bg-gray-800 text-white rounded hover:bg-gray-600"><i class="fas fa-plus"></i> Adicionar Receitas</a>
<div class="">
  <h1 class="mt-5 text-2xl text-center font-bold">
    <i class="fas fa-file-contract"></i> Receitas - {{$account->description}}
    <a href="{{route('chooseAccount', ['movimento'=>'in'])}}" class="text-sm text-blue-500 hover:text-blue-700"><i class="fas fa-sync-alt"></i> Alterar Conta</a>
  </h1>
</div>
@if (session('msg'))
    <p class="bg-green-300 p-4 font-bold leading-normal mb-3 mt-3 rounded-lg text-green-800">{{ session('msg') }}</p>
@endif
<div class="mt-4">
  <form action="{{route('income', ['id'=>$account->id])}}" method="GET" class="flex flex-wrap justify-center">
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
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Data</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Descrição</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Portaria</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Valor Total</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Custeio</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Capital</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Ações</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($incomes as $income)
        <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
            <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
              <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Data</span>
              {{$income->date_income->format('d/m/Y')}}
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
              <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Descrição</span>
              {{$income->description}}
          </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 border border-b block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Portaria</span>
                {{$income->number}} - {{$income->orddescription}}
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
              <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Valor Total</span>
              <span class="text-green-500 font-bold">R$ {{number_format($income->amount, 2, ',', '.')}}</span>
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
              <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Custeio</span>
              <span class="text-blue-600 font-semibold">R$ {{number_format($income->value_custeio, 2, ',', '.')}}</span>
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
              <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Capital</span>
              <span class="text-yellow-500 font-semibold">R$ {{number_format($income->value_capital, 2, ',', '.')}}</span>
            </td>
          <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Ações</span>
            <a href="{{route('delIncome', ['id'=> $income->id])}}" class="text-red-600 hover:text-red-400 underline mr-3" alt="Excluir"><i class="fas fa-trash-alt"></i></a>
            <a href="{{route('upIncome', ['id'=> $income->id])}}" class="text-gray-600 hover:text-gray-400 underline ml-3" alt="Editar"><i class="fas fa-edit"></i></a>
          </td>
        </tr>
        @endforeach
        @if($incomes->isEmpty())
          <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static" colspan="7">
            Nâo há receitas registradas, favor adicione uma nova receita <a href="{{route('addIncome', ['id'=>$account->id])}}" class="text-green-500 hover:text-green-600">Registrar Receita</a>
          </td>
        @endif
    </tbody>
</table>
<span>{{$incomes->links()}}</span>
</div>
</div>
@endsection
            



