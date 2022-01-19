@extends('layouts.site')

@section('content')
<div class="px-4 md:px-10 mx-auto w-full">
<div class="flex flex-wrap">
<div class="block w-full mt-24">
  <a href="{{route('expenditure', ['id'=>$account->id])}}" class="p-3 mb-5 bg-gray-800 text-white rounded  hover:bg-gray-600 hover:font-semibold"><i class="fas fa-undo-alt"></i> Voltar</a>
  <div class="">
    <h1 class="mt-10 text-2xl font-bold"><i class="fas fa-file-contract"></i> Cadastre sua Despesa - {{$account->description}}</h1>
  </div>
  @if (session('msg'))
    <p class="bg-green-300 p-4 font-bold leading-normal mb-3 rounded-lg text-green-800">{{ session('msg') }}</p>
  @endif
  
  <form id="register-form" class="w-full mt-5 max-w-2xl block" action="{{route($route)}}" method="post" enctype="multipart/form-data">
    @csrf
    @if ($action == 'update')
      <input type="hidden" value="{{$expenditure->id}}" name="id"/>
    @endif
      <input type="hidden" value="{{$account->id}}" name="account_id"/>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Fornecedor</label
      >
      <select name="provider_id" class="px-3 py-3 shadow focus:outline-none focus:shadow-outline w-full text-gray-700 text-sm">
        <option value="" class="text-gray-700 text-sm" style="transition: all 0.15s ease 0s;">Selecione o fornecedor</option>
        @foreach($options as $option)
        <option value="{{$option->id}}" class="text-gray-700 text-sm"
          @if ($action == 'update')
            @if($option->id === $expenditure->provider_id)
              selected
            @endif
          @endif
        style="transition: all 0.15s ease 0s;">{{$option->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
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
        @if ($action == 'update')
        value="{{$expenditure->date_expenditure->format('Y-m-d')}}"
        @endif
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('date_expenditure') border-2 border-pink-600 @enderror"
        placeholder="Data de recebimento do recurso"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
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
        @if ($action == 'update')
          value="{{$expenditure->description}}"
        @endif
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('description') border-2 border-pink-600 @enderror"
        placeholder="Descreva em que o recurso foi utilizado"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
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
        @if ($action == 'update')
          value="{{$expenditure->value}}"
        @endif
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('value') border-2 border-pink-600 @enderror"
        placeholder="Valor da despesa"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Natureza
          @error('nature')
            <p class="text-red-600">{{$message}}</p>
          @enderror
        </label
      >
      <select name="nature" class="px-3 py-3 shadow focus:outline-none focus:shadow-outline w-full text-gray-700 text-sm @error('nature') border-2 border-pink-600 @enderror">
        <option value="Custeio" class="text-gray-700 text-sm"
        @if ($action == 'update')
          @if ($expenditure->nature === 'Custeio')
          selected
          @endif
        @endif
        style="transition: all 0.15s ease 0s;">Custeio</option>
        <option value="Capital" class="text-gray-700 text-sm"
        @if ($action == 'update')
          @if ($expenditure->nature === 'Capital')
          selected
          @endif
        @endif
        style="transition: all 0.15s ease 0s;">Capital</option>
      </select>
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
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
        @if ($action == 'update')
        value="{{$expenditure->expiration->format('Y-m-d')}}"
        @endif
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('expiration') border-2 border-pink-600 @enderror"
        placeholder="Data de vencimento da despesa"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Despesa Fixa?</label
      >
      <select name="fixed" id="fixed" class="px-3 py-3 shadow focus:outline-none focus:shadow-outline w-full text-gray-700 text-sm">
        <option value="false" class="text-gray-700 text-sm"
        @if ($action == 'update')
          @if ($expenditure->fixed === 0)
          selected
          @endif
        @endif
        style="transition: all 0.15s ease 0s;">Não</option>
        <option value="true" class="text-gray-700 text-sm"
        @if ($action == 'update')
          @if ($expenditure->fixed === 1)
          selected
          @endif
        @endif
        style="transition: all 0.15s ease 0s;">Sim</option>
      </select>
      <p id="msg-fixed" style="transition: all 0.15s ease 0s;">Esta despesa será incluída automaticamente em todos os meses 
        subsequentes, na data de emissão informada, você precisará apenas informar o valor da despesa.</p>
    </div>
    <div class="text-center mt-6">
      <button
        class="bg-gray-900 text-white active:bg-gray-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full max-w-xs"
        type="submit"
        id="btn-submit"
        style="transition: all 0.15s ease 0s;"
      >
        Salvar
      </button>
    </div>
  </form>
</div>
@endsection
            
@section('script')

<script src="{{asset('js/vanilla-masker.min.js')}}" charset="utf-8"></script>
<script charset="utf-8" type="text/javascript">
  VMasker(document.querySelector("#value")).maskMoney();

  var select = document.querySelector('#fixed');
  if(select.options[select.selectedIndex].value === 'true'){
    document.querySelector('#msg-fixed').removeAttribute('class', 'hidden');
  }else{
    document.querySelector('#msg-fixed').setAttribute('class', 'hidden');
  }
  select.addEventListener('change', ()=>{
    if(select.options[select.selectedIndex].value === 'true'){
      document.querySelector('#msg-fixed').removeAttribute('class', 'hidden');
      document.querySelector('#msg-fixed').setAttribute('class', 'text-green-600 mt-2 bg-blue-100 p-3 text-bold');
    }else{
      document.querySelector('#msg-fixed').setAttribute('class', 'hidden');
    }            
  });
</script>

@endsection


