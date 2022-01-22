@extends('layouts.site')

@section('content')
<div class="px-4 md:px-10 mx-auto w-full">
<div class="flex flex-wrap">
<div class="block w-full mt-24">
  <a href="{{route('accountability')}}" class="p-3 mb-5 bg-gray-800 text-white rounded  hover:bg-gray-600 hover:font-semibold"><i class="fas fa-undo-alt"></i> Voltar</a>
  <div class="">
    <h1 class="mt-5 text-2xl font-bold"><i class="fas fa-file-contract"></i> Cadastre sua Prestação de Contas</h1>
  </div>
  @if ($accounts->isEmpty())
    <p class="bg-green-300 p-4 font-bold leading-normal mb-3 rounded-lg text-green-800">
      Você não possui Contas Cadastradas, favor cadastrar uma conta <a href="{{route('addAccount')}}" class="text-red-600 hover:text-red-400">cadastre aqui</a>
    </p>
  @endif
  @if (session('msg'))
    <p class="bg-green-300 p-4 font-bold leading-normal mb-3 rounded-lg text-green-800">{{ session('msg') }}</p>
  @endif
  
  <form id="register-form" class="w-full mt-5 max-w-2xl block rounded border shadow p-3" action="{{route($route)}}" method="post" enctype="multipart/form-data">
    @csrf
    @if ($action == 'update')
      <input type="hidden" value="{{$accountability->id}}" name="id"/>
    @endif
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Conta</label>
      <select name="account_id" class="px-3 py-3 shadow focus:outline-none focus:shadow-outline w-full text-gray-700 text-sm">
        <option value="" class="text-gray-700 text-sm" style="transition: all 0.15s ease 0s;">Selecione a Conta</option>
        @foreach($accounts as $account)
        <option value="{{$account->id}}" class="text-gray-700 text-sm"
          @if ($action == 'update')
            @if($account->id === $accountability->account_id)
              selected
            @endif
          @endif
        style="transition: all 0.15s ease 0s;">{{$account->number}} - {{$account->description}}</option>
        @endforeach
      </select>
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Número do processo
        
        </label
      ><input
        type="text"
        name="num_process"
        required
        id="num_process"
        @if ($action == 'update')
          value="{{$accountability->num_process}}"
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
        >Descrição</label
      ><input
        type="text"
        name="description"
        required
        id="description"
        @if ($action == 'update')
          value="{{$accountability->description}}"
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
        >Ano de Referência</label
      ><input
        type="number"
        name="year"
        required
        id="year"
        @if ($action == 'update')
          value="{{$accountability->year}}"
        @else
          value="{{now()->format('Y')}}"
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
        >Formato de Prestação</label>
        <select name="format" class="px-3 py-3 shadow focus:outline-none focus:shadow-outline w-full text-gray-700 text-sm">
          <option class="text-gray-700 text-sm" value="Q"
          @if ($action == 'update')
          @if($accountability->format == 'Q')
            selected
          @endif
        @endif
          >Quadrimestral</option>
          <option class="text-gray-700 text-sm" value="A"
          @if ($action == 'update')
            @if($accountability->format == 'A')
              selected
            @endif
          @endif
          >Anual</option>
          <option class="text-gray-700 text-sm" value="S"
          @if ($action == 'update')
          @if($accountability->format == 'S')
            selected
          @endif
        @endif
          >Semestral</option>
          <option class="text-gray-700 text-sm" value="T"
          @if ($action == 'update')
          @if($accountability->format == 'T')
            selected
          @endif
        @endif
          >Trimestral</option>
          <option class="text-gray-700 text-sm" value="B"
          @if ($action == 'update')
          @if($accountability->format == 'B')
            selected
          @endif
        @endif
          >Bimestral</option>
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
</script>

@endsection


