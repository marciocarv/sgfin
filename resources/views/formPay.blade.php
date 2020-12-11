@extends('layouts.site')

@section('content')
<div class="px-4 md:px-10 mx-auto w-full">
<div class="flex flex-wrap">
<div class="block w-full mt-24">
  <div class="">
      <h1 class="mb-20 text-2xl font-bold"><i class="fas fa-file-contract"></i> Registrar Pagamento</h1>
  </div>
  <a href="{{route('detailExpenditure', ['id'=>$expenditure->account_id])}}" class="p-3 mb-5 bg-gray-800 text-white rounded  hover:bg-gray-600 hover:font-semibold"><i class="fas fa-undo-alt"></i> Voltar</a> 
  <form id="register-form" class="w-full mt-5 max-w-2xl block" action="{{route($route)}}" method="post" enctype="multipart/form-data">
    @csrf
    @if ($action == 'update')
      <input type="hidden" value="{{$pay->id}}" name="id"/>
    @endif
    <input type="hidden" value="{{$expenditure->id}}" name="id_expenditure"/>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Valor</label>
        <p class="font-bold text-3x1 text-blue-800">R$ {{number_format($expenditure->value, 2, ',', '.')}}</p>
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Data</label
      ><input
        type="date"
        name="date_pay"
        required
        id="date_pay"
        @if ($action == 'update')
        value="{{$pay->date_pay->format('Y-m-d')}}"
        @endif
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
        placeholder=""
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Número da Nota Fiscal</label
      ><input
        type="text"
        name="number_invoice"
        required
        id="number_invoice"
        @if ($action == 'update')
        value="{{$pay->number_invoice}}"
        @endif
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
        placeholder="Número da Agência"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Data de Emissão (Nota Fiscal)</label
      ><input
        type="date"
        name="emission_invoice"
        required
        id="emission_invoice"
        @if ($action == 'update')
        value="{{$pay->emission_invoice->format('Y-m-d')}}"
        @endif
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
        placeholder=""
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Método de Pagamento</label
      ><select name="payment_method" class="px-3 py-3 text-gray-700 rounded text-sm shadow w-full" id="select_provider">
        <option value="">-</option>
        <option value="Dinheiro"
        @if($action == 'update' && $pay->payment_method == 'Dinheiro')
        selected
        @endif
        >Dinheiro</option>
        <option value="Cheque"
        @if($action == 'update' && $provider->person_type == 'Cheque')
        selected
        @endif
        >Cheque</option>
        <option value="Transferência"
        @if($action == 'update' && $pay->payment_method == 'Transferência')
        selected
        @endif
        >Transferência</option>
        <option value="Depósito"
        @if($action == 'update' && $pay->payment_method == 'Depósito')
        selected
        @endif
        >Depósito</option>
        <option value="Cartão"
        @if($action == 'update' && $pay->payment_method == 'Cartão')
        selected
        @endif
        >Cartão</option>
      </select>
    </div>
    <div class="text-center mt-6">
      <button
        class="bg-gray-900 text-white active:bg-gray-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full max-w-xs"
        type="submit"
        id="btn-submit"
        style="transition: all 0.15s ease 0s;"
      >
        Realizar Pagamento
      </button>
    </div>
  </form>
</div>
@endsection
            



