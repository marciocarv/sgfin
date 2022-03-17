@extends('layouts.site')

@section('content')
<div class="w-full px-4 mx-auto md:px-10">
<div class="flex flex-wrap">
<div class="block w-full mt-24">
<a href="{{route('addAccount')}}" class="p-3 mb-5 text-white bg-gray-800 rounded hover:bg-gray-600 hover:font-semibold"><i class="fas fa-plus"></i> Adicionar Conta</a>
<div class="">
  <h1 class="mt-5 text-2xl font-bold text-center"><i class="fas fa-file-invoice-dollar"></i> Contas disponíveis</h1>
</div>
@if (session('msg'))
    <p class="p-4 mt-3 mb-3 font-bold leading-normal text-green-800 bg-green-300 rounded-lg">{{ session('msg') }}</p>
@endif
<div class="w-full mt-5">
  @if(empty($accountsSaldo[0]))
    <p class="text-gray-800">Você ainda não possui contas Cadastradas, favor cadastrar uma conta: <a href="{{route('addAccount')}}" class="font-bold text-green-500 hover:text-green-800">Adicionar Conta</a></p>
  @endif
  <div class="flex flex-wrap">
@foreach($accountsSaldo as $accountSaldo)
    <div class="w-full px-4 mt-5 lg:w-6/12 xl:w-4/12">
      <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white rounded shadow-lg xl:mb-0">
        <div class="flex-auto p-4">
          <div class="flex flex-wrap">
            <div class="relative flex-1 flex-grow w-full max-w-full pr-4">
              <h5 class="text-xs font-bold text-gray-500 uppercase">
                Saldo: <span class="{{$accountSaldo["ballance"] < 0 ? 'text-red-500' : 'text-green-500'}} font-bold">
                        R$ {{number_format($accountSaldo["ballance"], 2, ',', '.')}}
                      </span>
              </h5>
              <span class="text-xs font-semibold text-gray-800 uppercase">
                {{$accountSaldo["account"]->number}} - {{$accountSaldo["account"]->description}}
              </span>
            </div>
            <div class="relative flex-initial w-auto pl-4">
              <div class="inline-flex items-center justify-center w-12 h-12 p-3 text-center text-white bg-blue-500 rounded-full shadow-lg">
                <i class="fas fa-comment-dollar"></i>
              </div>
            </div>
          </div>
          <p class="mt-4 text-xl text-gray-500">
            <span class="mr-2 text-blue-500">
              <i class="fas fa-cog"></i></i>
            </span>
            <span class="whitespace-no-wrap">
            <a href="{{route('manageAcount', ['id'=> $accountSaldo["account"]->id])}}" class="font-semibold hover:text-gray-600 hover:font-bold">Gerenciar</a>
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
            



