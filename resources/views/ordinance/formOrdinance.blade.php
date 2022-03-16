@extends('layouts.site')

@section('content')
<div class="w-full px-4 mx-auto md:px-10">
<div class="flex flex-wrap">
<div class="block w-full mt-24">
  <a href="{{route('ordinance')}}" class="p-3 mb-5 text-white bg-gray-800 rounded hover:bg-gray-700"><i class="fas fa-undo-alt"></i> Voltar</a>
  <div class="">
      <h1 class="mt-8 text-2xl font-bold"><i class="fas fa-file-contract"></i> Cadastre sua Portaria</h1>
  </div>
  
  @if (session('msg'))
    <p class="p-4 mb-3 font-bold leading-normal text-green-800 bg-green-300 rounded-lg">{{ session('msg') }}</p>
  @endif
  
  <form id="register-form" class="block w-full max-w-2xl p-5 mt-5 border rounded shadow" action="{{route($route)}}" method="post" enctype="multipart/form-data">
    @csrf
    @if ($action == 'update')
      <input type="hidden" value="{{$ordinance->id}}" name="id"/>
    @endif
    <div class="relative w-full mb-3">
      <label
        class="block mb-2 text-xs font-bold text-gray-700 uppercase"
        for="grid-password"
        >Número Portaria
        @error('number')
          <p class="text-red-600">{{$message}}</p>
        @enderror
        </label
      ><input
        type="number"
        name="number"
        id="edicao"
        required
        @if ($action == 'update')
          value="{{$ordinance->number}}"
        @else
          value = "{{old('number')}}"
        @endif
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('number') border-2 border-pink-600 @enderror"
        placeholder="Número da Portaria"
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
        id="description"
        required
        @if ($action == 'update')
          value="{{$ordinance->description}}"
        @else
          value = "{{old('description')}}"
        @endif
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('description') border-2 border-pink-600 @enderror"
        placeholder="Descrição da Portaria"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
        <label
          class="block mb-2 text-xs font-bold text-gray-700 uppercase"
          for="grid-password"
          >Data
          @error('date_ordinance')
            <p class="text-red-600">{{$message}}</p>
          @enderror
          </label
        ><input
          type="date"
          name="date_ordinance"
          id="date_ordinance"
          required
          @if ($action == 'update')
            value="{{$ordinance->date_ordinance->format('Y-m-d')}}"
          @else
            value = "{{old('date_ordinance')}}"
          @endif
          class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('date_ordinance') border-2 border-pink-600 @enderror"
          placeholder="Data Portaria"
          style="transition: all 0.15s ease 0s;"
        />
    </div>
      <div class="relative w-full mb-3">
        <label
          class="block mb-2 text-xs font-bold text-gray-700 uppercase"
          for="grid-password"
          >Edição do Diário Oficial</label
        ><input
          type="number"
          name="number_diario"
          id="number_diario"
          @if ($action == 'update')
            value="{{$ordinance->number_diario}}"
          @endif
          class="w-full px-3 py-3 text-sm text-gray-700 placeholder-gray-400 bg-white rounded shadow focus:outline-none focus:shadow-outline"
          placeholder="Número do diário oficial"
          style="transition: all 0.15s ease 0s;"
        />
      </div>
      <div class="relative w-full mb-3">
        <label
          class="block mb-2 text-xs font-bold text-gray-700 uppercase"
          for="grid-password"
          >Número Processo</label
        ><input
          type="number"
          name="number_process"
          id="number_process"
          @if ($action == 'update')
            value="{{$ordinance->number_process}}"
          @endif
          class="w-full px-3 py-3 text-sm text-gray-700 placeholder-gray-400 bg-white rounded shadow focus:outline-none focus:shadow-outline"
          placeholder="Número de Processo da Portaria"
          style="transition: all 0.15s ease 0s;"
        />
      </div>
      <div class="relative w-full mb-3">
        <label
          class="block mb-2 text-xs font-bold text-gray-700 uppercase"
          for="grid-password"
          >Natureza
          @error('nature')
            <p class="text-red-600">{{$message}}</p>
          @enderror
          </label
        ><input
          type="text"
          name="nature"
          id="nature"
          required
          @if ($action == 'update')
            value="{{$ordinance->nature}}"
          @else
            value = "{{old('nature')}}"
          @endif
          class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('nature') border-2 border-pink-600 @enderror"
          placeholder="Natureza do Recurso"
          style="transition: all 0.15s ease 0s;"
        />
      </div>
      <div class="relative w-full mb-3">
        <label
          class="block mb-2 text-xs font-bold text-gray-700 uppercase"
          for="grid-password"
          >Fonte
          @error('source')
            <p class="text-red-600">{{$message}}</p>
          @enderror
          </label
        ><input
          type="text"
          name="source"
          id="source"
          @if ($action == 'update')
            value="{{$ordinance->source}}"
          @else
            value = "{{old('source')}}"
          @endif
          required
          class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('source') border-2 border-pink-600 @enderror"
          placeholder="Fonte do Recurso"
          style="transition: all 0.15s ease 0s;"
        />
      </div>
      <div class="relative w-full mb-3">
        <label
          class="block mb-2 text-xs font-bold text-gray-700 uppercase"
          for="grid-password"
          >Valor Custeio
          @error('value_custeio')
            <p class="text-xs text-red-600">{{$message}}</p>
          @enderror
          </label
        ><input
          type="text"
          name="value_custeio"
          id="value_custeio"
          required
          @if ($action == 'update')
            value="{{$ordinance->value_custeio}}"
          @else
            value = "0,00"
          @endif
          class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('value_custeio') border-2 border-pink-600 @enderror"
          placeholder="Valor Total da Portaria"
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
          id="value_capital"
          required
          @if ($action == 'update')
            value="{{$ordinance->value_capital}}"
          @else
            value = "0,00"
          @endif
          class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('value_capital') border-2 border-pink-600 @enderror"
          placeholder="Valor Total da Portaria"
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
          readonly
          id="amount"
          @if ($action == 'update')
            value="{{$ordinance->amount}}"
          @else
            value="0,00"
          @endif
          class="w-full px-3 py-3 text-sm text-gray-700 placeholder-gray-400 bg-white rounded shadow focus:outline-none focus:shadow-outline"
          placeholder="Valor Total da Portaria"
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
            



