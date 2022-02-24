@extends('layouts.site')

@section('content')
<div class="px-4 md:px-10 mx-auto w-full">
<div class="flex flex-wrap">
<div class="block w-full mt-24">
  <a href="{{route('contract')}}" class="p-3 mb-5 bg-gray-800 text-white rounded  hover:bg-gray-600 hover:font-semibold"><i class="fas fa-undo-alt"></i> Voltar</a>
  <div class="">
    <h1 class="mt-5 text-2xl font-bold"><i class="fas fa-file-contract"></i> Cadastre o Contrato</h1>
  </div>
  @if ($providers->isEmpty())
    <p class="bg-green-300 p-4 font-bold leading-normal mb-3 rounded-lg text-green-800">
      Você não possui Fornecedores cadastrados, favor cadastrar um fornecedor <a href="{{route('addProvider')}}" class="text-red-600 hover:text-red-400">cadastre aqui</a>
    </p>
  @endif
  @if (session('msg'))
    <p class="bg-green-300 p-4 font-bold leading-normal mb-3 rounded-lg text-green-800">{{ session('msg') }}</p>
  @endif
  
  <form id="register-form" class="w-full mt-5 max-w-2xl block rounded border shadow p-3" action="{{route($route)}}" method="post" enctype="multipart/form-data">
    @csrf
    @if ($action == 'update')
      <input type="hidden" value="{{$contract->id}}" name="id"/>
    @endif
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Fornecedor</label>
      <select name="provider_id" class="px-3 py-3 shadow focus:outline-none focus:shadow-outline w-full text-gray-700 text-sm">
        <option value="" class="text-gray-700 text-sm" style="transition: all 0.15s ease 0s;">Selecione o Fornecedor</option>
        @foreach($providers as $provider)
        <option value="{{$provider->id}}" class="text-gray-700 text-sm"
          @if ($action == 'update')
            @if($provider->id === $contract->provider_id)
              selected
            @endif
          @endif
        style="transition: all 0.15s ease 0s;">{{$provider->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Categoria</label>
        <select name="category" class="px-3 py-3 shadow focus:outline-none focus:shadow-outline w-full text-gray-700 text-sm">
          <option class="text-gray-700 text-sm" value="M"
          @if ($action == 'update')
          @if($contract->category == 'M')
            selected
          @endif
        @endif
          >Material de Expediente / Produtos em geral </option>
          <option class="text-gray-700 text-sm" value="A"
          @if ($action == 'update')
            @if($contract->category == 'A')
              selected
            @endif
          @endif
          >Alimentação Escolar</option>
          <option class="text-gray-700 text-sm" value="S"
          @if ($action == 'update')
          @if($contract->category == 'S')
            selected
          @endif
        @endif
          >Prestação de Serviço</option>
          <option class="text-gray-700 text-sm" value="O"
          @if ($action == 'update')
          @if($contract->category == 'O')
            selected
          @endif
        @endif
          >Obras em geral</option>
        </select>
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Número do Contrato
        </label
      ><input
        type="text"
        name="num_contract"
        required
        id="num_contract"
        @if ($action == 'update')
          value="{{$contract->num_contract}}"
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
        >Início do contrato
          @error('start_period')
            <p class="text-red-600">{{$message}}</p>
          @enderror
        </label
      ><input
        type="date"
        name="start_period"
        required
        id="start_period"
        @if ($action == 'update')
        value="{{$contract->start_period->format('Y-m-d')}}"
        @endif
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('start_period') border-2 border-pink-600 @enderror"
        placeholder="Data de recebimento do recurso"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Fim do contrato
          @error('end_period')
            <p class="text-red-600">{{$message}}</p>
          @enderror
        </label
      ><input
        type="date"
        name="end_period"
        required
        id="end_period"
        @if ($action == 'update')
        value="{{$contract->end_period->format('Y-m-d')}}"
        @endif
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('end_period') border-2 border-pink-600 @enderror"
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
          value="{{$contract->description}}"
        @endif
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
        placeholder="Ex: Contrato Contabilidade ou Contrato PNAE Dia a Dia"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Objeto do Contrato</label
      ><input
        type="text"
        name="object"
        required
        id="object"
        @if ($action == 'update')
          value="{{$contract->object}}"
        @endif
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
        placeholder="Descreva a que se destina o contrato"
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
          value="{{$contract->value}}"
        @endif
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('value') border-2 border-pink-600 @enderror"
        placeholder=""
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
          @if ($contract->nature === 'Custeio')
          selected
          @endif
        @endif
        style="transition: all 0.15s ease 0s;">Custeio</option>
        <option value="Capital" class="text-gray-700 text-sm"
        @if ($action == 'update')
          @if ($contract->nature === 'Capital')
          selected
          @endif
        @endif
        style="transition: all 0.15s ease 0s;">Capital</option>
      </select>
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
  VMasker(document.querySelector("#value")).maskMoney();
</script>

@endsection


