@extends('layouts.site')

@section('content')
<div class="px-4 md:px-10 mx-auto w-full">
<div class="flex flex-wrap">
<div class="block w-full mt-24">
<a href="{{route('addContract')}}" class="p-3 mb-5 bg-gray-800 text-white rounded  hover:bg-gray-600 hover:font-semibold"><i class="fas fa-plus"></i> Adicionar Contrato</a>
<div class="">
  <h1 class="mt-5 text-2xl text-center font-bold"><i class="fas fa-fax"></i> Contratos</h1>
</div>
@if (session('msg'))
    <p class="bg-green-300 p-4 font-bold leading-normal mb-3 mt-3 rounded-lg text-green-800">{{ session('msg') }}</p>
@endif
<div>
  <form action="" method="GET" class="flex flex-wrap justify-center mt-5">
      <div class="lg:w-auto">
        <label class="font-semibold m-2">Ano:</label>
        <input type="number" name="year" value="{{$year}}" class="px-3 py-2 m-1 text-gray-700 rounded text-sm shadow focus:outline-none focus:shadow-outline" />
      </div>
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
<div class="w-full mt-5">
  @if($contracts->isEmpty())
    <p class="text-gray-800">Você ainda não possui Contratos cadastrados nesse período</p>
  @endif
  <div class="flex flex-wrap">
@foreach($contracts as $contract)
    <div class="w-full lg:w-6/12 xl:w-3/12 px-4 mt-5">
      <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
        <div class="flex-auto p-4">
          <div class="flex flex-wrap">
            <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
              <h5 class="text-gray-500 uppercase font-bold text-xs">
                <span class="font-bold">
                  Processo: {{$contract->num_contrato}}
                </span>
              </h5>
              <span class="font-semibold uppercase text-base text-gray-800">
                {{$contract->description}} <br /> {{$contract->provider->name}}
              </span>
            </div>
            <div class="relative w-auto pl-4 flex-initial">
              <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-blue-500">
                <i class="fas fa-comment-dollar"></i>
              </div>
            </div>
          </div>
          <p class="text-xl text-gray-500 mt-4">
            <span class="text-blue-500 mr-2">
              <i class="fas fa-cog"></i></i>
            </span>
            <span class="whitespace-no-wrap">
            <a href="{{route('manageContract', ['id'=>$contract->id])}}" class="font-semibold  hover:text-gray-600 hover:font-bold">Gerenciar</a>
            </span>
          </p>
        </div>
      </div>
    </div>
@endforeach
</div>
</div>
</div>
@endsection
            



