@extends('layouts.site')

@section('content')
<div class="px-4 md:px-10 mx-auto w-full">
<div class="flex flex-wrap">
<div class="block w-full mt-24">
  <a href="{{route('addOrdinance')}}" class="p-3 mb-5 bg-gray-800 text-white rounded hover:bg-gray-700"><i class="fas fa-plus"></i> Adicionar Portaria</a>
<div class="">
    <h1 class="mt-5 text-2xl text-center font-bold"><i class="fas fa-file-contract"></i> Relação Portarias</h1>
</div>

@if (session('msg'))
    <p class="bg-green-300 p-4 font-bold leading-normal mb-3 mt-3 rounded-lg text-green-800">{{ session('msg') }}</p>
@endif
<div class="rounded border shadow py-5 my-5">
  <table class="border-collapse w-full mt-5">
    <thead>
        <tr>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Nº</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Data</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Número</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Descrição</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Valor Custeio</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Valor Capital</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Valor Total</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Ações</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Detalhar</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($ordinances as $ordinance)
        <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
          <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Nº</span>
            {{$loop->index + 1}}
        </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
              <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Data</span>
              {{$ordinance->date_ordinance->format('d/m/Y')}}
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Número</span>
                {{$ordinance->number}}
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Descrição</span>
                {{$ordinance->description}}
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
              <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Valor</span>
              R$ {{number_format($ordinance->value_custeio, 2, ',', '.')}}
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
              <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Valor</span>
              R$ {{number_format($ordinance->value_capital, 2, ',', '.')}}
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
              <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Valor</span>
              R$ {{number_format($ordinance->amount, 2, ',', '.')}}
            </td>
          <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Ações</span>
            <a href="{{route('delOrdinance', ['id'=> $ordinance->id])}}" class="text-red-600 hover:text-red-400 underline mr-3" alt="Excluir"><i class="fas fa-trash-alt"></i></a>
            <a href="{{route('upOrdinance', ['id'=> $ordinance->id])}}" class="text-gray-600 hover:text-gray-400 underline ml-3" alt="Editar"><i class="fas fa-edit"></i></a>
        </td>
        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-cente block lg:table-cell relative lg:static">
          <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Detalhar</span>
          <a href="{{route('detailOrdinance', ['id'=> $ordinance->id])}}" class="text-gray-600 hover:text-gray-400 underline"><i class="fas fa-eye"></i></a>
        </td>
        </tr>
        @endforeach
        @if($ordinances->isEmpty())
          <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static" colspan="9">
            Nâo há portarias registradas, favor adicione uma nova portaria <a href="{{route('addOrdinance')}}" class="text-green-500">Adicionar Portaria</a>
          </td>
        @endif
    </tbody>
</table>
<span>{{$ordinances->links()}}</span>
</div>
</div>
@endsection
            



