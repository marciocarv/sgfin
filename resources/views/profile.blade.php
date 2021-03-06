@extends('layouts.site')

@section('content')
<div class="px-4 md:px-10 mx-auto w-full">
<div class="flex flex-wrap">
<div class="block w-full mt-24">
  <a href="{{route('dashboard')}}" class="p-3 bg-gray-800 text-white rounded  hover:bg-gray-600 hover:font-semibold"><i class="fas fa-undo-alt"></i> Voltar</a> 
  @if (session('msg'))
    <p class="bg-green-300 p-4 font-bold leading-normal mb-3 mt-3 rounded-lg text-green-800">{{ session('msg') }}</p>
@endif
  <div class="">
    <h1 class="mt-5 text-2xl font-bold"><i class="fas fa-user"></i> Dados do Usuário 
      <span class="text-xs"><a href="{{route('upUser', ['id'=>$user->id])}}" class="text-blue-700"><i class="fas fa-edit"></i> Editar Perfil</a></span>
      <span class="text-xs"><a href="#" class="text-blue-700"><i class="fas fa-key"></i> Alterar Senha</a></span>
    </h1>
  </div>
  <div class="relative flex flex-col min-w-0 break-words bg-white rounded mt-8 xl:mb-0 shadow-lg">
    <p class="p-2">Usuário: <span class="font-bold">{{$user->name}}</span></p>
    <p class="p-2">Email: <span class="font-bold">{{$user->email}}</span></p>
    <p class="p-2">Módulo: <span class="font-bold">{{$user->tenancy->module}}</span></p>
  </div>
  <div class="">
    <h1 class="mt-5 text-2xl font-bold"><i class="fas fa-graduation-cap"></i> Dados da Escola 
      <span class="text-xs"><a href="{{route('upSchool', ['id'=>$school->id])}}" class="text-blue-700"><i class="fas fa-edit"></i> Editar Escola</a></span>
    </h1>
  </div>
  <div class="relative flex flex-col min-w-0 break-words bg-white rounded mt-8 xl:mb-0 shadow-lg">
    <p class="p-2">Nome: <span class="font-bold">{{$school->name}}</span></p>
    <p class="p-2">Código Inep: <span class="font-bold">{{$school->codigo_inep}}</span></p>
    <p class="p-2">CNPJ: <span class="font-bold">{{$school->cnpj}}</span></p>
    <p class="p-2">Email: <span class="font-bold">{{$school->email}}</span></p>
    <p class="p-2">Diretor: <span class="font-bold">{{$school->diretor}}</span></p>
    <p class="p-2">Secretário: <span class="font-bold">{{$school->secretario}}</span></p>
    <p class="p-2">Coordenador Financeiro <span class="font-bold">{{$school->caf}}</span></p>
    <p class="p-2">Módulo Escola: <span class="font-bold">{{$school->modulo}}</span></p>
    <p class="p-2">Endereço: <span class="font-bold">{{$school->adress}}</span></p>
    <p class="p-2">CEP: <span class="font-bold">{{$school->cep}}</span></p>
    <p class="p-2">Lei de Criação: <span class="font-bold">{{$school->lei_criacao}}</span></p>
    <p class="p-2">Data de fundação: <span class="font-bold">{{$school->date_criacao->format('d/m/Y')}}</span></p>
    <p class="p-2">Autorização de Funcionamento: <span class="font-bold">{{$school->autorizacao_funcionamento}}</span></p>
  </div>
    <div class="">
      <h1 class="mt-5 text-2xl font-bold"><i class="fas fa-users"></i> ACE 
        <span class="text-xs"><a href="{{route('upAce', ['id'=>$school->ace->id])}}" class="text-blue-700"><i class="fas fa-edit"></i> Editar ACE</a></span>
      </h1>
    </div>
  @if($school->ace)
    <div class="relative flex flex-col min-w-0 break-words bg-white rounded mt-8 xl:mb-0 shadow-lg">
      <p class="p-2">Associação: <span class="font-bold">{{$school->ace->name}}</span></p>
      <p class="p-2">Presidente: <span class="font-bold">{{$school->ace->presidente}}</span></p>
      <p class="p-2">Vice-Presidente: <span class="font-bold">{{$school->ace->vice_presidente}}</span></p>
      <p class="p-2">Secretário: <span class="font-bold">{{$school->ace->secretario}}</span></p>
      <p class="p-2">2º Secretário: <span class="font-bold">{{$school->ace->segundo_secretario}}</span></p>
      <p class="p-2">Tesoureiro: <span class="font-bold">{{$school->ace->tesoureiro}}</span></p>
      <p class="p-2">2º Tesoureiro: <span class="font-bold">{{$school->ace->segundo_tesoureiro}}</span></p>
      <p class="p-2">1º Membro do Conselho Fiscal: <span class="font-bold">{{$school->ace->membro_1}}</span></p>
      <p class="p-2">2º Membro do Conselho Fiscal: <span class="font-bold">{{$school->ace->membro_2}}</span></p>
      <p class="p-2">3º Membro do Conselho Fiscal: <span class="font-bold">{{$school->ace->membro_3}}</span></p>
    </div>
  @else
  <div class="relative flex flex-col min-w-0 break-words bg-white rounded mt-8 xl:mb-0 shadow-lg">
    <p class="p-2 font-bold text-lg">ACE não cadastrada</p>
    <p class="p-2 font-bold text-lg"><a href="#" class="text-teal-800">Cadastrar ACE</a></p>
  </div>
  @endif
</div>
@endsection

@section('script')
<script src="{{asset('js/vanilla-masker.min.js')}}" charset="utf-8"></script>
<script charset="utf-8" type="text/javascript">
</script>

@endsection
