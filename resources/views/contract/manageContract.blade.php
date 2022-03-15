@extends('layouts.site')

@section('content')
<div class="w-full px-4 mx-auto md:px-10">
<div class="flex flex-wrap">
<div class="block w-full mt-24">
    <div class="flex flex-wrap justify-between">
        <a href="{{route('contract')}}" class="p-3 mb-5 mr-3 text-white bg-gray-800 rounded hover:bg-gray-600 hover:font-semibold"><i class="fas fa-undo-alt"></i> Voltar</a>
        <a href="{{route('upContract', ['id'=>$contract->id])}}" class="p-3 mb-5 mr-3 text-white bg-blue-400 rounded hover:bg-blue-600 hover:font-semibold"><i class="fas fa-edit"></i> Editar Contrato</a>
        <a href="{{route('delContract', ['id'=>$contract->id])}}" class="p-3 mb-5 text-white bg-red-700 rounded hover:bg-red-600 hover:font-semibold"><i class="fas fa-trash-alt"></i></i> Deletar Contrato</a>
    </div>
    @if($acesso)
        <div class="">
            <h1 class="mt-5 text-2xl font-bold text-center"><i class="fas fa-file-contract"></i> Gerenciar Contrato {{$contract->description}} - {{$contract->provider->name}}</h1>
        </div>
    @endif
    @if (session('msg'))
      <p class="p-4 mt-3 mb-3 font-bold leading-normal text-green-800 bg-green-300 rounded-lg">{{ session('msg') }}</p>
    @endif
    <div class="flex flex-wrap justify-center">
        <button class="p-3 mx-5 my-3 text-white bg-gray-800 rounded hover:bg-gray-600 hover:font-semibold" onclick="mostrar()"><i class="fas fa-plus"></i> Adicionar {{$title_items}}</button>
        <a href="{{route('addOrder', ['id'=>$contract->id])}}" class="p-3 mx-5 my-3 text-white bg-gray-800 rounded hover:bg-gray-600 hover:font-semibold"><i class="fas fa-pen-square"></i> Realizar {{$title_orders}}</a>
    </div>
    <div id="form_item" class="hidden">
        <form id="register-form" class="block w-full max-w-2xl p-3 mt-5 border rounded shadow" action="{{route('addItem')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="contract_id" value="{{$contract->id}}">
            <div class="relative w-full mb-3">
              <label
                class="block mb-2 text-xs font-bold text-gray-700 uppercase"
                for="grid-password"
                >Descrição do {{$title_items}}
                </label
              ><input
                type="text"
                name="description"
                required
                id="description"
                class="w-full px-3 py-3 text-sm text-gray-700 placeholder-gray-400 bg-white rounded shadow focus:outline-none focus:shadow-outline"
                placeholder="Descreva em poucas palavras"
                style="transition: all 0.15s ease 0s;"
              />
            </div>
            <div class="relative w-full mb-3">
              <label
                class="block mb-2 text-xs font-bold text-gray-700 uppercase"
                for="grid-password"
                >Valor Unitário
                  @error('unitary_value')
                    <p class="text-red-600">{{$message}}</p>
                  @enderror
                </label
              ><input
                type="text"
                name="unitary_value"
                required
                id="unitary_value"
                class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('unitary_value') border-2 border-pink-600 @enderror"
                placeholder="Insira o valor unitário"
                style="transition: all 0.15s ease 0s;"
              />
            </div>
            <div class="relative w-full mb-3">
              <label
                class="block mb-2 text-xs font-bold text-gray-700 uppercase"
                for="grid-password"
                >Quantidade
                  @error('quantity')
                    <p class="text-red-600">{{$message}}</p>
                  @enderror
                </label
              ><input
                type="number"
                name="quantity"
                required
                id="quantity"
                value="1"
                class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('quantity') border-2 border-pink-600 @enderror"
                placeholder=""
                style="transition: all 0.15s ease 0s;"
              />
            </div>
            <div class="relative w-full mb-3">
              <label
                class="block mb-2 text-xs font-bold text-gray-700 uppercase"
                for="grid-password"
                >Valor Total
                  @error('total_value')
                    <p class="text-red-600">{{$message}}</p>
                  @enderror
                </label
              ><input
                type="text"
                name="total_value"
                required
                id="total_value"
                class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('total_value') border-2 border-pink-600 @enderror"
                placeholder="Digite o valor Total"
                style="transition: all 0.15s ease 0s;"
              />
            </div>
            <div class="relative w-full mb-3">
              <label
                class="block mb-2 text-xs font-bold text-gray-700 uppercase"
                for="grid-password"
                >Unidade
                  @error('unity')
                    <p class="text-red-600">{{$message}}</p>
                  @enderror
                </label
              ><input
                type="text"
                name="unity"
                id="unity"
                class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('unity') border-2 border-pink-600 @enderror"
                placeholder=""
                style="transition: all 0.15s ease 0s;"
              />
            </div>
            <div class="flex flex-wrap justify-center">
              <button class="p-3 mb-5 mr-3 text-white bg-gray-800 rounded" type="submit" id="btn-submit"> SALVAR</button>
              <button class="p-3 mb-5 text-white bg-gray-800 rounded" onclick="ocultar()"> CANCELAR</a>
            </div>
          </form>
    </div>
