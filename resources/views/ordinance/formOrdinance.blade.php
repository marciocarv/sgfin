@extends('layouts.site')

@section('content')
<div class="px-4 md:px-10 mx-auto w-full">
<div class="flex flex-wrap">
<div class="block w-full mt-24">
  <a href="{{route('ordinance')}}" class="p-3 mb-5 bg-gray-800 text-white rounded hover:bg-gray-700"><i class="fas fa-undo-alt"></i> Voltar</a>
  <div class="">
      <h1 class="mt-8 text-2xl font-bold"><i class="fas fa-file-contract"></i> Cadastre sua Portaria</h1>
  </div>
  
  @if (session('msg'))
    <p class="bg-green-300 p-4 font-bold leading-normal mb-3 rounded-lg text-green-800">{{ session('msg') }}</p>
  @endif
  
  <form id="register-form" class="w-full mt-5 max-w-2xl block rounded border shadow p-5" action="{{route($route)}}" method="post" enctype="multipart/form-data">
    @csrf
    @if ($action == 'update')
      <input type="hidden" value="{{$ordinance->id}}" name="id"/>
    @endif
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Número Portaria</label
      ><input
        type="number"
        name="number"
        required
        id="edicao"
        @if ($action == 'update')
          value="{{$ordinance->number}}"
        @endif
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
        placeholder="Número da Portaria"
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
          value="{{$ordinance->description}}"
        @endif
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
        placeholder="Descrição da Portaria"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
        <label
          class="block uppercase text-gray-700 text-xs font-bold mb-2"
          for="grid-password"
          >Data</label
        ><input
          type="date"
          name="date_ordinance"
          required
          id="date_ordinance"
          @if ($action == 'update')
          value="{{$ordinance->date_ordinance->format('Y-m-d')}}"
          @endif
          class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
          placeholder="Data Portaria"
          style="transition: all 0.15s ease 0s;"
        />
    </div>
      <div class="relative w-full mb-3">
        <label
          class="block uppercase text-gray-700 text-xs font-bold mb-2"
          for="grid-password"
          >Edição do Diário Oficial</label
        ><input
          type="number"
          name="number_diario"
          required
          id="number_diario"
          @if ($action == 'update')
          value="{{$ordinance->number_diario}}"
          @endif
          class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
          placeholder="Número do diário oficial"
          style="transition: all 0.15s ease 0s;"
        />
      </div>
      <div class="relative w-full mb-3">
        <label
          class="block uppercase text-gray-700 text-xs font-bold mb-2"
          for="grid-password"
          >Número Processo</label
        ><input
          type="number"
          name="number_process"
          required
          id="number_process"
          @if ($action == 'update')
          value="{{$ordinance->number_process}}"
          @endif
          class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
          placeholder="Número de Processo da Portaria"
          style="transition: all 0.15s ease 0s;"
        />
      </div>
      <div class="relative w-full mb-3">
        <label
          class="block uppercase text-gray-700 text-xs font-bold mb-2"
          for="grid-password"
          >Natureza</label
        ><input
          type="text"
          name="nature"
          id="nature"
          @if ($action == 'update')
          value="{{$ordinance->nature}}"
          @endif
          class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
          placeholder="Natureza do Recurso"
          style="transition: all 0.15s ease 0s;"
        />
      </div>
      <div class="relative w-full mb-3">
        <label
          class="block uppercase text-gray-700 text-xs font-bold mb-2"
          for="grid-password"
          >Fonte</label
        ><input
          type="text"
          name="source"
          id="source"
          @if ($action == 'update')
          value="{{$ordinance->source}}"
          @endif
          class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
          placeholder="Fonte do Recurso"
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
          value="{{$ordinance->value_custeio}}"
          @endif
          class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
          placeholder="Valor Total da Portaria"
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
          value="{{$ordinance->value_capital}}"
          @endif
          class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
          placeholder="Valor Total da Portaria"
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
          readonly
          required
          id="amount"
          @if ($action == 'update')
          value="{{$ordinance->amount}}"
          @endif
          class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
          placeholder="Valor Total da Portaria"
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
      VMasker(document.querySelector("#value_custeio")).maskMoney();
      VMasker(document.querySelector("#value_capital")).maskMoney();

  </script>
@endsection
            



