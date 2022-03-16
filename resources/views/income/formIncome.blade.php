@extends('layouts.site')

@section('content')
<div class="w-full px-4 mx-auto md:px-10">
<div class="flex flex-wrap">
<div class="block w-full mt-24">
  <a href="{{route('income', ['id'=>$account->id])}}" class="p-3 mb-5 text-white bg-gray-800 rounded hover:bg-gray-600 hover:font-semibold"><i class="fas fa-undo-alt"></i> Voltar</a>
  <div class="">
    <h1 class="mt-5 text-2xl font-bold"><i class="fas fa-file-contract"></i> @if($action == 'update') Edite sua Receita - {{$account->description}} @else Cadastre sua Receita - {{$account->description}} @endif</h1>
  </div>
  @if ($options->count() === 2)
    <p class="p-4 mb-3 font-bold leading-normal text-green-800 bg-green-300 rounded-lg">
      Você não possui Portarias Cadastradas, se o Recurso veio através de uma portaria, <a href="{{route('addOrdinance')}}" class="text-red-600 hover:text-red-400">cadastre aqui</a>
    </p>
  @endif
  @if (session('msg'))
    <p class="p-4 mb-3 font-bold leading-normal text-green-800 bg-green-300 rounded-lg">{{ session('msg') }}</p>
  @endif
  
  <form id="register-form" class="block w-full max-w-2xl p-3 mt-5 border rounded shadow" action="{{route($route)}}" method="post" enctype="multipart/form-data">
    @csrf
    @if ($action == 'update')
      <input type="hidden" value="{{$income->id}}" name="id"/>
    @endif
      <input type="hidden" value="{{$account->id}}" name="account_id"/>
    <div class="relative w-full mb-3">
      <label
        class="block mb-2 text-xs font-bold text-gray-700 uppercase"
        for="grid-password"
        >Portaria</label
      >
      <select name="ordinance_id" class="w-full px-3 py-3 text-sm text-gray-700 shadow focus:outline-none focus:shadow-outline">
        <option value=" " class="text-sm text-gray-700" style="transition: all 0.15s ease 0s;">Selecione a portaria</option>
        @foreach($options as $option)
        <option value="{{$option->id}}" class="text-sm text-gray-700"
          @if ($action == 'update')
            @if($option->id === $income->ordinance_id)
              selected
            @endif
          @endif
        style="transition: all 0.15s ease 0s;">{{$option->number}} - {{$option->description}}</option>
        @endforeach
      </select>
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block mb-2 text-xs font-bold text-gray-700 uppercase"
        for="grid-password"
        >Data
          @error('date_income')
            <p class="text-red-600">{{$message}}</p>
          @enderror
        </label
      ><input
        type="date"
        name="date_income"
        required
        id="date_income"
        @if ($action == 'update')
          value="{{$income->date_income->format('Y-m-d')}}"
        @else
          value="{{old('date_income')}}"
        @endif
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('date_income') border-2 border-pink-600 @enderror"
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
        @if ($action == 'update')
          value="{{$income->description}}"
        @endif
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('description') border-2 border-pink-600 @enderror"
        placeholder="Descreva a que se destina o recurso"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block mb-2 text-xs font-bold text-gray-700 uppercase"
        for="grid-password"
        >Valor Capital
          @error('value_capital')
            <p class="text-red-600">{{$message}}</p>
          @enderror
        </label
      ><input
        type="text"
        name="value_capital"
        required
        id="value_capital"
        @if ($action == 'update')
          value="{{$income->value_capital}}"
        @else
          value = "0,00"
        @endif
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('description') border-2 border-pink-600 @enderror"
        placeholder="Valor recebido destinado a aquisição de béns de Capital"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block mb-2 text-xs font-bold text-gray-700 uppercase"
        for="grid-password"
        >Valor Custeio
        @error('value_custeio')
          <p class="text-red-600">{{$message}}</p>
        @enderror
        </label
      ><input
        type="text"
        name="value_custeio"
        required
        id="value_custeio"
        @if ($action == 'update')
          value="{{$income->value_custeio}}"
        @else
          value = "0,00"
        @endif
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('description') border-2 border-pink-600 @enderror""
        placeholder="Valor recebido destinado a despesas correntes"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block mb-2 text-xs font-bold text-gray-700 uppercase"
        for="grid-password"
        >Valor Total</label
      ><input
        type="text"
        name="amount"
        required
        readonly
        id="amount"
        @if ($action == 'update')
          value="{{$income->amount}}"
        @else
          value="0,00"
        @endif
        class="w-full px-3 py-3 text-sm text-gray-700 placeholder-gray-400 bg-white rounded shadow focus:outline-none focus:shadow-outline"
        placeholder="Valor total recebido"
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
        Salvar
      </button>
      <p id="error-validation" class="absolute hidden text-xs text-red-600"></p>
    </div>
  </form>
</div>
@endsection
            
@section('script')

<script src="{{asset('js/vanilla-masker.min.js')}}" charset="utf-8"></script>
<script charset="utf-8" type="text/javascript">

      var value_custeio = document.querySelector('#value_custeio');
      var value_capital = document.querySelector('#value_capital');
      var total = 0;
      var custeio;
      var capital;

      function somar(){

        custeio = value_custeio.value.replace('.', '');
        custeio = custeio.replace(',', '');

        capital = value_capital.value.replace('.', '');
        capital = capital.replace(',', '');

        total = parseInt(custeio) + parseInt(capital);

        document.querySelector('#amount').value = total;
        VMasker(document.querySelector("#amount")).maskMoney();
      }

      value_custeio.addEventListener('blur', ()=>{
        somar();
      });

      value_capital.addEventListener('blur', ()=>{
        somar()
      });

  VMasker(document.querySelector("#amount")).maskMoney();
  VMasker(document.querySelector("#value_capital")).maskMoney();
  VMasker(document.querySelector("#value_custeio")).maskMoney();
</script>

@endsection


