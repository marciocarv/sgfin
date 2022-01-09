@extends('layouts.site')

@section('content')
<div class="px-4 md:px-10 mx-auto w-full">
<div class="flex flex-wrap">
<div class="block w-full mt-24">
@if($action == 'update')
  <a href="{{route('profile')}}" class="p-3 bg-gray-800 text-white rounded  hover:bg-gray-600 hover:font-semibold"><i class="fas fa-undo-alt"></i> Voltar</a>
@endif
  <div class="">
    <h1 class="mt-5 mb-7 text-2xl font-bold"></i><i class="fas fa-school opacity-75 mr-2 text-2xl"></i>Cadastre sua escola</h1>
</div>
<form class="w-full max-w-2xl block" action="{{route($route)}}" method="post" enctype="multipart/form-data">
    @csrf
    @if ($action == 'update')
      <input type="hidden" value="{{$school->id}}" name="id"/>
    @endif
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Nome</label
      ><input
        type="text"
        name="name"
        required
        @if ($action == 'update')
          value = "{{$school->name}}"
        @endif
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
        placeholder="Informe o Nome da Escola"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Código Inep</label
      ><input
        type="text"
        name="codigo_inep"
        @if ($action == 'update')
          value = "{{$school->codigo_inep}}"
        @endif
        required
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
        placeholder="Informe o Código INEP da escola"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
        <label
          class="block uppercase text-gray-700 text-xs font-bold mb-2"
          for="grid-password"
          >CNPJ</label
        ><input
          type="text"
          name="cnpj"
          @if ($action == 'update')
            value = "{{$school->cnpj}}"
          @endif
          required
          id="cnpj"
          class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
          placeholder="Informe o CNPJ da escola"
          style="transition: all 0.15s ease 0s;"
        />
      </div>
      <div class="relative w-full mb-3">
        <label
          class="block uppercase text-gray-700 text-xs font-bold mb-2"
          for="grid-password"
          >email</label
        ><input
          type="email"
          name="email"
          @if ($action == 'update')
            value = "{{$school->email}}"
          @endif
          required
          class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
          placeholder="Informe o Email da escola"
          style="transition: all 0.15s ease 0s;"
        />
      </div>
      <div class="relative w-full mb-3">
        <label
          class="block uppercase text-gray-700 text-xs font-bold mb-2"
          for="grid-password"
          >Telefone</label
        ><input
          type="text"
          name="telefone"
          id="telefone"
          @if ($action == 'update')
            value = "{{$school->telefone}}"
          @endif
          required
          class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
          placeholder="Informe o Telefone da escola"
          style="transition: all 0.15s ease 0s;"
        />
      </div>
      <div class="relative w-full mb-3">
        <label
          class="block uppercase text-gray-700 text-xs font-bold mb-2"
          for="grid-password"
          >Diretor</label
        ><input
          type="text"
          name="diretor"
          @if ($action == 'update')
            value = "{{$school->diretor}}"
          @endif
          required
          class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
          placeholder="Infome o nome do Diretor"
          style="transition: all 0.15s ease 0s;"
        />
      </div>
      <div class="relative w-full mb-3">
        <label
          class="block uppercase text-gray-700 text-xs font-bold mb-2"
          for="grid-password"
          >Secretário</label
        ><input
          type="text"
          name="secretario"
          @if ($action == 'update')
            value = "{{$school->secretario}}"
          @endif
          required
          class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
          placeholder="Informe o nome do Secretário da escola"
          style="transition: all 0.15s ease 0s;"
        />
      </div>
      <div class="relative w-full mb-3">
        <label
          class="block uppercase text-gray-700 text-xs font-bold mb-2"
          for="grid-password"
          >Coordenador Financeiro</label
        ><input
          type="text"
          name="caf"
          @if ($action == 'update')
            value = "{{$school->caf}}"
          @endif
          required
          class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
          placeholder="Informe o nome do Coordenador Financeiro da escola"
          style="transition: all 0.15s ease 0s;"
        />
      </div>
      <div class="relative w-full mb-3">
        <label
          class="block uppercase text-gray-700 text-xs font-bold mb-2"
          for="grid-password"
          >Módulo</label
        ><select name="modulo" class="px-3 py-3 text-gray-700 rounded text-sm shadow w-full">
          <option value="">-</option>
          <option value="I"
          @if ($action == 'update')
            @if ($school->modulo === 'I')
            selected
            @endif
          @endif
          >Módulo I</option>
          <option value="II"
          @if ($action == 'update')
            @if ($school->modulo === 'II')
            selected
            @endif
          @endif
          >Módulo II</option>
          <option value="III"
          @if ($action == 'update')
            @if ($school->modulo === 'III')
            selected
            @endif
          @endif
          >Módulo III</option>
        </select>
      </div>
      <div class="relative w-full mb-3">
        <label
          class="block uppercase text-gray-700 text-xs font-bold mb-2"
          for="grid-password"
          >Endereço</label
        ><input
          type="text"
          name="adress"
          @if ($action == 'update')
            value = "{{$school->adress}}"
          @endif
          required
          class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
          placeholder="Informe o Endreço da escola"
          style="transition: all 0.15s ease 0s;"
        />
      </div>
      <div class="relative w-full mb-3">
        <label
          class="block uppercase text-gray-700 text-xs font-bold mb-2"
          for="grid-password"
          >CEP</label
        ><input
          type="text"
          name="cep"
          id="cep"
          @if ($action == 'update')
            value = "{{$school->cep}}"
          @endif
          required
          class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
          placeholder="99.999-99"
          style="transition: all 0.15s ease 0s;"
        />
      </div>
      <div class="relative w-full mb-3">
        <label
          class="block uppercase text-gray-700 text-xs font-bold mb-2"
          for="grid-password"
          >Lei de Criação</label
        ><input
          type="text"
          name="lei_criacao"
          @if ($action == 'update')
            value = "{{$school->lei_criacao}}"
          @endif
          required
          class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
          placeholder="Informe o número da Lei de Criação"
          style="transition: all 0.15s ease 0s;"
        />
      </div>
      <div class="relative w-full mb-3">
        <label
          class="block uppercase text-gray-700 text-xs font-bold mb-2"
          for="grid-password"
          >Data de Criação da escola</label
        ><input
          type="date"
          name="date_criacao"
          @if ($action == 'update')
            value = "{{$school->date_criacao->format('Y-m-d')}}"
          @endif
          required
          class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
          placeholder="Informe o número da Lei de Criação"
          style="transition: all 0.15s ease 0s;"
        />
      </div>
      <div class="relative w-full mb-3">
        <label
          class="block uppercase text-gray-700 text-xs font-bold mb-2"
          for="grid-password"
          >Autorização de Funcionamento</label
        ><input
          type="text"
          name="autorizacao_funcionamento"
          @if ($action == 'update')
            value = "{{$school->autorizacao_funcionamento}}"
          @endif
          required
          class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
          placeholder="Informe a autorização de funcionamento"
          style="transition: all 0.15s ease 0s;"
        />
      </div>
    <div class="text-center mt-6">
      <button
        class="bg-gray-900 text-white active:bg-gray-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full max-w-xs"
        type="submit"
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

            VMasker(document.querySelector("#cnpj")).maskPattern("99.999.999/9999-99");
            VMasker(document.querySelector("#cep")).maskPattern("99.999-999");
            VMasker(document.querySelector("#telefone")).maskPattern("(99) 9999-9999");

  </script>
@endsection