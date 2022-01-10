@extends('layouts.site')

@section('content')
<div class="px-4 md:px-10 mx-auto w-full">
<div class="flex flex-wrap">
<div class="block w-full mt-24">
  <a href="{{route('income', ['id'=>$account->id])}}" class="p-3 mb-5 bg-gray-800 text-white rounded  hover:bg-gray-600 hover:font-semibold"><i class="fas fa-undo-alt"></i> Voltar</a>
  <div class="">
    <h1 class="mt-5 text-2xl font-bold"><i class="fas fa-file-contract"></i> Cadastre sua Receita - {{$account->description}}</h1>
  </div>
  @if ($options->count() === 1)
    <p class="bg-green-300 p-4 font-bold leading-normal mb-3 rounded-lg text-green-800">
      Você não possui Portarias Cadastradas, se o Recurso veio através de uma portaria, <a href="{{route('addOrdinance')}}" class="text-red-600 hover:text-red-400">cadastre aqui</a>
    </p>
  @endif
  @if (session('msg'))
    <p class="bg-green-300 p-4 font-bold leading-normal mb-3 rounded-lg text-green-800">{{ session('msg') }}</p>
  @endif
  
  <form id="register-form" class="w-full mt-5 max-w-2xl block rounded border shadow p-3" action="{{route($route)}}" method="post" enctype="multipart/form-data">
    @csrf
    @if ($action == 'update')
      <input type="hidden" value="{{$income->id}}" name="id"/>
    @endif
      <input type="hidden" value="{{$account->id}}" name="account_id"/>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Portaria</label
      >
      <select name="ordinance_id" class="px-3 py-3 shadow focus:outline-none focus:shadow-outline w-full text-gray-700 text-sm">
        <option value=" " class="text-gray-700 text-sm" style="transition: all 0.15s ease 0s;">Selecione a portaria</option>
        @foreach($options as $option)
        <option value="{{$option->id}}" class="text-gray-700 text-sm"
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
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Data</label
      ><input
        type="date"
        name="date_income"
        required
        id="date_income"
        @if ($action == 'update')
        value="{{$income->date_income->format('Y-m-d')}}"
        @endif
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
        @if ($action == 'update')
          value="{{$income->description}}"
        @endif
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
        placeholder="Descreva a que se destina o recurso"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Valor Capital</label
      ><input
        type="text"
        name="value_capital"
        required
        id="value_capital"
        @if ($action == 'update')
          value="{{$income->value_capital}}"
        @endif
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
        placeholder="Valor recebido destinado a aquisição de béns de Capital"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Valor Custeio</label
      ><input
        type="text"
        name="value_custeio"
        required
        id="value_custeio"
        @if ($action == 'update')
          value="{{$income->value_custeio}}"
        @endif
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
        placeholder="Valor recebido destinado a despesas correntes"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
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
        @endif
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
        placeholder="Valor total recebido"
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
        Salvar
      </button>
      <p id="error-validation" class="hidden text-red-600 absolute text-xs"></p>
    </div>
  </form>
</div>
@endsection
            
@section('script')

<script src="{{asset('js/vanilla-masker.min.js')}}" charset="utf-8"></script>
<script charset="utf-8" type="text/javascript">

var value_custeio = document.querySelector('#value_custeio');
      var value_capital = document.querySelector('#value_capital');
      var total = 0.00;
      var custeio;
      var capital;
      var historico_custeio = 0;
      var historico_capital = 0;
      var controle_custeio = false;
      var controle_capital = false;

      value_custeio.addEventListener('blur', ()=>{
        custeio = value_custeio.value.replace('.', '');
        custeio = custeio.replace(',', '');
        if(controle_custeio){
          total = total - historico_custeio + parseInt(custeio);
          historico_custeio = parseInt(custeio);
          console.log(historico_custeio);
          console.log(total);
          console.log('segunda ou terceira vez');
        }else{
          total += parseInt(custeio);
          historico_custeio = parseInt(custeio);
          controle_custeio = true;
          console.log(historico_custeio);
          console.log(total);
          console.log('primeira vez');
        }
        document.querySelector('#amount').value = total;
        VMasker(document.querySelector("#amount")).maskMoney();
        
      });

      value_capital.addEventListener('blur', ()=>{
        capital = value_capital.value.replace('.', '');
        capital = capital.replace(',', '');
        if(controle_capital){
          total = total - historico_capital + parseInt(capital);
          historico_capital = parseInt(capital);
          console.log(historico_capital);
          console.log(total);
          console.log('segunda ou terceira vez');
        }else{
          total += parseInt(capital);
          historico_capital = parseInt(capital);
          controle_capital = true;
          console.log(historico_capital);
          console.log(total);
          console.log('primeira vez');
        }
        document.querySelector('#amount').value = total;
        VMasker(document.querySelector("#amount")).maskMoney();
        
      });


  VMasker(document.querySelector("#amount")).maskMoney();
  VMasker(document.querySelector("#value_capital")).maskMoney();
  VMasker(document.querySelector("#value_custeio")).maskMoney();
</script>

@endsection


