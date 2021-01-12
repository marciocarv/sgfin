@extends('layouts.site')

@section('content')
<div class="px-4 md:px-10 mx-auto w-full">
<div class="flex flex-wrap">
<div class="block w-full mt-24">
  <a href="{{route('fixedExpenditure', ['id'=>$fe->id])}}" class="p-3 mb-5 bg-gray-800 text-white rounded  hover:bg-gray-600 hover:font-semibold"><i class="fas fa-undo-alt"></i> Voltar</a>
  <div class="">
    <h1 class="mt-10 text-2xl font-bold"><i class="fas fa-file-contract"></i> Gere sua Despesa fixa - {{$account->description}}</h1>
  </div>
    <form id="register-form" class="w-full mt-5 max-w-2xl block" action="{{route('gerExpenditurePost')}}" method="post">
    @csrf
    <input type="hidden" value="{{$account->id}}" name="account_id"/>
    <input type="hidden" value="{{$fe->provider_id}}" name="provider_id"/>
    <input type="hidden" value="0" name="fixed"/>
    <input type="hidden" value="{{$fe->nature}}" name="nature"/>
    <input type="hidden" value="{{$fe->id}}" name="fe"/>
    <input type="hidden" value="{{$fe->reference_month}}" name="ref_month"/>

    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Fornecedor</label
      >
      <label
        class="block uppercase text-teal-900 text-sm font-bold mb-2"
        for="grid-password"
        >{{$provider->name}}</label
      >
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Data de Emissão</label
      ><input
        type="date"
        name="date_expenditure"
        required
        id="date_expenditure"
        value="{{$fe->emission_date->format('Y-m-d')}}"
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
        placeholder="Data de recebimento do recurso"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Descrição</label
      ><input
        type="text"
        name="description"
        required
        id="description"
        value="{{$fe->description}}"
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
        placeholder="Descreva em que o recurso foi utilizado"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Valor</label
      ><input
        type="text"
        name="value"
        required
        id="value"
        value="{{$fe->value}}"
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
        placeholder="Valor da despesa"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Natureza</label
      >
      <label
      class="block uppercase  text-teal-900 text-sm font-bold mb-2"
      for="grid-password"
      >{{$fe->nature}}</label
      >
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Data de Vencimento</label
      ><input
        type="date"
        name="expiration"
        required
        id="expiration"
        value="{{$fe->expiration_date->format('Y-m-d')}}"
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
        placeholder="Data de recebimento do recurso"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="text-center mt-6">
      <button
        class="bg-gray-900 text-white active:bg-gray-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full max-w-xs"
        type="submit"
        id="btn-submit"
        style="transition: all 0.15s ease 0s;"
      >
        Gerar
      </button>
    </div>
  </form>
</div>
@endsection
            
@section('script')

<script src="{{asset('js/vanilla-masker.min.js')}}" charset="utf-8"></script>
<script charset="utf-8" type="text/javascript">
  VMasker(document.querySelector("#value")).maskMoney();
</script>

@endsection


