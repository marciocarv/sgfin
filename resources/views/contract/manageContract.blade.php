@extends('layouts.site')

@section('content')
<div class="px-4 md:px-10 mx-auto w-full">
<div class="flex flex-wrap">
<div class="block w-full mt-24">
    <div class="flex justify-between flex-wrap">
        <a href="{{route('contract')}}" class="p-3 mb-5 mr-3 bg-gray-800 text-white rounded  hover:bg-gray-600 hover:font-semibold"><i class="fas fa-undo-alt"></i> Voltar</a>
        <a href="{{route('upContract', ['id'=>$contract->id])}}" class="p-3 mb-5 mr-3  bg-blue-400 text-white rounded  hover:bg-blue-600 hover:font-semibold"><i class="fas fa-edit"></i> Editar Contrato</a>
        <a href="{{route('delContract', ['id'=>$contract->id])}}" class="p-3 mb-5 bg-red-700 text-white rounded  hover:bg-red-600 hover:font-semibold"><i class="fas fa-trash-alt"></i></i> Deletar Contrato</a>
    </div>
    @if($acesso)
        <div class="">
            <h1 class="mt-5 text-2xl text-center font-bold"><i class="fas fa-file-contract"></i> Gerenciar Contrato {{$contract->description}} - {{$contract->provider->name}}</h1>
        </div>
    @endif
    @if (session('msg'))
      <p class="bg-green-300 p-4 font-bold leading-normal mb-3 mt-3 rounded-lg text-green-800">{{ session('msg') }}</p>
    @endif
    <div class="flex justify-center flex-wrap">
        <button class="p-3 mb-5 mr-3  bg-gray-800 text-white rounded  hover:bg-gray-600 hover:font-semibold" onclick="mostrar()"><i class="fas fa-plus"></i> Adicionar {{$title_items}}</button>
        <a href="{{route('addOrder', ['id'=>$contract->id])}}" class="p-3 mb-5 bg-gray-800 text-white rounded  hover:bg-gray-600 hover:font-semibold"><i class="fas fa-pen-square"></i> Realizar {{$title_orders}}</a>
    </div>
    <div id="form_item" class="hidden">
        <form id="register-form" class="w-full mt-5 max-w-2xl block rounded border shadow p-3" action="{{route('addItem')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="contract_id" value="{{$contract->id}}">
            <div class="relative w-full mb-3">
              <label
                class="block uppercase text-gray-700 text-xs font-bold mb-2"
                for="grid-password"
                >Descrição do {{$title_items}}
                </label
              ><input
                type="text"
                name="description"
                required
                id="description"
                class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
                placeholder="Descreva em poucas palavras"
                style="transition: all 0.15s ease 0s;"
              />
            </div>
            <div class="relative w-full mb-3">
              <label
                class="block uppercase text-gray-700 text-xs font-bold mb-2"
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
                class="block uppercase text-gray-700 text-xs font-bold mb-2"
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
                class="block uppercase text-gray-700 text-xs font-bold mb-2"
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
                class="block uppercase text-gray-700 text-xs font-bold mb-2"
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
            <div class="flex justify-center flex-wrap">
              <button class="p-3 mb-5 mr-3  bg-gray-800 text-white rounded" type="submit" id="btn-submit"> SALVAR</button>
              <button class="p-3 mb-5 bg-gray-800 text-white rounded" onclick="ocultar()"> CANCELAR</a>
            </div>
          </form>
    </div>
@if($acesso)
    <div class="flex flex-wrap mx-auto">
        <div class="w-full rounded border shadow mt-3 p-3">
            <h1 class="my-5 mt-3 text-2xl text-center font-bold">
                {{$title_items}}
            </h1>
            <table class="border-collapse w-full">
                <thead>
                    <tr>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Descrição</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Valor Unitário</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">QTDE Total</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Saldo</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Unidade</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Valor Total</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                    <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                        <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Descrição</span>
                        {{$item->description}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Valor Unitário</span>
                            <span class="font-bold">R$ {{number_format($item->unitary_value, 2, ',', '.')}}</span>
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Quantidade Total</span>
                            {{$item->quantity}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                          <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Saldo</span>
                          {{$item->quantity}}
                      </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Unidade</span>
                            {{$item->unity}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Valor Total</span>
                            <span class="font-bold">R$ {{number_format($item->total_value, 2, ',', '.')}}</span>
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                          <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Excluir</span>
                          <span class="font-bold"><a href="{{route('delItem', ['id'=> $item->id])}}" class="text-red-600 hover:text-red-400 underline mx-2" title="Excluir"><i class="fas fa-trash-alt"></i></a></span>
                      </td>
                    </tr>
                    @endforeach
                    @if($items->isEmpty())
                    <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static" colspan="5">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Sem Registro</span>
                        Nâo há {{$title_items}} nesse contrato!
                    </td>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="w-full rounded border shadow mt-3 p-3">
            <h1 class="mb-5 mt-3 text-2xl text-center font-bold">{{$title_orders}}</h1>
            <table class="border-collapse w-full mt-5">
                <thead>
                    <tr>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Data</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Descrição</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Servidor Responsável</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Valor total</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Status</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">detalhar</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                        <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Data</span>
                        {{$order->date_order->format('d/m/Y')}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Descrição</span>
                            {{$order->description}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Servidor Responsável</span>
                            {{$order->responsible}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Valor Total</span>
                            <span class="text-green-500 font-bold">R$ {{number_format($order->amount, 2, ',', '.')}}</span>
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Status</span>
                            {{$order->status}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                          <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Detalhar</span>
                          <a href="#"><i class="fas fa-eye"></i></a>
                      </td>
                      <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">ações</span>
                        <a href="#" class="text-red-600 hover:text-red-400 underline mr-3" alt="Excluir"><i class="fas fa-trash-alt"></i></a>
                        <a href="#" class="text-gray-600 hover:text-gray-400 underline ml-3" alt="Editar"><i class="fas fa-edit"></i></a>
                    </td>
                    </tr>
                    @endforeach
                    @if($orders->isEmpty())
                    <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static" colspan="5">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Sem Registro</span>
                        Nâo há {{$title_orders}} para esse contrato!
                    </td>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@else
    <div class="max-w-2xl">
        <p class="bg-red-300 p-4 font-bold leading-normal mb-3 mt-3 rounded-lg text-green-800">Você não tem acesso a esse contrato</p>
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



