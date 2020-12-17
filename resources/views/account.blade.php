@extends('layouts.site')

@section('content')
<div class="px-4 md:px-10 mx-auto w-full">
<div class="flex flex-wrap">
<div class="block w-full mt-24">
<a href="{{route('addAccount')}}" class="p-3 mb-5 bg-gray-800 text-white rounded  hover:bg-gray-600 hover:font-semibold"><i class="fas fa-plus"></i> Adicionar Conta</a>
<div class="">
  <h1 class="mt-5 text-2xl text-center font-bold"><i class="fas fa-file-invoice-dollar"></i> Contas disponíveis</h1>
</div>
@if (session('msg'))
    <p class="bg-green-300 p-4 font-bold leading-normal mb-3 mt-3 rounded-lg text-green-800">{{ session('msg') }}</p>
@endif
<div class="w-full mt-5">
  @if(empty($accountsSaldo[0]))
    <p class="text-gray-800">Você ainda não possui contas Cadastradas, favor cadastrar uma conta: <a href="{{route('addAccount')}}" class="text-green-500 hover:text-green-800 font-bold">Adicionar Conta</a></p>
  @endif
  <div class="flex flex-wrap">
@foreach($accountsSaldo as $accountSaldo)
    <div class="w-full lg:w-6/12 xl:w-3/12 px-4 mt-5">
      <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
        <div class="flex-auto p-4">
          <div class="flex flex-wrap">
            <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
              <h5 class="text-gray-500 uppercase font-bold text-xs">
                Saldo: <span class="{{$accountSaldo["ballance"] < 0 ? 'text-red-500' : 'text-green-500'}} font-bold">
                        R$ {{number_format($accountSaldo["ballance"], 2, ',', '.')}}
                      </span>
              </h5>
              <span class="font-semibold uppercase text-xl text-gray-800">
                {{$accountSaldo["account"]->number}} - {{$accountSaldo["account"]->description}}
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
            <a href="{{route('manageAcount', ['id'=> $accountSaldo["account"]->id])}}" class="font-semibold  hover:text-gray-600 hover:font-bold">Gerenciar</a>
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
            