@if($acesso)
    <div class="flex flex-wrap mx-auto">
        <div class="w-full p-3 mt-3 border rounded shadow">
            <h1 class="my-5 mt-3 text-2xl font-bold text-center">
                {{$title_items}}
            </h1>
            <table class="w-full border-collapse">
                <thead>
                    <tr>
                        <th class="hidden p-3 font-bold text-gray-600 uppercase bg-gray-200 border border-gray-300 lg:table-cell">Descrição</th>
                        <th class="hidden p-3 font-bold text-gray-600 uppercase bg-gray-200 border border-gray-300 lg:table-cell">Valor Unitário</th>
                        <th class="hidden p-3 font-bold text-gray-600 uppercase bg-gray-200 border border-gray-300 lg:table-cell">QTDE Total</th>
                        <th class="hidden p-3 font-bold text-gray-600 uppercase bg-gray-200 border border-gray-300 lg:table-cell">Saldo</th>
                        <th class="hidden p-3 font-bold text-gray-600 uppercase bg-gray-200 border border-gray-300 lg:table-cell">Unidade</th>
                        <th class="hidden p-3 font-bold text-gray-600 uppercase bg-gray-200 border border-gray-300 lg:table-cell">Valor Total</th>
                        <th class="hidden p-3 font-bold text-gray-600 uppercase bg-gray-200 border border-gray-300 lg:table-cell">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                    <tr class="flex flex-row flex-wrap mb-10 bg-white lg:hover:bg-gray-100 lg:table-row lg:flex-row lg:flex-no-wrap lg:mb-0">
                        <td class="relative block w-full p-3 text-center text-gray-800 border border-b lg:w-auto lg:table-cell lg:static">
                        <span class="absolute top-0 left-0 px-2 py-1 text-xs font-bold uppercase bg-blue-200 lg:hidden">Descrição</span>
                        {{$item->description}}
                        </td>
                        <td class="relative block w-full p-3 text-center text-gray-800 border border-b lg:w-auto lg:table-cell lg:static">
                            <span class="absolute top-0 left-0 px-2 py-1 text-xs font-bold uppercase bg-blue-200 lg:hidden">Valor Unitário</span>
                            <span class="font-bold">R$ {{number_format($item->unitary_value, 2, ',', '.')}}</span>
                        </td>
                        <td class="relative block w-full p-3 text-center text-gray-800 border border-b lg:w-auto lg:table-cell lg:static">
                            <span class="absolute top-0 left-0 px-2 py-1 text-xs font-bold uppercase bg-blue-200 lg:hidden">Quantidade Total</span>
                            {{$item->quantity}}
                        </td>
                        <td class="relative block w-full p-3 text-center text-gray-800 border border-b lg:w-auto lg:table-cell lg:static">
                          <span class="absolute top-0 left-0 px-2 py-1 text-xs font-bold uppercase bg-blue-200 lg:hidden">Saldo</span>
                          {{$item->quantity - $item->orders->sum('pivot.quantity')}}
                      </td>
                        <td class="relative block w-full p-3 text-center text-gray-800 border border-b lg:w-auto lg:table-cell lg:static">
                            <span class="absolute top-0 left-0 px-2 py-1 text-xs font-bold uppercase bg-blue-200 lg:hidden">Unidade</span>
                            {{$item->unity}}
                        </td>
                        <td class="relative block w-full p-3 text-center text-gray-800 border border-b lg:w-auto lg:table-cell lg:static">
                            <span class="absolute top-0 left-0 px-2 py-1 text-xs font-bold uppercase bg-blue-200 lg:hidden">Valor Total</span>
                            <span class="font-bold">R$ {{number_format($item->total_value, 2, ',', '.')}}</span>
                        </td>
                        <td class="relative block w-full p-3 text-center text-gray-800 border border-b lg:w-auto lg:table-cell lg:static">
                          <span class="absolute top-0 left-0 px-2 py-1 text-xs font-bold uppercase bg-blue-200 lg:hidden">Excluir</span>
                          <span class="font-bold"><a href="{{route('delItem', ['id'=> $item->id])}}" class="mx-2 text-red-600 underline hover:text-red-400" title="Excluir"><i class="fas fa-trash-alt"></i></a></span>
                      </td>
                    </tr>
                    @endforeach
                    @if($items->isEmpty())
                    <td class="relative block w-full p-3 text-center text-gray-800 border border-b lg:w-auto lg:table-cell lg:static" colspan="7">
                        <span class="absolute top-0 left-0 px-2 py-1 text-xs font-bold uppercase bg-blue-200 lg:hidden">Sem Registro</span>
                        Nâo há {{$title_items}} nesse contrato!
                    </td>
                    @endif
                    <tr>
                      <td class="relative block w-full p-3 text-center text-gray-800 uppercase border border-b lg:w-auto lg:table-cell lg:static" colspan="5">
                        <span class="absolute top-0 left-0 px-2 py-1 text-xs font-bold uppercase bg-blue-200 lg:hidden">Total Contrato</span>
                        <span class="font-bold">Total Contrato</span>
                    </td>
                    <td class="relative block w-full p-3 text-center text-gray-800 border border-b lg:w-auto lg:table-cell lg:static" colspan="2">
                      <span class="absolute top-0 left-0 px-2 py-1 text-xs font-bold uppercase bg-blue-200 lg:hidden">Valor Total</span>
                      <span class="font-bold">R$ {{number_format($sumItems, 2, ',', '.')}}</span>
                  </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="w-full p-3 mt-3 border rounded shadow">
            <h1 class="mt-3 mb-5 text-2xl font-bold text-center">{{$title_orders}}</h1>
            <table class="w-full mt-5 mb-5 border-collapse">
                <thead>
                    <tr>
                        <th class="hidden p-3 font-bold text-gray-600 uppercase bg-gray-200 border border-gray-300 lg:table-cell">Data</th>
                        <th class="hidden p-3 font-bold text-gray-600 uppercase bg-gray-200 border border-gray-300 lg:table-cell">Descrição</th>
                        <th class="hidden p-3 font-bold text-gray-600 uppercase bg-gray-200 border border-gray-300 lg:table-cell">Servidor Responsável</th>
                        <th class="hidden p-3 font-bold text-gray-600 uppercase bg-gray-200 border border-gray-300 lg:table-cell">Valor total</th>
                        <th class="hidden p-3 font-bold text-gray-600 uppercase bg-gray-200 border border-gray-300 lg:table-cell">Status</th>
                        <th class="hidden p-3 font-bold text-gray-600 uppercase bg-gray-200 border border-gray-300 lg:table-cell">detalhar</th>
                        <th class="hidden p-3 font-bold text-gray-600 uppercase bg-gray-200 border border-gray-300 lg:table-cell">ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr class="flex flex-row flex-wrap mb-10 bg-white lg:hover:bg-gray-100 lg:table-row lg:flex-row lg:flex-no-wrap lg:mb-0">
                        <td class="relative block w-full p-3 text-center text-gray-800 border border-b lg:w-auto lg:table-cell lg:static">
                        <span class="absolute top-0 left-0 px-2 py-1 text-xs font-bold uppercase bg-blue-200 lg:hidden">Data</span>
                        {{$order->date_order->format('d/m/Y')}}
                        </td>
                        <td class="relative block w-full p-3 text-center text-gray-800 border border-b lg:w-auto lg:table-cell lg:static">
                            <span class="absolute top-0 left-0 px-2 py-1 text-xs font-bold uppercase bg-blue-200 lg:hidden">Descrição</span>
                            {{$order->description}}
                        </td>
                        <td class="relative block w-full p-3 text-center text-gray-800 border border-b lg:w-auto lg:table-cell lg:static">
                            <span class="absolute top-0 left-0 px-2 py-1 text-xs font-bold uppercase bg-blue-200 lg:hidden">Servidor Responsável</span>
                            {{$order->responsible}}
                        </td>
                        <td class="relative block w-full p-3 text-center text-gray-800 border border-b lg:w-auto lg:table-cell lg:static">
                            <span class="absolute top-0 left-0 px-2 py-1 text-xs font-bold uppercase bg-blue-200 lg:hidden">Valor Total</span>
                            <span class="font-bold text-green-500">R$ {{number_format($order->amount, 2, ',', '.')}}</span>
                        </td>
                        <td class="relative block w-full p-3 text-center text-gray-800 border border-b lg:w-auto lg:table-cell lg:static">
                            <span class="absolute top-0 left-0 px-2 py-1 text-xs font-bold uppercase bg-blue-200 lg:hidden">Status</span>
                            {{$order->status}}
                        </td>
                        <td class="relative block w-full p-3 text-center text-gray-800 border border-b lg:w-auto lg:table-cell lg:static">
                          <span class="absolute top-0 left-0 px-2 py-1 text-xs font-bold uppercase bg-blue-200 lg:hidden">Detalhar</span>
                          <a class="hover:text-blue-400" href="{{route('detailOrder', ['id'=>$order->id])}}"><i class="fas fa-eye"></i></a>
                      </td>
                      <td class="relative block w-full p-3 text-center text-gray-800 border border-b lg:w-auto lg:table-cell lg:static">
                        <span class="absolute top-0 left-0 px-2 py-1 text-xs font-bold uppercase bg-blue-200 lg:hidden">ações</span>
                        <a href="{{route('delOrder', ['id'=>$order->id])}}" class="mr-3 text-red-600 underline hover:text-red-400" alt="Excluir"><i class="fas fa-trash-alt"></i></a>
                        <a href="{{route('upOrder', ['id'=>$order->id])}}" class="ml-3 text-gray-600 underline hover:text-gray-400" alt="Editar"><i class="fas fa-edit"></i></a>
                    </td>
                    </tr>
                    @endforeach
                    @if($orders->isEmpty())
                    <tr>
                      <td class="relative block w-full p-3 text-center text-gray-800 border border-b lg:w-auto lg:table-cell lg:static" colspan="7">
                          <span class="absolute top-0 left-0 px-2 py-1 text-xs font-bold uppercase bg-blue-200 lg:hidden">Sem Registro</span>
                          Nâo há {{$title_orders}} para esse contrato!
                      </td>
                    </tr>
                    @endif
                    <tr>
                      <td class="relative block w-full p-3 text-center text-gray-800 uppercase border border-b lg:w-auto lg:table-cell lg:static" colspan="5">
                        <span class="absolute top-0 left-0 px-2 py-1 text-xs font-bold uppercase bg-blue-200 lg:hidden">Total</span>
                        <span class="font-bold">Total (Pedidos em aberto)</span>
                      </td>
                      <td class="relative block w-full p-3 text-center text-gray-800 border border-b lg:w-auto lg:table-cell lg:static" colspan="2">
                        <span class="absolute top-0 left-0 px-2 py-1 text-xs font-bold uppercase bg-blue-200 lg:hidden">Total</span>
                        <span class="font-bold">R$ {{number_format($orders->where('status', 'aberto')->sum('amount'), 2, ',', '.')}}</span>
                      </td>
                    </tr>
                </tbody>
            </table>
            <div class="text-center">
              <a href="{{route('gerExpenditureByOrder', ['id'=>$contract->id])}}" class="p-3 m-5 text-white bg-gray-800 rounded hover:bg-gray-600 hover:font-semibold"><i class="fas fa-pen-square"></i> Gerar Despesa</a>
              <p class="mt-2 text-xs text-blue-800">* Ao clicar nesse botão, será gerada uma despesa com o valor de todos os pedidos em aberto.</p>
            </div>
        </div>
    </div>
