@extends('layouts.site')

@section('content')
<div class="px-4 md:px-10 mx-auto w-full">
<div class="flex flex-wrap">
<div class="block w-full mt-24">
  <div class="flex justify-between flex-wrap">
    <a href="{{route('expenditure', ['id'=>$account->id])}}" class="p-3 mb-5 bg-gray-800 text-white rounded hover:bg-gray-600"><i class="fas fa-undo-alt"></i> Voltar</a>
  </div>
<div class="">
  <h1 class="mt-5 text-2xl text-center font-bold">
    <i class="fas fa-file-contract"></i> Despesas Fixas
  </h1>
</div>
@if (session('msg'))
    <p class="bg-green-300 p-4 font-bold leading-normal mb-3 mt-3 rounded-lg text-green-800">{{ session('msg') }}</p>
@endif
<div>
  <table class="border-collapse w-full mt-5">
    <thead>
        <tr>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Nº</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Emissão</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Descrição</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Valor</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Natureza</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Vencimento</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Ações</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell"></th>
        </tr>
        </tr>
    </thead>
    <tbody>
      @foreach ($fixedExpenditures as $fixedExpenditure)
        <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
            <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
              <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Nº</span>
              {{$loop->index + 1}}
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
              <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Emissão</span>
              {{$fixedExpenditure->emission_date->format('d/m/Y')}}
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
              <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Descrição</span>
              {{$fixedExpenditure->description}}
          </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Valor</span>
                <span class="text-red-500 font-bold">R$ {{number_format($fixedExpenditure->value, 2, ',', '.')}}</span>
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
              <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Natureza</span>
              {{$fixedExpenditure->nature}}
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
              <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Vencimento</span>
              {{$fixedExpenditure->expiration_date->format('d/m/Y')}}
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
              <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Ações</span>
              <a href="{{route('delFixedExpenditure', ['id'=> $fixedExpenditure->id])}}" class="text-red-600 hover:text-red-400 underline mr-3" alt="Excluir"><i class="fas fa-trash-alt"></i></a>
              <a href="{{route('upFixedExpenditure', ['id'=> $fixedExpenditure->id])}}" class="text-gray-600 hover:text-gray-400 underline ml-3" alt="Editar"><i class="fas fa-edit"></i></a>
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
              <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase"></span>
              <a href="{{route('gerExpenditure', ['id'=> $fixedExpenditure->id])}}" class="text-teal-900 hover:text-gray-400 font-bold underline ml-3" alt="Editar">Gerar Despesa</a>
            </td>
          </tr>
        @endforeach
        @if($fixedExpenditures->isEmpty())
          <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static" colspan="8">
            Nâo há Despesas fixas registradas, ao criar uma nova despesa, você deve marcar como despesa fixa e automáticamente será salva!
          </td>
        @endif
    </tbody>
</table>
<span>{{$fixedExpenditures->links()}}</span>
</div>
</div>
@endsection
            



