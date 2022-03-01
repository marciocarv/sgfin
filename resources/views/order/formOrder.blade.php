@extends('layouts.site')

@section('content')
<div class="px-4 md:px-10 mx-auto w-full">
<div class="flex flex-wrap">
<div class="block w-full mt-24">
  <a href="{{route('manageContract', ['id'=>$contract->id])}}" class="p-3 mb-5 bg-gray-800 text-white rounded  hover:bg-gray-600 hover:font-semibold"><i class="fas fa-undo-alt"></i> Voltar</a>
  <div class="">
    <h1 class="mt-5 text-2xl font-bold"><i class="fas fa-file-contract"></i> @if($action == 'update') Edite seu  {{$title_orders}} @else Cadastre o {{$title_orders}} @endif</h1>
  </div>
  @if (session('msg'))
    <p class="bg-green-300 p-4 font-bold leading-normal mb-3 rounded-lg text-green-800">{{ session('msg') }}</p>
  @endif
  
  <form id="register-form" class="w-full mt-5 max-w-2xl block rounded border shadow p-3" action="{{route($route)}}" method="post" enctype="multipart/form-data">
    @csrf
    @if ($action == 'update')
      <input type="hidden" value="{{$order->id}}" name="id"/>
      <input type="hidden" value="{{$order->amount}}" name="amount"/>
      <input type="hidden" value="{{$order->status}}" name="status"/>
    @endif
      <input type="hidden" value="{{$contract->id}}" name="contract_id"/>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Data do Pedido
          @error('date_order')
            <p class="text-red-600">{{$message}}</p>
          @enderror
        </label
      ><input
        type="date"
        name="date_order"
        required
        id="date_order"
        @if ($action == 'update')
          value="{{$order->date_order->format('Y-m-d')}}"
        @else
          value="{{old('date_order')}}"
        @endif
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('date_order') border-2 border-pink-600 @enderror"
        placeholder="Data de recebimento do recurso"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Descrição
          @error('description')
            <p class="text-red-600">{{$message}}</p>
          @enderror
        </label
      ><input
        type="text"
        name="description"
        required
        id="description"
        @if ($action == 'update')
          value="{{$income->description}}"
        @endif
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('description') border-2 border-pink-600 @enderror"
        placeholder="A que se destina o pedido"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Servidor Responsável
          @error('responsible')
            <p class="text-red-600">{{$message}}</p>
          @enderror
        </label
      ><input
        type="text"
        name="responsible"
        required
        id="responsible"
        @if ($action == 'update')
          value="{{$order->responsible}}"
        @endif
        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('responsible') border-2 border-pink-600 @enderror"
        placeholder="Informe o responsável pelo pedido e recebimento"
        style="transition: all 0.15s ease 0s;"
      />
    </div>
    <div class="relative w-full mb-3">
      <label
        class="block uppercase text-gray-700 text-xs font-bold mb-2"
        for="grid-password"
        >Produtos / Serviços
        </label>
        @if($items->isEmpty())
          Não há Produtos / Serviços
        @endif
        @foreach ($items as $item)
          <div class="p-4">
            <input 
              type="checkbox"
              value="{{$item->id}}"
              name="items[]"
              id="item{{$item->id}}" /> 
              {{$item->description}}&nbsp;
              <input type="number"
                name="nocounted"
                id="quantity{{$item->id}}"
                readonly
                class="px-1 py-1 placeholder-gray-400 text-gray-700 rounded text-sm shadow focus:outline-none focus:shadow-outline " />
              <span id="disponivel{{$item->id}}" class="text-green-500 text-xs hidden">Disponível: {{$item->quantity}} |
                 Valor Unitário: {{number_format($item->unitary_value, 2, ',', '.')}}</span>
          </div>
        @endforeach
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

<script charset="utf-8" type="text/javascript">

@foreach ($items as $item)
  
  document.querySelector('#item{{$item->id}}').addEventListener('click', ()=>{
    if(document.querySelector('#item{{$item->id}}').checked){
      document.querySelector('#quantity{{$item->id}}').removeAttribute('readonly');
      document.querySelector('#disponivel{{$item->id}}').classList.remove('hidden');
      document.querySelector('#quantity{{$item->id}}').classList.add('border-2');
      document.querySelector('#quantity{{$item->id}}').setAttribute('required', 'required');
      document.querySelector('#quantity{{$item->id}}').setAttribute('name', 'quantities[]');
    }else{
      document.querySelector('#quantity{{$item->id}}').setAttribute('readonly', 'readonly');
      document.querySelector('#disponivel{{$item->id}}').classList.add('hidden');
      document.querySelector('#quantity{{$item->id}}').classList.remove('border-2');
      document.querySelector('#quantity{{$item->id}}').removeAttribute('required');
      document.querySelector('#quantity{{$item->id}}').value = "";
      document.querySelector('#quantity{{$item->id}}').setAttribute('name', 'nocounted');
    }
  });

@endforeach

</script>

@endsection


