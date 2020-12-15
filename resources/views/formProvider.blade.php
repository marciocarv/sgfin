@extends('layouts.site')

@section('content')
<div class="px-4 md:px-10 mx-auto w-full">
<div class="flex flex-wrap">
<div class="block w-full mt-24">
  <div class="">
      <h1 class="mb-10 text-2xl font-bold"><i class="fas fa-file-contract"></i> Cadastro de Fornecedor</h1>
  </div>
  <a href="{{route('provider')}}" class="p-3 mb-5 bg-gray-800 text-white rounded"><i class="fas fa-undo-alt"></i> Voltar</a>
  @if (session('msg'))
    <p class="bg-green-300 p-4 font-bold leading-normal mb-3 rounded-lg text-green-800">{{ session('msg') }}</p>
  @endif
  <form id="register-form" class="w-full mt-5 max-w-2xl block rounded border shadow p-3" action="{{route($route)}}" method="post" enctype="multipart/form-data">
    @csrf
    @if ($action == 'update')
      <input type="hidden" value="{{$provider->id}}" name="id"/>
    @endif
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Tipo Pessoa</label
      ><select name="person_type" class="px-3 py-3 text-gray-700 rounded text-sm shadow w-full" id="select_provider">
        <option value="">-</option>
        <option value="Física"
        @if($action == 'update' && $provider->person_type == 'Física')
        selected
        @endif
        >Pessoa Física</option>
        <option value="Jurídica"
        @if($action == 'update' && $provider->person_type == 'Jurídica')
        selected
        @endif
        >Pessoa Jurídica</option>
      </select>
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Nome</label
      ><input
        type="text"
        name="name"
        required
        id="name"
        @if ($action == 'update')
          value="{{$provider->name}}"
        @endif
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
        placeholder="Nome do Fornecedor"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3" id="form_razao">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Razão Social</label
      ><input
        type="text"
        name="company_name"
        required
        id="company_name"
        @if ($action == 'update')
          value="{{$provider->company_name}}"
        @endif
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
        placeholder="Razão Social do Fornecedor"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3" id="form_cpf">
        <label
          class="block uppercase text-gray-700 text-xs font-bold mb-2"
          for="grid-password"
          >CPF</label
        ><input
          type="text"
          name="cpf"
          required
          id="cpf"
          @if ($action == 'update')
          value="{{$provider->cpf}}"
          @endif
          class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
          placeholder="CPF do Fornecedor"
          style="transition: all 0.15s ease 0s;"
        />
      </div>
      <div class="relative w-full mb-3" id="form_cnpj">
        <label
          class="block uppercase text-gray-700 text-xs font-bold mb-2"
          for="grid-password"
          >CNPJ</label
        ><input
          type="text"
          name="cnpj"
          required
          id="cnpj"
          @if ($action == 'update')
          value="{{$provider->cnpj}}"
          @endif
          class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
          placeholder="CNPJ do Fornecedor"
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
          name="phone"
          required
          id="phone"
          @if ($action == 'update')
          value="{{$provider->phone}}"
          @endif
          class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
          placeholder="Telefone do Fornecedor"
          style="transition: all 0.15s ease 0s;"
        />
      </div>
      <div class="relative w-full mb-3">
        <label
          class="block uppercase text-gray-700 text-xs font-bold mb-2"
          for="grid-password"
          >Endereço</label
        ><input
          type="text"
          name="adress"
          id="adress"
          @if ($action == 'update')
          value="{{$provider->adress}}"
          @endif
          class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
          placeholder="Endereço do Fornecedor"
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
    VMasker(document.querySelector("#cnpj")).maskPattern("99.999.999/9999-99");
    VMasker(document.querySelector("#cpf")).maskPattern("999.999.999-99");
    VMasker(document.querySelector("#phone")).maskPattern("(99) 9999-9999");

    var cpf = document.querySelector('#form_cpf');
    var cpf_input = document.querySelector('#cpf');
    var cnpj = document.querySelector('#form_cnpj');
    var cnpj_input = document.querySelector('#cnpj');
    var razao = document.querySelector('#form_razao');
    var razao_input = document.querySelector('#company_name');
    var select = document.querySelector('#select_provider');
    select.addEventListener('change', ()=>{
      if(select.options[select.selectedIndex].value === 'Física'){
        cnpj.setAttribute('class', 'hidden');
        cnpj_input.removeAttribute("required");
        razao.setAttribute('class', 'hidden');
        razao_input.removeAttribute("required");
        cpf_input.setAttribute('required', 'required');
        cpf.removeAttribute('class', 'hidden');
      }else{
        cpf.setAttribute('class', 'hidden');
        cpf_input.removeAttribute("required");
        razao_input.setAttribute('required', 'required');
        razao.removeAttribute('class','hidden');
        cnpj_input.setAttribute('required', 'required');
        cnpj.removeAttribute('class','hidden');
      }            
    });
    if(select.options[select.selectedIndex].value === 'Física'){
        cnpj.setAttribute('class', 'hidden');
        cnpj_input.removeAttribute("required");
        razao.setAttribute('class', 'hidden');
        razao_input.removeAttribute("required");
        cpf_input.setAttribute('required', 'required');
        cpf.removeAttribute('class', 'hidden');
      }else if(select.options[select.selectedIndex].value === 'Jurídica'){
        cpf.setAttribute('class', 'hidden');
        cpf_input.removeAttribute("required");
        razao_input.setAttribute('required', 'required');
        razao.removeAttribute('class','hidden');
        cnpj_input.setAttribute('required', 'required');
        cnpj.removeAttribute('class','hidden');
      }else{
        
      }
    
  </script>
@endsection



