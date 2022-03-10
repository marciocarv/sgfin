@extends('layouts.site')

@section('content')
<div class="w-full px-4 mx-auto md:px-10">
<div class="flex flex-wrap">
<div class="block w-full mt-24">
  <a href="{{route('manageContract', ['id'=>$contract->id])}}" class="p-3 mb-5 text-white bg-gray-800 rounded hover:bg-gray-600 hover:font-semibold"><i class="fas fa-undo-alt"></i> Voltar</a>
  <div class="">
    <h1 class="mt-10 text-2xl font-bold"><i class="fas fa-file-contract"></i> Gerar Despesa</h1>
  </div>
    <form id="register-form" class="block w-full max-w-2xl mt-5" action="{{route('gerExpenditureByOrderPost')}}" method="post">
        @csrf
        <input type="hidden" value="{{$contract->id}}" name="contract_id"/>
        <input type="hidden" value="{{$contract->provider_id}}" name="provider_id"/>
        <input type="hidden" value="{{$contract->nature}}" name="nature" />
        @foreach($id_orders as $id_order)
        <input type="hidden" value="{{$id_order}}" name="id_orders[]" />
        @endforeach
        <div class="relative w-full mb-3">
            <label
                class="block mb-2 text-xs font-bold text-gray-700 uppercase"
                for="grid-password"
                >Fornecedor</label
            >
            <label
                class="block mb-2 text-sm font-bold text-teal-900 uppercase"
                for="grid-password"
                >{{$contract->provider->name}}</label
            >
        </div>
        <div class="relative w-full mb-3">
            <label
              class="block mb-2 text-xs font-bold text-gray-700 uppercase"
              for="grid-password"
              >Conta</label>
            <select name="account_id" class="w-full px-3 py-3 text-sm text-gray-700 shadow focus:outline-none focus:shadow-outline">
              <option value="" class="text-sm text-gray-700" style="transition: all 0.15s ease 0s;">Selecione a conta</option>
              @foreach($accounts as $account)
              <option value="{{$account->id}}" class="text-sm text-gray-700"
              style="transition: all 0.15s ease 0s;">{{$account->number}} - {{$account->description}}</option>
              @endforeach
            </select>
          </div>
        <div class="relative w-full mb-3">
            <label
                class="block mb-2 text-xs font-bold text-gray-700 uppercase"
                for="grid-password"
                >Data de Emissão
                @error('date_expenditure')
                    <p class="text-red-600">{{$message}}</p>
                @enderror
                </label
            ><input
                type="date"
                name="date_expenditure"
                required
                id="date_expenditure"
                class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('date_expenditure') border-2 border-pink-600 @enderror"
                placeholder="Data de recebimento do recurso"
                style="transition: all 0.15s ease 0s;"
            />
        </div>
        <div class="relative w-full mb-3">
          <label
              class="block mb-2 text-xs font-bold text-gray-700 uppercase"
              for="grid-password"
              >Descrição
              @error('description')
                  <p class="text-red-600">{{$message}}</p>
              @enderror
              </label
          ><input
              type="text"
              name="description"
              required
              id="description"
              class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('description') border-2 border-pink-600 @enderror"
              placeholder="Descreva em que o recurso foi utilizado"
              style="transition: all 0.15s ease 0s;"
          />
        </div>
        <div class="relative w-full mb-3">
        <label
            class="block mb-2 text-xs font-bold text-gray-700 uppercase"
            for="grid-password"
            >Valor
            @error('value')
                <p class="text-red-600">{{$message}}</p>
            @enderror
            </label
        ><input
            type="text"
            name="value"
            required
            id="value"
            value="{{number_format($amount, '2', ',', '.')}}"
            class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('value') border-2 border-pink-600 @enderror"
            placeholder="Valor da despesa"
            style="transition: all 0.15s ease 0s;"
        />
        </div>
        <div class="relative w-full mb-3">
          <label
            class="block mb-2 text-xs font-bold text-gray-700 uppercase"
            for="grid-password"
            >Natureza
          </label>
          <label
            class="block mb-2 text-sm font-bold text-teal-900 uppercase"
            for="grid-password"
            >{{$contract->nature}}</label>
        </div>
        <div class="relative w-full mb-3">
        <label
            class="block mb-2 text-xs font-bold text-gray-700 uppercase"
            for="grid-password"
            >Data de Vencimento
            @error('expiration')
                <p class="text-red-600">{{$message}}</p>
            @enderror
            </label
        ><input
            type="date"
            name="expiration"
            required
            id="expiration"
            class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('expiration') border-2 border-pink-600 @enderror"
            placeholder="Data de vencimento do recurso"
            style="transition: all 0.15s ease 0s;"
        />
        </div>
    <div class="mt-6 text-center">
      <button
        class="w-full max-w-xs px-6 py-3 mb-1 mr-1 text-sm font-bold text-white uppercase bg-gray-900 rounded shadow outline-none active:bg-gray-700 hover:shadow-lg focus:outline-none"
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