@else
    <div class="max-w-2xl">
        <p class="p-4 mt-3 mb-3 font-bold leading-normal text-green-800 bg-red-300 rounded-lg">Você não tem acesso a esse contrato</p>
        <img src="{{asset('img/access_danied.png')}}" class="w-full">
    </div>
@endif

</div>
@endsection
            
@section('script')

<script src="{{asset('js/vanilla-masker.min.js')}}" charset="utf-8"></script>

<script charset="utf-8" type="text/javascript">
  var unitary_value = document.querySelector('#unitary_value');
  var quantity = document.querySelector('#quantity');
  var unitary = 0.00;
  var total = 0.00;
  var quantity_item = 0;

      unitary_value.addEventListener('blur', ()=>{
        somar();
      });

      quantity.addEventListener('blur', ()=>{
        somar();
      });

  VMasker(document.querySelector("#unitary_value")).maskMoney();
  VMasker(document.querySelector("#total_value")).maskMoney();

  function mostrar(){
    document.querySelector('#form_item').removeAttribute('class', 'hidden');
  }
  function ocultar(){
    document.querySelector('#form_item').setAttribute('class', 'hidden');
  }

  function somar(){
    unitary = unitary_value.value.replace('.', '');
    unitary = unitary.replace(',', '');
    quantity_item = quantity.value;

    total = parseInt(unitary) * parseInt(quantity_item);

    console.log(total);

    document.querySelector('#total_value').value = total;

    VMasker(document.querySelector("#total_value")).maskMoney();
  }

</script>

@endsection



