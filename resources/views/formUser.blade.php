@extends('layouts.site')

@section('content')
<div class="px-4 md:px-10 mx-auto w-full">
<div class="flex flex-wrap">
<div class="block w-full mt-24">
<a href="{{route('profile')}}" class="p-3 bg-gray-800 text-white rounded  hover:bg-gray-600 hover:font-semibold"><i class="fas fa-undo-alt"></i> Voltar</a>
<div class="">
    <h1 class="mt-5 mb-7 text-2xl font-bold"></i><i class="fas fa-user opacity-75 mr-2 text-2xl"></i> Editar Perfil</h1>
</div>
<form class="w-full max-w-2xl block" action="{{route('upUserPost')}}" method="post" enctype="multipart/form-data">
    @csrf
      <input type="hidden" value="{{$user->id}}" name="id"/>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Nome</label
      ><input
        type="text"
        name="name"
        required
        value = "{{$user->name}}"
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
        placeholder="Informe o Nome do Usuário"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Email</label
      ><input
        type="email"
        name="email"
        value = "{{$user->email}}"
        required
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
        placeholder="Informe o Email"
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