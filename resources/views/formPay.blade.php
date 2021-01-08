@extends('layouts.site')

@section('content')
<div class="px-4 md:px-10 mx-auto w-full">
<div class="flex flex-wrap">
<div class="block w-full mt-24">
  <div class="">
      <h1 class="mb-20 text-2xl font-bold"><i class="fas fa-file-contract"></i> Registrar Pagamento</h1>
  </div>
  <a href="{{route('detailExpenditure', ['id'=>$expenditure->id])}}" class="p-3 mb-5 bg-gray-800 text-white rounded  hover:bg-gray-600 hover:font-semibold"><i class="fas fa-undo-alt"></i> Voltar</a> 
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
        >Vencimento</label>
        <p class="font-bold text-3x1 text-blue-800" id="expiration">{{$expenditure->expiration->format('d/m/Y')}}</p>
        <p class="hidden" id="msg-expiration">Pagamento realizado após o vencimento, informe o valor de eventuais juros/multas</p>
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
    <div class="relative w-full mb-3 hidden" id="form_interest">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Juros / Multa</label
      ><input
        type="text"
        name="interest"
        required
        id="interest"
        @if ($action == 'update')
        value="{{$pay->interest}}"
        @else
        value="0.00"
        @endif
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
        placeholder="valor de Juros ou multas referente ao pagamento"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Número da Nota Fiscal / Boleto</label
      ><input
        type="text"
        name="number_invoice"
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
        >Data de Emissão (Nota Fiscal / Boleto)</label
      ><input
        type="date"
        name="emission_invoice"
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
        <option value="Cheque"
        @if($action == 'update' && $pay->payment_method == 'Cheque')
        selected
        @endif
        >Cheque</option>
        <option value="Transferência"
        @if($action == 'update' && $provider->person_type == 'Transferência')
        selected
        @endif
        >Transferência Bancária</option>
        <option value="Boleto"
        @if($action == 'update' && $pay->payment_method == 'Boleto')
        selected
        @endif
        >Boleto</option>
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

@section('script')
<script src="{{asset('js/vanilla-masker.min.js')}}" charset="utf-8"></script>
<script charset="utf-8" type="text/javascript">
  VMasker(document.querySelector("#interest")).maskMoney();

  var elemento = document.querySelector('#date_pay');
  var formInterest = document.querySelector('#form_interest');
  var msg_expiration = document.querySelector('#msg-expiration');
  var expiration = document.querySelector('#expiration');

  elemento.addEventListener('blur', ()=>{
    var dataString = elemento.value;
    var arrayData = dataString.split("-");
    var dataFormatada = `${arrayData[1]}/${arrayData[2]}/${arrayData[0]}`;
    var data_pagamento = new Date(dataFormatada);
    var vencimento = new Date("{{$expenditure->expiration->format('m/d/Y')}}");

    if(data_pagamento > vencimento){
      formInterest.removeAttribute('class', 'hidden');
      msg_expiration.removeAttribute('class', 'hidden');
      msg_expiration.setAttribute('class', 'bg-red-300 text-red-900 font-bold p-2 rounded');
      expiration.setAttribute('class', 'font-bold text-3x1 text-red-800');
    }else{
      msg_expiration.setAttribute('class', 'hidden');
      formInterest.setAttribute('class', 'hidden');
      expiration.setAttribute('class', 'font-bold text-3x1 text-blue-800');
    }

  });

</script>

@endsection
