@extends('layouts.site')

@section('content')
<div class="px-4 md:px-10 mx-auto w-full">
<div class="flex flex-wrap">
<div class="block w-full mt-24">
  <a href="{{route('profile')}}" class="p-3 bg-gray-800 text-white rounded  hover:bg-gray-600 hover:font-semibold"><i class="fas fa-undo-alt"></i> Voltar</a>
<div class="">
    <h1 class="mt-5 mb-7 text-2xl font-bold"></i><i class="fas fa-school opacity-75 mr-2 text-2xl"></i>Editar ACE</h1>
</div>
<form class="w-full max-w-2xl block" action="{{route('upAcePost')}}" method="post" enctype="multipart/form-data">
    @csrf
      <input type="hidden" value="{{$ace->id}}" name="id"/>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Nome</label
      ><input
        type="text"
        name="name"
        required
        value = "{{$ace->name}}"
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
        placeholder="Informe o Nome da Associação"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Presidente</label
      ><input
        type="text"
        name="presidente"
        required
        value = "{{$ace->presidente}}"
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
        placeholder="Informe o Nome do Presidente da ACE"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Vice-Presidente</label
      ><input
        type="text"
        name="vice_presidente"
        required
        value = "{{$ace->vice_presidente}}"
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
        placeholder="Informe o Nome do Vice-presidente da ACE"
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
        required
        value = "{{$ace->secretario}}"
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
        placeholder="Informe o Nome do Secretário da ACE"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >2º Secretário</label
      ><input
        type="text"
        name="segundo_secretario"
        required
        value = "{{$ace->segundo_secretario}}"
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
        placeholder="Informe o Nome do 2º Secretário da ACE"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Tesoureiro</label
      ><input
        type="text"
        name="tesoureiro"
        required
        value = "{{$ace->tesoureiro}}"
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
        placeholder="Informe o Nome do Tesoureiro da ACE"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >2º Tesoureiro</label
      ><input
        type="text"
        name="segundo_tesoureiro"
        required
        value = "{{$ace->segundo_tesoureiro}}"
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
        placeholder="Informe o Nome do 2º Tesoureiro da ACE"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >1º Membro do Conselho Fiscal</label
      ><input
        type="text"
        name="membro_1"
        required
        value = "{{$ace->membro_1}}"
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
        placeholder="Informe o Nome do 1º Membro do CF"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >2º Membro do Conselho Fiscal</label
      ><input
        type="text"
        name="membro_2"
        required
        value = "{{$ace->membro_2}}"
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
        placeholder="Informe o Nome do 2º Membro do CF"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >3º Membro do Conselho Fiscal</label
      ><input
        type="text"
        name="membro_3"
        required
        value = "{{$ace->membro_3}}"
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
        placeholder="Informe o Nome do 3º Membro do CF"
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